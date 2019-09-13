<?php

namespace App\Http\Controllers\Profile;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\User;
use App\UserType;
use App\Postgraduate;

class PostGraduateController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $user = User::findOrFail(Auth::user()->id);

        return view('profile.postgraduates.index', ['menu' => 'postgraduates', 'user' => $user, 'title' => 'Επεξεργασία προφίλ - Μεταπτυχιακές σπουδές']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $user = User::findOrFail(Auth::user()->id);

        return view('profile.postgraduates.create', ['menu' => 'postgraduates', 'user' => $user, 'title' => 'Επεξεργασία προφίλ - Μεταπτυχιακές σπουδές']);
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

        if (count($user->postgraduates) < 3) {
            $postgraduate = new Postgraduate;
            $postgraduate->id_user = $user->id;
            $postgraduate->name = $request->name;
            $postgraduate->endyear = $request->endyear;

            $postgraduate->save();
            $request->session()->flash('message', 'Η αποθήκευση πραγματοποιήθηκε επιτυχώς.');
        } else {
            $request->session()->flash('message', 'Έχετε ήδη 3 εγγραφές μεταπτυχιακών σπουδών.');
        }
        return redirect()->route('profile.postgraduates.index');
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
        $postgraduate = Postgraduate::where('id_user', $user->id)->where('id', $id)->firstOrFail();

        return view('profile.postgraduates.edit', ['menu' => 'postgraduates', 'user' => $user, 'postgraduate' => $postgraduate, 'title' => 'Επεξεργασία προφίλ - Μεταπτυχιακές σπουδές']);
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

        $postgraduate = Postgraduate::where('id', $id)->where('id_user', $user->id)->firstOrFail();
        $postgraduate->name = $request->name;
        $postgraduate->endyear = $request->endyear;

        $postgraduate->save();
        $request->session()->flash('message', 'Η αποθήκευση πραγματοποιήθηκε επιτυχώς.');
        return redirect()->route('profile.postgraduates.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id) {
        $user = User::findOrFail(Auth::user()->id);
        $postgraduate = Postgraduate::where('id', $id)->where('id_user', $user->id)->firstOrFail();
        $postgraduate->delete();

        $request->session()->flash('message', 'Η εγγραφή με όνομα "' . $postgraduate->name . '" διαγράφηκε επιτυχώς.');
        return redirect()->route('profile.postgraduates.index');
    }

    private function validateRequest(Request $request) {
        $currentYear = date('Y', time());

        $request->validate([
            'name' => 'required|max:64',
            'endyear' => 'nullable|integer|between:1970,' . $currentYear
                ], ['name.required' => 'Δεν έχετε συμπληρώσει το όνομα του μεταπτυχιακού.', 'name.max' => 'Το όνομα του μεταπτυχιακού πρέπει να περιέχει το πολύ 64 χαρακτήρες.',
            'endyear.between' => 'Το έτος αποφοίτησης δέχεται τιμές από 1970 έως ' . $currentYear . "."]);
    }

}
