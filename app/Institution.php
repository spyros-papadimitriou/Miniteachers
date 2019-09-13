<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Institution extends Model {

    protected $table = "institution";

    public function schools() {
        return $this->hasMany('App\School', 'id_institution');
    }

}
