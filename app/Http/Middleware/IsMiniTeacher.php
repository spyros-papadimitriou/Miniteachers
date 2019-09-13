<?php

namespace App\Http\Middleware;

use Closure;
use App\UserType;

class IsMiniTeacher {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
        if (auth()->user() && auth()->user()->id_user_type == UserType::TEACHER) {
            return $next($request);
        } else {
            abort(403, 'Μη εξουσιοδοτημένη ενέργεια.');
        }
    }

}
