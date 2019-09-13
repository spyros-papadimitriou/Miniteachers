<?php

namespace App\Http\Controllers\Profile;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\User;
use App\UserType;
use App\Phd;

class PhdController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $user = User::findOrFail(Auth::user()->id);

        return view('profile.phds.index', ['menu' => 'phds', 'user' => $user, 'title' => 'Επεξεργασία προφίλ - Διδακτορικές σπουδές']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $user = User::findOrFail(Auth::user()->id);

        return view('profile.phds.create', ['menu' => 'phds', 'user' => $user, 'title' => 'Επεξεργασία προφίλ - Διδακτορικές σπουδές']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $user = User::findOrFail(Auth::user()->id);
        $this->validateRequest($request);

        if (count($user->phds) < 2) {
            $phd = new Phd;
            $phd->id_user = $user->id;
            $phd->name = $request->name;
            $phd->endyear = $request->endyear;

            $phd->save();
            $request->session()->flash('message', 'Η αποθήκευση πραγματοποιήθηκε επιτυχώς.');
        } else {
            $request->session()->flash('message', 'Έχετε ήδη 2 εγγραφές.');
        }
        return redirect()->route('profile.phds.index');
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
        $phd = Phd::where('id_user', $user->id)->where('id', $id)->firstOrFail();

        return view('profile.phds.edit', ['menu' => 'phds', 'user' => $user, 'phd' => $phd, 'title' => 'Επεξεργασία προφίλ - Διδακτορικές σπουδές']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $user = User::findOrFail(Auth::user()->id);
        $this->validateRequest($request);

        $phd = Phd::where('id', $id)->where('id_user', $user->id)->firstOrFail();
        $phd->name = $request->name;
        $phd->endyear = $request->endyear;

        $phd->save();
        $request->session()->flash('message', 'Η αποθήκευση πραγματοποιήθηκε επιτυχώς.');
        return redirect()->route('profile.phds.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id) {
        $user = User::findOrFail(Auth::user()->id);
        $phd = Phd::where('id', $id)->where('id_user', $user->id)->firstOrFail();
        $phd->delete();

        $request->session()->flash('message', 'Η εγγραφή με όνομα "' . $phd->name . '" διαγράφηκε επιτυχώς.');
        return redirect()->route('profile.phds.index');
    }

    private function validateRequest(Request $request) {
        $currentYear = date('Y', time());

        $request->validate([
            'name' => 'required|max:64',
            'endyear' => 'nullable|integer|between:1970,' . $currentYear
                ], ['name.required' => 'Δεν έχετε συμπληρώσει το όνομα της διδακτορικής διατριβής.', 'name.max' => 'Το θέμα της διδακτορικής διατριβής πρέπει να περιέχει το πολύ μέχρι 64 χαρακτήρες.',
            'endyear.between' => 'Το έτος αποφοίτησης δέχεται τιμές από 1970 έως ' . $currentYear . "."]);
    }

}
