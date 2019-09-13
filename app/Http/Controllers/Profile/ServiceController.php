<?php

namespace App\Http\Controllers\Profile;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use App\User;
use App\UserType;
use App\Service;

class ServiceController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $user = User::findOrFail(Auth::user()->id);

        return view('profile.services.index', ['menu' => 'services', 'user' => $user, 'title' => 'Επεξεργασία προφίλ - Υπηρεσίες']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $user = User::findOrFail(Auth::user()->id);
        $services = Service::all();

        foreach ($services as $service) {
            if (Storage::exists('services/' . $service->id . '.svg')) {
                $service->picture = asset('storage/services/' . $service->id . '.svg');
            } else {
                $service->picture = asset('svg/services.svg');
            }
        }

        return view('profile.services.create', ['menu' => 'services', 'user' => $user, 'services' => $services, 'title' => 'Επεξεργασία προφίλ - Υπηρεσίες']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $user = User::findOrFail(Auth::user()->id);
        $services = Service::find($request->services);

        $user->services()->detach();
        $user->services()->attach($services);

        $request->session()->flash('message', 'Η αποθήκευση πραγματοποιήθηκε επιτυχώς.');
        return redirect()->route('profile.services.index');
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
        $service = Service::findOrFail($id);
        $user->services()->detach($service);

        $request->session()->flash('message', 'Η εγγραφή "' . $service->name . '" διαγράφηκε επιτυχώς.');
        return redirect()->route('profile.services.index');
    }

}
