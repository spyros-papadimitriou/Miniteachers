<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TargetGroup extends Model {

    protected $table = "target_group";

    public function searches() {
        return $this->hasMany('App\Search', 'id_target_group');
    }

    public function users() {
        return $this->belongsToMany('App\User', 'user_target_group', 'id_target_group', 'id_user');
    }

}
