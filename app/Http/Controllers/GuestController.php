<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\User;

class GuestController extends Controller {

    public function show(Request $request, $id = null) {
        $user = User::findOrFail(Auth::user()->id);

        $birthdate = new Carbon($user->birthdate);
        $today = new Carbon(date('Y-m-d', time()));
        $user->age = $today->diffInYears($birthdate);

        return view('miniguest.show', ['user' => $user]);
    }

}
