<?php

namespace App\Http\Controllers\Cms;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Level;

class LevelController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $levels = Level::orderBy('points_needed')->get();

        return view('cms.levels.index', ['levels' => $levels]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('cms.levels.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $level = new Level;
        $level->name_male = $request->name_male;
        $level->name_female = $request->name_female;
        $level->points_needed = (int) $request->points_needed;
        $level->save();

        $request->session()->flash('message', 'Η εγγραφή δημιουργήθηκε με επιτυχία.');
        return redirect()->route('cms.levels.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        return redirect()->route('cms.levels.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $level = Level::findOrFail($id);

        return view('cms.levels.edit', ['level' => $level]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $level = Level::findOrFail($id);
        $level->name_male = $request->name_male;
        $level->name_female = $request->name_female;
        $level->points_needed = $request->points_needed;
        $level->save();

        $request->session()->flash('message', 'Η εγγραφή με id ' . $id . ' ενημερώθηκε με επιτυχία.');
        return redirect()->route('cms.levels.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id) {
        $level = Level::findOrFail($id);
        $level->delete();

        $request->session()->flash('message', 'Η εγγραφή "' . $level->name_male . '" διαγράφηκε με επιτυχία.');
        return redirect()->route('cms.levels.index');
    }

}
