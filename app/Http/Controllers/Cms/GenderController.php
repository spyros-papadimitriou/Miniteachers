<?php

// https://scotch.io/tutorials/simple-laravel-crud-with-resource-controllers

namespace App\Http\Controllers\Cms;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Gender;

class GenderController extends Controller {

    public function index() {
        $genders = Gender::all();

        return view('cms.genders.index', ['genders' => $genders]);
    }

    public function show($id) {
        return redirect()->route('cms.genders.index');
    }

    public function create() {
        return view('cms.genders.create');
    }

    public function store(Request $request) {
        $gender = new Gender;
        $gender->name = $request->name;
        $gender->save();

        $request->session()->flash('message', 'Η εγγραφή δημιουργήθηκε με επιτυχία.');
        return redirect()->route('cms.genders.index');
    }

    public function edit($id) {
        $gender = Gender::findOrFail($id);

        return view('cms.genders.edit', ['gender' => $gender]);
    }

    public function update(Request $request, $id) {
        $gender = Gender::findOrFail($id);
        $gender->name = $request->name;
        $gender->save();

        $request->session()->flash('message', 'Η εγγραφή με id ' . $id . ' ενημερώθηκε με επιτυχία.');
        return redirect()->route('cms.genders.index');
    }

    public function destroy(Request $request, $id) {
        $gender = Gender::findOrFail($id);
        $gender->delete();

        $request->session()->flash('message', 'Η εγγραφή "' . $gender->name . '" διαγράφηκε με επιτυχία.');
        return redirect()->route('cms.genders.index');
    }

}
