<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model {

    protected $table = "service";

    public function searches() {
        return $this->belongsToMany('App\Search', 'search_service', 'id_service', 'id_search');
    }

    public function users() {
        return $this->belongsToMany('App\User', 'user_target_group', 'id_target_group', 'id_user');
    }

}
