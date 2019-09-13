<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Municipality extends Model {

    protected $table = "municipality";

    public function regionalUnit() {
        return $this->belongsTo('App\RegionalUnit', 'id_regional_unit');
    }

    public function searches() {
        return $this->hasMany('App\Search', 'id_municipality');
    }

    public function users() {
        return $this->belongsToMany('App\User', 'user_municipality', 'id_municipality', 'id_user');
    }

}
