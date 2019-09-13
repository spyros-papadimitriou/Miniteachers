<?php

namespace App\Http\Controllers\Profile;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\User;
use App\Extra;
use App\UserType;

class ExtraController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $user = User::findOrFail(Auth::user()->id);
        $extras = Extra::where('id_user_type', $user->id_user_type)->get();

        return view('profile.extra.index', ['menu' => 'extras', 'user' => $user, 'extras' => $extras, 'title' => 'Επεξεργασία προφίλ - Επιπλέον πληροφορίες']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $user = User::findOrFail(Auth::user()->id);
        $extras = Extra::where('id_user_type', $user->id_user_type)->get();

        return view('profile.extra.create', ['menu' => 'extras', 'user' => $user, 'extras' => $extras, 'title' => 'Επεξεργασία προφίλ - Επιπλέον πληροφορίες']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $user = User::findOrFail(Auth::user()->id);
        $this->validateRequest($request);

        $extra = Extra::where('id', $request->extra)->where('id_user_type', $user->id_user_type)->firstOrFail();
        if ($user->extras->contains($extra))
            $user->extras()->detach($extra);
        $user->extras()->attach($extra, ['content' => $request->content]);

        $request->session()->flash('message', 'Η αποθήκευση πραγματοποιήθηκε επιτυχώς.');
        return redirect()->route('profile.extra.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $user = User::findOrFail(Auth::user()->id);
        $extra = $user->extras()->findOrFail($id);

        return view('profile.extra.edit', ['menu' => 'extras', 'user' => $user, 'extra' => $extra, 'title' => 'Επεξεργασία προφίλ - Επιπλέον πληροφορίες']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $user = User::findOrFail(Auth::user()->id);

        $this->validateRequest($request);

        $user->extras()->updateExistingPivot($id, ['content' => $request->content]);
        $request->session()->flash('message', 'Η αποθήκευση πραγματοποιήθηκε επιτυχώς.');

        return redirect()->route('profile.extra.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id) {
        $user = User::findOrFail(Auth::user()->id);
        $extra = Extra::findOrFail($id);
        $user->extras()->detach($extra);

        $request->session()->flash('message', 'Η εγγραφή με τίτλο "' . $extra->description . '" διαγράφηκε επιτυχώς.');
        return redirect()->route('profile.extra.index');
    }

    private function validateRequest(Request $request) {
        $request->validate([
            'content' => 'required|max:1024'
                ], ['content.required' => 'Δεν έχετε συμπληρώσει περιγραφή.', 'content.max' => 'Το περιεχόμενο πρέπει να περιέχει το πολύ 1024 χαρακτήρες.']);
    }

}
