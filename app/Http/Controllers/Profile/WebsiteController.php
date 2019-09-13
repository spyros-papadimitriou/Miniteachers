<?php

namespace App\Http\Controllers\Profile;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\User;
use App\UserType;
use App\Website;

class WebsiteController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $user = User::findOrFail(Auth::user()->id);

        return view('profile.websites.index', ['menu' => 'websites', 'user' => $user, 'title' => 'Επεξεργασία προφίλ - Ιστοσελίδες']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $user = User::findOrFail(Auth::user()->id);
        $websites = Website::all();

        return view('profile.websites.create', ['menu' => 'websites', 'user' => $user, 'websites' => $websites, 'title' => 'Επεξεργασία προφίλ - Ιστοσελίδες']);
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

        $website = Website::findOrFail($request->website);
        if ($user->websites->contains($website)) {
            $user->websites()->detach($website);
        }
        $user->websites()->attach($website, ['value' => $request->value]);

        $request->session()->flash('message', 'Η αποθήκευση πραγματοποιήθηκε επιτυχώς.');
        return redirect()->route('profile.websites.index');
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
        $website = $user->websites()->findOrFail($id);

        return view('profile.websites.edit', ['menu' => 'websites', 'user' => $user, 'website' => $website, 'title' => 'Επεξεργασία προφίλ - Ιστοσελίδες']);
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

        $user->websites()->updateExistingPivot($id, ['value' => $request->value]);
        $request->session()->flash('message', 'Η αποθήκευση πραγματοποιήθηκε επιτυχώς.');

        return redirect()->route('profile.websites.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id) {
        $user = User::findOrFail(Auth::user()->id);
        $website = Website::findOrFail($id);
        $user->websites()->detach($website);

        $request->session()->flash('message', 'Η εγγραφή για την ιστοσελίδα "' . $website->name . '" διαγράφηκε επιτυχώς.');
        return redirect()->route('profile.websites.index');
    }

    private function validateRequest(Request $request) {
        $request->validate([
            'value' => 'required|max:128'
                ], ['value.required' => 'Δεν έχετε συμπληρώσει την τιμή της ιστοσελίδας.', 'value.max' => 'Η τιμή της ιστοσελίδας πρέπει να περιέχει το πολύ 128 χαρακτήρες.']);
    }

}
