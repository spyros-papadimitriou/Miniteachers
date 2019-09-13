<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NotificationType extends Model {

    protected $table = "notification_type";

    public function notifications() {
        return $this->hasMany('App\Notification', 'id_notification_type');
    }

}
