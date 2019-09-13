<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gender extends Model {

    protected $table = "gender";

    const MALE = 1;
    const FEMALE = 2;

    public function users() {
        return $this->hasMany('App\User', 'id_gender');
    }

    public function searches() {
        return $this->hasMany('App\Search', 'id_gender');
    }

}
