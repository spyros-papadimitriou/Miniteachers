<?php

namespace App\Http\Controllers\Cms;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Experience;

class ExperienceController extends Controller {

    public function index() {
        $experiences = Experience::all();

        return view('cms.experiences.index', ['experiences' => $experiences]);
    }

    public function show($id) {
        return redirect()->route('cms.experiences.index');
    }

    public function create() {
        return view('cms.experiences.create');
    }

    public function store(Request $request) {
        $experience = new Experience;
        $experience->name = $request->name;
        $experience->save();

        $request->session()->flash('message', 'Η εγγραφή δημιουργήθηκε με επιτυχία.');
        return redirect()->route('cms.experiences.index');
    }

    public function edit($id) {
        $experience = Experience::findOrFail($id);

        return view('cms.experiences.edit', ['experience' => $experience]);
    }

    public function update(Request $request, $id) {
        $experience = Experience::findOrFail($id);
        $experience->name = $request->name;
        $experience->save();

        $request->session()->flash('message', 'Η εγγραφή με id ' . $id . ' ενημερώθηκε με επιτυχία.');
        return redirect()->route('cms.experiences.index');
    }

    public function destroy(Request $request, $id) {
        $experience = Experience::findOrFail($id);
        $experience->delete();

        $request->session()->flash('message', 'Η εγγραφή "' . $experience->name . '" διαγράφηκε με επιτυχία.');
        return redirect()->route('cms.experiences.index');
    }

}
