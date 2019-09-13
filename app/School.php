<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class School extends Model {

    protected $table = "school";

    public function institution() {
        return $this->belongsTo('App\Institution', 'id_institution');
    }

    public function departments() {
        return $this->hasMany('App\Department', 'id_school');
    }

}
