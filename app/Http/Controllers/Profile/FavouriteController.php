<?php

namespace App\Http\Controllers\Profile;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\UserType;

class FavouriteController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $user = User::findOrFail(Auth::user()->id);

        return view('profile.favourites.index', ['menu' => 'favourites', 'user' => $user, 'title' => 'Επεξεργασία προφίλ - Λίστα με αγαπημένους miniteachers']);
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id) {
        $user = User::where('id', Auth::user()->id)->where('id_user_type', '<=', UserType::GUEST)->firstOrFail();
        $teacher = User::where('id', $id)->where('id_user_type', UserType::TEACHER)->first();
        $user->favourites()->detach($teacher);

        $request->session()->flash('message', 'Ο miniteacher "' . $teacher->name . '" αφαιρέθηκε επιτυχώς από τη λίστα με τους αγαπημένους σας.');
        return redirect()->route('profile.favourites.index');
    }

}
