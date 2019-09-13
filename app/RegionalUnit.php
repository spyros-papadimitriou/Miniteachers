<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RegionalUnit extends Model {

    protected $table = "regional_unit";

    public function region() {
        return $this->belongsTo('App\Region', 'id_region');
    }

    public function municipalities() {
        return $this->hasMany('App\Municipality', 'id_regional_unit');
    }

    public function searches() {
        return $this->hasMany('App\Search', 'id_regional_unit');
    }

}
