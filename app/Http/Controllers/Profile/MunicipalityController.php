<?php

namespace App\Http\Controllers\Profile;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\User;
use App\UserType;
use App\Municipality;
use App\Region;

class MunicipalityController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $user = User::findOrFail(Auth::user()->id);

        return view('profile.municipalities.index', ['menu' => 'municipalities', 'user' => $user, 'title' => 'Επεξεργασία προφίλ - Δήμοι']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $user = User::findOrFail(Auth::user()->id);
        $regions = Region::all();


        return view('profile.municipalities.create', ['menu' => 'municipalities', 'user' => $user, 'regions' => $regions, 'title' => 'Επεξεργασία προφίλ - Δήμοι']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $request->validate(['municipalities' => 'max:20'], ['municipalities.max' => 'Μπορείτε να δηλώσετε μέχρι 20 δήμους το πολύ.']);

        $user = User::findOrFail(Auth::user()->id);
        $municipalities = Municipality::find($request->municipalities);

        $user->municipalities()->detach();
        $user->municipalities()->attach($municipalities);

        $request->session()->flash('message', 'Η αποθήκευση πραγματοποιήθηκε επιτυχώς.');
        return redirect()->route('profile.municipalities.index');
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
        $user = User::findOrFail(Auth::user()->id);
        $municipality = Municipality::findOrFail($id);
        $user->municipalities()->detach($municipality);

        $request->session()->flash('message', 'Η εγγραφή "' . $municipality->name . ' (' . $municipality->regionalUnit->name . ')" διαγράφηκε επιτυχώς.');
        return redirect()->route('profile.municipalities.index');
    }

}
