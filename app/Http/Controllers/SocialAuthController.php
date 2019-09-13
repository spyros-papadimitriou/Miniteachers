<?php

namespace App\Http\Controllers;

use Laravel\Socialite\Facades\Socialite;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use App\User;

class SocialAuthController extends Controller {

    public function login($service) {
        return Socialite::driver($service)->redirect();
    }

    public function callback(Request $request, $service) {
        // $userSocial = Socialite::with($service)->user();
        $userSocial = Socialite::driver($service)->stateless()->user();

        $user = User::where('email', $userSocial->email)->first();

        if ($user == null) {
            $request->session()->put('email', $userSocial->email);
            $request->session()->put('name', $userSocial->name);
            $request->session()->put('userSocial', $userSocial);

            return redirect()->route('register');
        } else {
            $user->login_date = Carbon::now();
            $user->save();

            Auth::loginUsingId($user->id, true);
            return redirect()->route('home');
        }
    }

}
