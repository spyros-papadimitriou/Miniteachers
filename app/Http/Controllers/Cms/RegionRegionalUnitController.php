<?php

namespace App\Http\Controllers\Cms;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Region;
use App\RegionalUnit;

class RegionRegionalUnitController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($regionId) {
        $region = Region::findOrFail($regionId);
        $regionalUnits = $region->regionalUnits()->withCount('municipalities')->get();

        return view('cms.regional_units.index', ['region' => $region, 'regionalUnits' => $regionalUnits]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($regionId) {
        $region = Region::findOrFail($regionId);

        return view('cms.regional_units.create', ['region' => $region]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $regionId) {
        $region = Region::findOrFail($regionId);

        $regionalUnit = new RegionalUnit;
        $regionalUnit->id_region = $region->id;
        $regionalUnit->name = $request->name;
        $regionalUnit->save();

        $request->session()->flash('message', 'Η εγγραφή δημιουργήθηκε με επιτυχία.');
        return redirect()->route('cms.regions.regional_units.index', ['region' => $region->id]);
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
    public function edit($regionId, $regionalUnitId) {
        $regionalUnit = RegionalUnit::findOrFail($regionalUnitId);

        return view('cms.regional_units.edit')->with('region', $regionalUnit->region)->with('regionalUnit', $regionalUnit);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $regionId, $regionalUnitId) {
        $region = Region::findOrFail($regionId);

        $regionalUnit = RegionalUnit::findOrFail($regionalUnitId);
        $regionalUnit->name = $request->name;
        $regionalUnit->save();

        $request->session()->flash('message', 'Η εγγραφή με id ' . $regionalUnit->id . ' ενημερώθηκε με επιτυχία.');
        return redirect()->route('cms.regions.regional_units.index', ['region' => $region->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $regionId, $regionalUnitId) {
        $region = Region::findOrFail($regionId);

        $regionalUnit = RegionalUnit::findOrFail($regionalUnitId);
        if ($regionalUnit->municipalities->count())
            $request->session()->flash('message', 'Η εγγραφή "' . $regionalUnit->name . '" δεν μπορεί να διαγραφεί διότι συσχετίζεται με Δήμους.');
        else {
            $regionalUnit->delete();
            $request->session()->flash('message', 'Η εγγραφή "' . $regionalUnit->name . '" διαγράφηκε με επιτυχία.');
        }

        return redirect()->route('cms.regions.regional_units.index', ['region' => $region->id]);
    }

}
