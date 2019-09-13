<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider {

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot() {
        View::composer(
                'layouts.app', 'App\Http\View\Composers\MenuComposer'
        );
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
