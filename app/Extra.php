<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Extra extends Model {

    protected $table = "extra";

    public function userType() {
        return $this->belongsTo('App\UserType', 'id_user_type');
    }
}
