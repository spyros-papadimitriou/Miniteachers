<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Postgraduate extends Model {

    protected $table = "postgraduate";

    public function user() {
        return $this->belongsTo('App\User', 'id_user');
    }

}
