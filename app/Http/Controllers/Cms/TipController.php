<?php

namespace App\Http\Controllers\Cms;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Tip;
use App\Agent;

class TipController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $tips = Tip::all();

        return view('cms.tips.index', ['tips' => $tips]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $agents = Agent::all();

        return view('cms.tips.create', ['agents' => $agents]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $this->validateRequest($request);
        $agent = Agent::find($request->agent);

        $tip = new Tip;
        $tip->alias = $request->alias;
        $tip->title = $request->title;
        $tip->content = $request->content;
        $tip->agent()->associate($agent);
        $tip->save();

        $request->session()->flash('message', 'Η εγγραφή δημιουργήθηκε με επιτυχία.');
        return redirect()->route('cms.tips.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        return redirect()->route('cms.tips.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $tip = Tip::findOrFail($id);
        $agents = Agent::all();

        return view('cms.tips.edit', ['tip' => $tip, 'agents' => $agents]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $this->validateRequest($request);

        $agent = Agent::find($request->agent);
        $tip = Tip::findOrFail($id);
        $tip->agent()->associate($agent);
        $tip->alias = $request->alias;
        $tip->title = $request->title;
        $tip->content = $request->content;
        $tip->save();

        $request->session()->flash('message', 'Η εγγραφή με id ' . $id . ' ενημερώθηκε με επιτυχία.');
        return redirect()->route('cms.tips.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id) {
        $tip = Tip::findOrFail($id);
        $tip->delete();

        $request->session()->flash('message', 'Η εγγραφή "' . $tip->description . '" διαγράφηκε με επιτυχία.');
        return redirect()->route('cms.tips.index');
    }

    private function validateRequest(Request $request) {
        $request->validate(['alias' => 'required|max:48', 'title' => 'required|max:48', 'content' => 'required'], [
            'alias.required' => 'Δεν έχετε καταχωρίσει alias.',
            'alias.max' => 'Το alias πρέπει να περιέχει το πολύ 48 χαρακτήρες.',
            'title.required' => 'Δεν έχετε καταχωρίσει τίτλο.',
            'title.max' => 'Ο τίτλος πρέπει να περιέχει το πολύ 48 χαρακτήρες.',
            'content.required' => 'Δεν έχετε καταχωρίσει περιεχόμενο.']);
    }

}
