<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CourseCategory extends Model {

    protected $table = "course_category";

    public function courses() {
        return $this->hasMany('App\Course', 'id_course_category');
    }

}
