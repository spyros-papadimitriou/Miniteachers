<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserType extends Model {

    protected $table = "user_type";

    const ADMIN = 1;
    const TEACHER = 2;
    const GUEST = 3;

    public function users() {
        return $this->hasMany('App\User', 'id_user_type');
    }

    public function searches() {
        return $this->hasMany('App\Search', 'id_user_type');
    }

}
