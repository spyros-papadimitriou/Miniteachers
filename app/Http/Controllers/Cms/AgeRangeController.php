<?php

namespace App\Http\Controllers\Cms;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\AgeRange;

class AgeRangeController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $ageRangers = AgeRange::all();

        return view('cms.age_ranges.index', ['ageRanges' => $ageRangers]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('cms.age_ranges.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $request->validate(['description' => 'required'], ['description.required' => "Δεν έχετε  συμπληρώσει το πεδίο 'περιγραφή'."]);

        $ageRange = new AgeRange;
        $ageRange->age_from = $request->age_from;
        $ageRange->age_to = $request->age_to;
        $ageRange->description = $request->description;
        $ageRange->save();

        $request->session()->flash('message', 'Η εγγραφή δημιουργήθηκε με επιτυχία.');
        return redirect()->route('cms.age_ranges.index');
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
        $ageRange = AgeRange::findOrFail($id);

        return view('cms.age_ranges.edit', ['ageRange' => $ageRange]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $request->validate(['description' => 'required'], ['description.required' => "Δεν έχετε  συμπληρώσει το πεδίο 'περιγραφή'."]);

        $ageRange = AgeRange::findOrFail($id);
        $ageRange->age_from = $request->age_from;
        $ageRange->age_to = $request->age_to;
        $ageRange->description = $request->description;
        $ageRange->save();

        $request->session()->flash('message', 'Η εγγραφή με id ' . $id . ' ενημερώθηκε με επιτυχία.');
        return redirect()->route('cms.age_ranges.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id) {
        $ageRange = AgeRange::findOrFail($id);
        $ageRange->delete();

        $request->session()->flash('message', 'Η εγγραφή με id "' . $ageRange->id . '" διαγράφηκε με επιτυχία.');
        return redirect()->route('cms.age_ranges.index');
    }

}
