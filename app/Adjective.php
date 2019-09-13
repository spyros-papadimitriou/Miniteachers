<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Adjective extends Model {

    protected $table = "adjective";

    public function searches() {
        return $this->belongsToMany('App\Search', 'search_adjective', 'id_adjective', 'id_search');
    }

    public function users() {
        return $this->belongsToMany('App\User', 'user_adjective', 'id_adjective', 'id_user');
    }

}
