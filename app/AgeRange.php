<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AgeRange extends Model {

    protected $table = "age_range";

    public function searches() {
        return $this->hasMany('App\Search', 'id_age_range');
    }

}
