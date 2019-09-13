<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Search extends Model {

    protected $table = "search";

    public function user() {
        return $this->belongsTo('App\User', 'id_user');
    }

    public function userType() {
        return $this->belongsTo('App\UserType', 'id_user_type');
    }

    public function gender() {
        return $this->belongsTo('App\Gender', 'id_gender');
    }

    public function ageRange() {
        return $this->belongsTo('App\AgeRange', 'id_age_range');
    }

    public function experience() {
        return $this->belongsTo('App\Experience', 'id_experience');
    }

    public function municipality() {
        return $this->belongsTo('App\Municipality', 'id_municipality');
    }

    public function regionalUnit() {
        return $this->belongsTo('App\RegionalUnit', 'id_regional_unit');
    }

    public function targetGroup() {
        return $this->belongsTo('App\TargetGroup', 'id_target_group');
    }

    public function services() {
        return $this->belongsToMany('App\Service', 'search_service', 'id_search', 'id_service')->withTimestamps();
    }

    public function departments() {
        return $this->belongsToMany('App\Department', 'search_department', 'id_search', 'id_department')->withTimestamps();
    }

    public function courses() {
        return $this->belongsToMany('App\Course', 'search_course', 'id_search', 'id_course')->withTimestamps();
    }

    public function websites() {
        return $this->belongsToMany('App\Website', 'search_website', 'id_search', 'id_website')->withTimestamps();
    }

    public function adjectives() {
        return $this->belongsToMany('App\Adjective', 'search_adjective', 'id_search', 'id_adjective')->withTimestamps();
    }

}
