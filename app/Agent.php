<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Agent extends Model {

    protected $table = "agent";

    public function tips() {
        return $this->hasMany('App\Tip', 'id_agent');
    }

}
