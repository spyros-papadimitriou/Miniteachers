<?php

namespace App\Http\Controllers\Cms;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\RegionalUnit;
use App\Municipality;

class RegionalUnitMunicipalityController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($regionalUnitId) {
        $regionalUnit = RegionalUnit::findOrFail($regionalUnitId);
        $region = $regionalUnit->region;
        $municipalities = $regionalUnit->municipalities;

        return view('cms.municipalities.index', ['region' => $region, 'regionalUnit' => $regionalUnit, 'municipalities' => $municipalities]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($regionalUnitId) {
        $regionalUnit = RegionalUnit::findOrFail($regionalUnitId);
        $region = $regionalUnit->region;

        return view('cms.municipalities.create', ['region' => $region, 'regionalUnit' => $regionalUnit]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $regionalUnitId) {
        $regionalUnit = RegionalUnit::findOrFail($regionalUnitId);

        $municipality = new Municipality;
        $municipality->id_regional_unit = $regionalUnit->id;
        $municipality->name = $request->name;
        $municipality->save();

        $request->session()->flash('message', 'Η εγγραφή δημιουργήθηκε με επιτυχία.');
        return redirect()->route('cms.regional_units.municipalities.index', ['regional_unit' => $regionalUnit->id]);
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
    public function edit($regionalUnitid, $municipalityId) {
        $municipality = Municipality::findOrFail($municipalityId);

        return view('cms.municipalities.edit')->with('region', $municipality->regionalUnit->region)->with('regionalUnit', $municipality->regionalUnit)->with('municipality', $municipality);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $regionalUnitId, $municipalityId) {
        $regionalUnit = RegionalUnit::findOrFail($regionalUnitId);

        $municipality = Municipality::findOrFail($municipalityId);
        $municipality->name = $request->name;
        $municipality->save();

        $request->session()->flash('message', 'Η εγγραφή με id ' . $municipality->id . ' ενημερώθηκε με επιτυχία.');
        return redirect()->route('cms.regional_units.municipalities.index', ['regionalUnit' => $municipality->regionalUnit->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $regionalUnitId, $municipalityId) {
        $regionalUnit = RegionalUnit::findOrFail($regionalUnitId);

        $municipality = Municipality::findOrFail($municipalityId);
        $municipality->delete();

        $request->session()->flash('message', 'Η εγγραφή "' . $municipality->name . '" διαγράφηκε με επιτυχία.');
        return redirect()->route('cms.regional_units.municipalities.index', ['regional_unit' => $regionalUnit->id]);
    }

}
