<?php

namespace App\Http\Controllers\Cms;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;
use App\Institution;

class InstitutionController extends Controller {

    public function index() {
        $institutions = Institution::withCount('schools')->get();
        foreach ($institutions as $institution) {
            if (Storage::exists('institutions/' . $institution->id . '.png')) {
                $institution->picture = asset('storage/institutions/' . $institution->id . '.png');
            } else {
                $institution->picture = asset('svg/university.svg');
            }
        }

        return view('cms.institutions.index', ['institutions' => $institutions]);
    }

    public function show($id) {
        return redirect()->route('cms.institutions.index');
    }

    public function create() {
        return view('cms.institutions.create');
    }

    public function store(Request $request) {
        $institution = new Institution;
        $institution->name = $request->name;
        $institution->url = $request->url;
        $institution->save();
        $this->createPicture($request, $institution);

        $request->session()->flash('message', 'Η εγγραφή δημιουργήθηκε με επιτυχία.');
        return redirect()->route('cms.institutions.index');
    }

    public function edit($id) {
        $institution = Institution::findOrFail($id);
        if (Storage::exists('institutions/' . $institution->id . '.png'))
            $institution->picture = asset('storage/institutions/' . $institution->id . '.png');

        return view('cms.institutions.edit', ['institution' => $institution]);
    }

    public function update(Request $request, $id) {
        $institution = Institution::findOrFail($id);
        $institution->name = $request->name;
        $institution->url = $request->url;
        $institution->save();
        $this->createPicture($request, $institution);

        $request->session()->flash('message', 'Η εγγραφή με id ' . $id . ' ενημερώθηκε με επιτυχία.');
        return redirect()->route('cms.institutions.index');
    }

    public function destroy(Request $request, $id) {
        $institution = Institution::findOrFail($id);

        if ($institution->schools->count())
            $request->session()->flash('message', 'Η εγγραφή "' . $institution->name . '" δεν μπορεί να διαγραφεί διότι συσχετίζεται με Σχολές.');
        else {
            $institution->delete();
            $request->session()->flash('message', 'Η εγγραφή "' . $institution->name . '" διαγράφηκε με επιτυχία.');
        }return redirect()->route('cms.institutions.index');
    }

    private function createPicture($request, $institution) {
        if ($request->hasFile('picture')) {
            $picture = $request->file('picture');
            if ($picture->getClientOriginalExtension() == "png") {
                $path = storage_path('app/public/institutions/') . $institution->id . '.png';
                Image::make($picture->getRealPath())->heighten(64)->save($path);
            }
        }
    }

}
