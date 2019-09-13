<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserAction extends Model {

    protected $table = "user_action";

    public function user() {
        return $this->belongsTo('App\User', 'id_user');
    }

    public function otherUser() {
        return $this->belongsTo('App\User', 'id_other_user');
    }

    public function action() {
        return $this->belongsTo('App\Action', 'id_action');
    }

    public function achievement() {
        return $this->belongsTo('App\Achievement', 'id_achievement');
    }
}
