<?php

namespace App\Http\Controllers\Profile;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManagerStatic as Image;
use App\Http\Controllers\Controller;
use App\User;
use App\Gender;
use App\Experience;
use App\UserType;

class BasicInfoController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $user = User::findOrFail(Auth::user()->id);
        $genders = Gender::all();
        $experiences = Experience::all();
        if ($user->id_user_type == UserType::ADMIN) {
            $userTypes = UserType::all();
        } else {
            $userTypes = UserType::whereNotIn('id', [UserType::ADMIN])->get();
        }

        return view('profile.basic-info.edit', ['menu' => 'basic-info', 'user' => $user, 'genders' => $genders, 'experiences' => $experiences, 'userTypes' => $userTypes, 'title' => 'Επεξεργασία προφίλ - Βασικές πληροφορίες']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $request->validate([
            'name' => 'required|max:64',
            'birthdate' => 'required|date|before_or_equal:' . (date('Y', time()) - 18) . '-' . date('m', time()) . '-' . date('d', time()),
            'pricePerHour' => 'required|digits_between:0,50'
                ], ['name.required' => 'Δεν έχετε συμπληρώσει όνομα.',
            'name.max' => 'Το όνομα πρέπει να περιέχει το πολύ 64 χαρακτήρες.',
            'birthdate.required' => 'Δεν έχετε συμπληρώσει ημερομηνία γέννησης.',
            'birthdate.date' => 'Η ημερομηνία γέννησης πρέπει να είναι της μορφής yyyy-mm-dd.',
            'before_or_equal' => 'Η ημερομηνία γέννησης πρέπει να είναι τουλάχιστον 18 χρόνια πριν τη σημερινή ημέρα.',
            'pricePerHour.digits_between' => 'Η τιμή δέχεται τιμές από 0 (συζητήσιμη) έως 50.']);

        // User
        $user = User::findOrFail(Auth::user()->id);
        $user->name = $request->name;
        $gender = Gender::findOrFail($request->gender);
        $user->gender()->associate($gender);
	if ($user->id_user_type <> UserType::ADMIN)
        	$userType = UserType::where('id', $request->userType)->whereNotIn('id', [UserType::ADMIN])->first();
	else
		$userType = UserType::findOrFail($request->userType);
        $user->userType()->associate($userType);

        // Picture
        if ($request->deletePicture) {
            File::delete('uploads/users/' . $user->picture);
            $user->picture = null;
        } elseif ($request->hasFile('picture')) {
            File::delete('uploads/users/' . $user->picture);
            $user->picture = null;

            $picture = $request->file('picture');
            $filename = $picture->hashName();
            $path = 'uploads/users/' . $filename;

            Image::make($picture->getRealPath())->widen(300)->save($path);
            $user->picture = $filename;
        }
        $user->birthdate = $request->birthdate;
        $user->save();

        // User Stat
        $experience = Experience::findOrFail($request->experience);
        $user->userStat->experience()->associate($experience);
        if ((int) $request->pricePerHour <= 0) {
            $user->userStat->price_per_hour = null;
        } else if ((int) $request->pricePerHour > 50) {
            $user->userStat->price_per_hour = 50;
        } else {
            $user->userStat->price_per_hour = (int) $request->pricePerHour;
        }
        $user->userStat->published = ($request->published == 1 ? 1 : 0);
        $user->userStat->save();

        $request->session()->flash('message', 'Η αποθήκευση πραγματοποιήθηκε επιτυχώς.');
        return redirect()->route('profile.basic-info.edit', ['user' => $user->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //
    }

}
