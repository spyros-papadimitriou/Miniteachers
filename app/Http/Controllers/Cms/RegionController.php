<?php

namespace App\Http\Controllers\Cms;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Region;

class RegionController extends Controller {

    public function index() {
        $regions = Region::withCount('regionalUnits')->get();

        return view('cms.regions.index', ['regions' => $regions]);
    }

    public function show($id) {
        return redirect()->route('cms.regions.index');
    }

    public function create() {
        return view('cms.regions.create');
    }

    public function store(Request $request) {
        $region = new Region;
        $region->name = $request->name;
        $region->save();

        $request->session()->flash('message', 'Η εγγραφή δημιουργήθηκε με επιτυχία.');
        return redirect()->route('cms.regions.index');
    }

    public function edit($id) {
        $region = Region::findOrFail($id);

        return view('cms.regions.edit', ['region' => $region]);
    }

    public function update(Request $request, $id) {
        $region = Region::findOrFail($id);
        $region->name = $request->name;
        $region->save();

        $request->session()->flash('message', 'Η εγγραφή με id ' . $id . ' ενημερώθηκε με επιτυχία.');
        return redirect()->route('cms.regions.index');
    }

    public function destroy(Request $request, $id) {
        $region = Region::findOrFail($id);

        if ($region->regionalUnits->count())
            $request->session()->flash('message', 'Η εγγραφή "' . $region->name . '" δεν μπορεί να διαγραφεί διότι συσχετίζεται με Περιφερειακές Ενότητες.');
        else {
            $region->delete();
            $request->session()->flash('message', 'Η εγγραφή "' . $region->name . '" διαγράφηκε με επιτυχία.');
        }

        return redirect()->route('cms.regions.index');
    }

}
