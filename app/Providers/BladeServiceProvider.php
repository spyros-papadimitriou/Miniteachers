<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Storage;
use App\Tip;
use App\Agent;
use App\UserType;
use App\Gender;

class BladeServiceProvider extends ServiceProvider {

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot() {

        Blade::if('admin', function () {
        return auth()->check() && auth()->user()->id_user_type == UserType::ADMIN;
        });

        Blade::if('miniteacher', function () {
        return auth()->check() && auth()->user()->id_user_type == UserType::TEACHER;
        });

        Blade::if('miniguest', function () {
        return auth()->check() && auth()->user()->id_user_type == UserType::GUEST;
        });

        Blade::if('miniuser', function () {
        return auth()->check() && (auth()->user()->id_user_type == UserType::TEACHER || auth()->user()->id_user_type == UserType::GUEST);
        });
        
        Blade::if('male', function () {
        return auth()->check() && (auth()->user()->id_gender == Gender::MALE);
        });
        
        Blade::if('female', function () {
        return auth()->check() && (auth()->user()->id_gender == Gender::FEMALE);
        });

        Blade::directive('tip', function ($expression) {
            return "<?php \$tip = App\Tip::where('id', '$expression')->orWhere('alias', '$expression')->first(); if (\$tip != null ) { echo '<div class=\"card bg-light\"><div class=\"card-header\"><img alt=\"\" height=\"24\" src=\"'.asset('svg/info.svg').'\"> '.\$tip->title.'</div><div class=\"card-body\"><blockquote class=\"mb-0\">'.\$tip->content.'<footer class=\"blockquote-footer mt-3\">'.\$tip->agent->name.'</footer></blockquote></div></div><div class=\"text-center mt-3\"><img alt=\"'.\$tip->agent->name.'\" height=\"300\" src=\"'.asset('storage/agents/'.\$tip->agent->id.'.svg').'\"></div>'; } ?>";
        });
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register() {
        //
    }

}
