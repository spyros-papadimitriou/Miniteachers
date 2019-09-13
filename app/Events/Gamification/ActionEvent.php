<?php

namespace App\Events\Gamification;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Http\Request;
use App\User;

class ActionEvent {

    use Dispatchable,
        InteractsWithSockets,
        SerializesModels;

    const VIEW_PROFILE_BY_GUEST = 1;
    const VIEW_PROFILE_BY_MINIUSER = 2;
    const LOGIN_CURRENT_DATE = 3;
    const CREATE_CONVERSATION_ΒY_YOU = 4;
    const CREATE_CONVERSATION_BY_OTHER = 5;
    const CREATE_PROFILE = 6;
    const ACHIEVEMENT = 7;

    public $actionId, $request, $user, $otherUser;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($actionId, Request $request, User $user, User $otherUser = null) {
        $this->actionId = $actionId;
        $this->request = $request;
        $this->user = $user;
        $this->otherUser = $otherUser;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn() {
        return new PrivateChannel('channel-name');
    }

}
