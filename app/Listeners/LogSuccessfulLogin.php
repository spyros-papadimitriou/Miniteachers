<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Events\Gamification\ActionEvent;

class LogSuccessfulLogin {

    private $request;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(Request $request) {
        $this->request = $request;
    }

    /**
     * Handle the event.
     *
     * @param  Login  $event
     * @return void
     */
    public function handle(Login $event) {
        event(new ActionEvent(ActionEvent::LOGIN_CURRENT_DATE, $this->request, $event->user));
    }

}
