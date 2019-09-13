<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Website extends Model {

    protected $table = "website";

    public function searches() {
        return $this->belongsToMany('App\Search', 'search_website', 'id_website', 'id_search');
    }

}
