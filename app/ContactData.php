<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContactData extends Model {

    protected $table = "contact_data";

    public function contactDataType() {
        return $this->belongsTo('App\ContactDataType', 'id_contact_data_type');
    }

}
