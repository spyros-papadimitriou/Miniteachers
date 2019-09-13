<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model {

    protected $table = "notification";

    public function user() {
        return $this->belongsTo('App\User', 'id_user');
    }

    public function notificationType() {
        return $this->belongsTo('App\NotificationType', 'id_notification_type');
    }

}
