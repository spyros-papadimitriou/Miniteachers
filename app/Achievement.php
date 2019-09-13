<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Achievement extends Model {

    protected $table = "achievement";

    public function achievementType() {
        return $this->belongsTo('App\AchievementType', 'id_achievement_type');
    }

    public function users() {
        return $this->belongsToMany('App\User', 'user_achievement', 'id_achievement', 'id_user');
    }

}
