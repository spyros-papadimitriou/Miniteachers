<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tip extends Model {

    protected $table = "tip";

    public function agent() {
        return $this->belongsTo('App\Agent', 'id_agent');
    }

}
