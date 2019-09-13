<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Experience extends Model {

    protected $table = "experience";

    public function searches() {
        return $this->hasMany('App\Search', 'id_experience');
    }

}
