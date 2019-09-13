<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Conversation extends Model {

    protected $table = "conversation";

    public function user() {
        return $this->belongsTo('App\User', 'id_user');
    }

    public function users() {
        return $this->belongsToMany('App\User', 'user_conversation', 'id_conversation', 'id_user')->withTimestamps();
    }

    public function messages() {
        return $this->hasMany('App\Message', 'id_conversation');
    }

}
