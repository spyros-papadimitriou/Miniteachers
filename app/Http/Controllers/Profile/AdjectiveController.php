<?php

namespace App\Http\Controllers\Profile;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Adjective;

class AdjectiveController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $user = User::findOrFail(Auth::user()->id);

        return view('profile.adjectives.index', ['menu' => 'adjectives', 'user' => $user, 'title' => 'Επεξεργασία προφίλ - Στοιχεία χαρακτήρα']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $user = User::findOrFail(Auth::user()->id);
        $adjectives = Adjective::all();

        return view('profile.adjectives.create', ['menu' => 'adjectives', 'user' => $user, 'adjectives' => $adjectives, 'title' => 'Επεξεργασία προφίλ - Στοιχεία χαρακτήρα']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $request->validate(['adjectives' => 'max:6'], ['adjectives.max' => 'Μπορείτε να δηλώσετε μέχρι 6 στοιχεία χαρακτήρα το πολύ.']);
        
        $user = User::findOrFail(Auth::user()->id);
        $adjectives = Adjective::find($request->adjectives);

        $user->adjectives()->detach();
        $user->adjectives()->attach($adjectives);

        $request->session()->flash('message', 'Η αποθήκευση πραγματοποιήθηκε επιτυχώς.');
        return redirect()->route('profile.adjectives.index');
    }

}
