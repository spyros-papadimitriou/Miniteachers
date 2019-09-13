<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model {

    protected $table = "message";

    public function users() {
        return $this->belongsToMany('App\User', 'user_message', 'id_message', 'id_user')->withTimestamps();
    }

    public function conversation() {
        return $this->belongsTo('App\Conversation', 'id_conversation');
    }

    public function user() {
        return $this->belongsTo('App\User', 'id_user');
    }

}
