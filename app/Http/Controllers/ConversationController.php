<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Conversation;
use App\Message;
use App\User;
use App\Events\Gamification\ActionEvent;

class ConversationController extends Controller {

    private $perPage = 10;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $user = Auth::user();

        $conversations = Conversation:: whereHas('users', function ($query) use ($user) {
                    $query->where('id', $user->id);
                })
                ->whereHas('messages', function($query) use ($user) {
                    $query->whereHas('users', function($query) use ($user) {
                        $query->where('id', $user->id);
                    });
                })
                ->paginate($this->perPage);
        foreach ($conversations as $conversation) {
            $conversation->totalUnreadMessages = Message::where('id_conversation', $conversation->id)
                    ->whereHas('users', function ($query) use ($user) {
                        $query->where('id', $user->id)
                        ->where('is_read', 0);
                    })
                    ->count();
        }

        return view('conversations.index', ['title' => 'Συζητήσεις - Μηνύματα', 'conversations' => $conversations]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request) {
        $sender = Auth::user();
        $recipient = User::where('id', $request->recipient)->whereNotIn('id', [$sender->id])->firstOrFail();

        // Find existed conversation or create new one
        $conversation = $this->getConversation($sender, $recipient);
        $messages = $sender->userMessages()
                        ->where('id_conversation', $conversation->id)
                        ->orderBy('id', 'desc')->paginate($this->perPage);
        foreach ($messages as $message) {
            if ($message->pivot->is_read == 0) {
                $message
                        ->users()
                        ->where('id_user', $sender->id)
                        ->where('id_message', $message->id)
                        ->updateExistingPivot($sender->id, ['is_read' => 1]);
            }
        }

        return view('conversations.show', ['title' => 'Αποστολή μηνύματος', 'conversation' => $conversation, 'sender' => $sender, 'recipient' => $recipient, 'messages' => $messages]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $request->validate(['content' => 'required|max:255'], [
            'content.required' => 'Δεν έχετε πληκτρολογήσει το περιεχόμενο του μηνύματος.',
            'content.max' => 'Το μήνυμα μπορεί να αποτελείται το πολύ μέχρι 255 χαρακτήρες.']);

        $sender = Auth::user();
        $recipient = User::where('id', $request->recipient)->whereNotIn('id', [$sender->id])->firstOrFail();

        $conversation = $this->getConversation($sender, $recipient);
        // Create new conversation
        if ($conversation->id == 0) {
            $conversation->id = null;
            $conversation->user()->associate($sender);
            $conversation->ip = $request->ip();
            $conversation->save();
            $conversation->users()->attach([$sender->id, $recipient->id]);

            event(new ActionEvent(ActionEvent::CREATE_CONVERSATION_ΒY_YOU, $request, $sender, $recipient));
            event(new ActionEvent(ActionEvent::CREATE_CONVERSATION_BY_OTHER, $request, $recipient, $sender));
        }

        // Attach message to conversation
        $message = new Message();
        $message->conversation()->associate($conversation);
        $message->user()->associate($sender, ['is_read' => 1]);
        $message->content = $request->content;
        $message->ip = $request->ip();
        $message->save();

        // Attach users to messages so that they can view them
        $message->users()->attach([$sender->id, $recipient->id]);

        return redirect()->route('conversations.show', ['conversation' => $conversation->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $sender = Auth::user();

        $conversation = Conversation::where('id', $id)
                ->whereHas('users', function ($query) use ($sender) {
                    $query->where('id', $sender->id);
                })
                ->firstOrFail();
        foreach ($conversation->users as $user) {
            if ($user->id != $sender->id) {
                $recipient = $user;
                break;
            }
        }

        $messages = $sender->userMessages()
                        ->where('id_conversation', $conversation->id)
                        ->orderBy('id', 'desc')->paginate($this->perPage);
        foreach ($messages as $message) {
            if ($message->pivot->is_read == 0) {
                $message
                        ->users()
                        ->where('id_user', $sender->id)
                        ->where('id_message', $message->id)
                        ->updateExistingPivot($sender->id, ['is_read' => 1]);
            }
        }

        return view('conversations.show', ['title' => 'Αποστολή μηνύματος', 'conversation' => $conversation, 'sender' => $sender, 'recipient' => $recipient, 'messages' => $messages]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id) {
        $user = Auth::user();

        $conversation = Conversation::where('id', $id)
                ->whereHas('users', function ($query) use ($user) {
                    $query->where('id', $user->id);
                })
                ->firstOrFail();

        $deleteAllMessages = true;
        foreach ($conversation->messages as $message) {
            $message->users()->detach($user);
            if ($deleteAllMessages) {
                if (count($message->users) > 0) {
                    $deleteAllMessages = false;
                }
            }
        }
        if ($deleteAllMessages) {
            Message::where('id_conversation', $conversation->id)->delete();
        }

        $request->session()->flash('message', 'Η διαγραφή της συζήτησης πραγματοποιήθηκε επιτυχώς.');
        return redirect()->route('conversations.index');
    }

    private function getConversation($sender, $recipient) {
        $userConversation = Db::table('user_conversation')
                ->select('id_conversation')
                ->where('id_user', $recipient->id)
                ->orWhere('id_user', $sender->id)
                ->groupBy('id_conversation')
                ->havingRaw('count(*) > 1')
                ->first();

        if ($userConversation == null) {
            $conversation = new Conversation();
            $conversation->id = 0;
        } else {
            $conversation = Conversation::find($userConversation->id_conversation);
        }

        return $conversation;
    }

}
