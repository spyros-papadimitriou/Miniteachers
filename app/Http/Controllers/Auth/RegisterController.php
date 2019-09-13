<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
//use App\Http\Controllers\Auth\Request;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\User;
use App\Gender;
use App\UserStat;
use App\Events\Gamification\ActionEvent;
use App\UserType;

class RegisterController extends Controller {
    /*
      |--------------------------------------------------------------------------
      | Register Controller
      |--------------------------------------------------------------------------
      |
      | This controller handles the registration of new users as well as their
      | validation and creation. By default this controller uses a trait to
      | provide this functionality without requiring any additional code.
      |
     */

use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Request $request) {
        $this->middleware('guest');
	$this->request = $request;
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data) {
        return Validator::make($data, [
                    'gdpr' => ['accepted'],
                    'consent' => ['accepted']
                        ], [
                    'gdpr.accepted' => 'Πρέπει να διαβάσετε τη σελίδα προσωπικά δεδομένα - GDPR πριν κάνετε εγγραφή.',
                    'consent.accepted' => 'Πρέπει να δώσετε συγκατάθεση για συλλογή/επεξεργασία των δεδομένων σας πριν κάνετε εγγραφή.'
                        ]
        );
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data) {
	$request = $this->request;

        if ($request->session()->has('userSocial')) {
            $userSocial = $request->session()->pull('userSocial');
            $userType = UserType::findOrFail($request->userType);

            $user = User::create([
                        'name' => $userSocial->name,
                        'email' => $userSocial->email,
                        'password' => Hash::make(str_random(10)),
                        'id_user_type' => $request->userType,
                        'id_gender' => Gender::MALE,
                        'token' => str_random(40),
                        'confirmed' => 1
            ]);

            $userStat = new UserStat();
            $userStat->id = $user->id;
            $userStat->id_experience = 1;
            $userStat->id_level = 1;
            $userStat->published = $user->id_user_type == UserType::GUEST;
            $userStat->save();

            event(new ActionEvent(ActionEvent::CREATE_PROFILE, $request, $user));
            return $user;
        }
    }

    public function showRegistrationForm(Request $request) {
        if ($request->session()->has('userSocial')) {
            $userTypes = UserType::whereNotIn('id', [1])->get();

            return view('auth.register', ['userSocial' => $request->session()->get('userSocial'), 'userTypes' => $userTypes]);
        } else {
            return redirect()->route('home');
        }
    }

}
