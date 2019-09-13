<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\UserType;

class User extends Authenticatable {

    use Notifiable;

    protected $table = 'user';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'id_user_type', 'id_gender', 'token', 'confirmed', 'birthdate'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function isAdmin() {
        return $this->id_user_type == UserType::ADMIN;
    }

    public function userType() {
        return $this->belongsTo('App\UserType', 'id_user_type');
    }

    public function gender() {
        return $this->belongsTo('App\Gender', 'id_gender');
    }

    public function courses() {
        return $this->belongsToMany('App\Course', 'user_course', 'id_user', 'id_course')->withTimestamps();
    }

    public function targetGroups() {
        return $this->belongsToMany('App\TargetGroup', 'user_target_group', 'id_user', 'id_target_group')->withTimestamps();
    }

    public function userStat() {
        return $this->belongsTo('App\UserStat', 'id');
    }

    public function services() {
        return $this->belongsToMany('App\Service', 'user_service', 'id_user', 'id_service')->withTimestamps();
    }

    public function departments() {
        return $this->belongsToMany('App\Department', 'user_department', 'id_user', 'id_department')->withPivot('endyear')->withTimestamps();
    }

    public function postgraduates() {
        return $this->hasMany('App\Postgraduate', 'id_user');
    }

    public function phds() {
        return $this->hasMany('App\Phd', 'id_user');
    }

    public function municipalities() {
        return $this->belongsToMany('App\Municipality', 'user_municipality', 'id_user', 'id_municipality')->withTimestamps();
    }

    public function contactData() {
        return $this->hasMany('App\ContactData', 'id_user');
    }

    public function websites() {
        return $this->belongsToMany('App\Website', 'user_website', 'id_user', 'id_website')->withPivot('value')->withTimestamps()->withTimestamps();
    }

    public function extras() {
        return $this->belongsToMany('App\Extra', 'user_extra', 'id_user', 'id_extra')->withPivot('content')->withTimestamps()->withTimestamps();
    }

    public function userActions() {
        return $this->hasMany('App\UserAction', 'id_user');
    }

    public function favourites() {
        return $this->belongsToMany('App\User', 'favourite', 'id_user_from', 'id_user_to')->withTimestamps();
    }

    public function conversations() {
        return $this->belongsToMany('App\Conversation', 'user_conversation', 'id_user', 'id_conversation')->withTimestamps();
    }

    public function messages() {
        return $this->hasMany('App\Message', 'id_user');
    }

    public function userMessages() {
        return $this->belongsToMany('App\Message', 'user_message', 'id_user', 'id_message')->withPivot(['is_read', 'important'])->withTimestamps();
    }

    public function achievements() {
        return $this->belongsToMany('App\Achievement', 'user_achievement', 'id_user', 'id_achievement')->withTimestamps();
    }

    public function notifications() {
        return $this->hasMany('App\Notification', 'id_user');
    }

    public function adjectives() {
        return $this->belongsToMany('App\Adjective', 'user_adjective', 'id_user', 'id_adjective')->withTimestamps();
    }

}
