<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AchievementType extends Model {

    protected $table = "achievement_type";

    public function achievements() {
        return $this->hasMany('App\Achievement', 'id_achievement_type');
    }

}
