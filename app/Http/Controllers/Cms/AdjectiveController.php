<?php

namespace App\Http\Controllers\Cms;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Adjective;

class AdjectiveController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $adjectives = Adjective::all();

        return view('cms.adjectives.index', ['adjectives' => $adjectives]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('cms.adjectives.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $adjective = new Adjective;
        $adjective->name_male = $request->name_male;
        $adjective->name_female = $request->name_female;
        $adjective->description_male = $request->description_male;
        $adjective->description_female = $request->description_female;
        $adjective->save();

        $request->session()->flash('message', 'Η εγγραφή δημιουργήθηκε με επιτυχία.');
        return redirect()->route('cms.adjectives.index');
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
        $adjective = Adjective::findOrFail($id);

        return view('cms.adjectives.edit', ['adjective' => $adjective]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $adjective = Adjective::findOrFail($id);
        $adjective->name_male = $request->name_male;
        $adjective->name_female = $request->name_female;
        $adjective->description_male = $request->description_male;
        $adjective->description_female = $request->description_female;
        $adjective->save();

        $request->session()->flash('message', 'Η εγγραφή με id ' . $id . ' ενημερώθηκε με επιτυχία.');
        return redirect()->route('cms.adjectives.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id) {
        $adjective = Adjective::findOrFail($id);
        $adjective->delete();

        $request->session()->flash('message', 'Η εγγραφή "' . $adjective->name . '" διαγράφηκε με επιτυχία.');
        return redirect()->route('cms.adjectives.index');
    }

}
