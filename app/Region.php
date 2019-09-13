<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Region extends Model {

    protected $table = "region";

    public function regionalUnits() {
        return $this->hasMany('App\RegionalUnit', 'id_region');
    }

}
