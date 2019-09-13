<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserStat extends Model {

    protected $table = "user_stat";

    public function experience() {
        return $this->belongsTo('App\Experience', 'id_experience');
    }

    public function level() {
        return $this->belongsTo('App\Level', 'id_level');
    }

}
