<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model {

    protected $table = "department";

    public function school() {
        return $this->belongsTo('App\School', 'id_school');
    }

    public function searches() {
        return $this->belongsToMany('App\Search', 'search_department', 'id_department', 'id_search');
    }

    public function users() {
        return $this->belongsToMany('App\User', 'user_department', 'id_department', 'id_user');
    }

}
