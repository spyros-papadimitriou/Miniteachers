<?php

namespace App\Http\Controllers\Cms;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Extra;
use App\UserType;

class ExtraController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $extras = Extra::all();

        return view('cms.extras.index', ['extras' => $extras]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $userTypes = UserType::all();

        return view('cms.extras.create', ['userTypes' => $userTypes]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $userType = UserType::findOrFail($request->userType);

        $extra = new Extra;
        $extra->description = $request->description;
        $extra->userType()->associate($userType);
        $extra->save();

        $request->session()->flash('message', 'Η εγγραφή δημιουργήθηκε με επιτυχία.');
        return redirect()->route('cms.extras.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        return redirect()->route('cms.extras.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $extra = Extra::findOrFail($id);
        $userTypes = UserType::all();

        return view('cms.extras.edit', ['extra' => $extra, 'userTypes' => $userTypes]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $userType = UserType::findOrFail($request->userType);
        $extra = Extra::findOrFail($id);
        $extra->userType()->associate($userType);
        $extra->description = $request->description;
        $extra->save();

        $request->session()->flash('message', 'Η εγγραφή με id ' . $id . ' ενημερώθηκε με επιτυχία.');
        return redirect()->route('cms.extras.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id) {
        $extra = Extra::findOrFail($id);
        $extra->delete();

        $request->session()->flash('message', 'Η εγγραφή "' . $extra->description . '" διαγράφηκε με επιτυχία.');
        return redirect()->route('cms.extras.index');
    }

}
