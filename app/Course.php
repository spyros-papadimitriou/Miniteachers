<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model {

    protected $table = 'course';

    public function courseCategory() {
        return $this->belongsTo('App\CourseCategory', 'id_course_category');
    }

    public function users() {
        return $this->belongsToMany('App\User', 'user_course', 'id_course', 'id_user');
    }

    public function searches() {
        return $this->belongsToMany('App\Search', 'search_course', 'id_course', 'id_search')->withTimestamps();
    }

}
