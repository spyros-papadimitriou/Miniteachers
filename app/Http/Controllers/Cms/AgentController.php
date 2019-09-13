<?php

namespace App\Http\Controllers\Cms;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use App\Agent;

class AgentController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $agents = Agent::all();

        foreach ($agents as $agent) {
            if (Storage::exists('agents/' . $agent->id . '.svg')) {
                $agent->picture = asset('storage/agents/' . $agent->id . '.svg');
            } else {
                $agent->picture = asset('svg/agents.svg');
            }
        }

        return view('cms.agents.index', ['agents' => $agents]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('cms.agents.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $agent = new Agent;
        $agent->name = $request->name;
        $agent->save();
        $this->createPicture($request, $agent);

        $request->session()->flash('message', 'Η εγγραφή δημιουργήθηκε με επιτυχία.');
        return redirect()->route('cms.agents.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        return redirect()->route('cms.agents.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $agent = Agent::findOrFail($id);
        if (Storage::exists('agents/' . $agent->id . '.svg'))
            $agent->picture = asset('storage/agents/' . $agent->id . '.svg');

        return view('cms.agents.edit', ['agent' => $agent]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $agent = Agent::findOrFail($id);
        $agent->name = $request->name;
        $agent->save();
        $this->createPicture($request, $agent);

        $request->session()->flash('message', 'Η εγγραφή με id ' . $id . ' ενημερώθηκε με επιτυχία.');
        return redirect()->route('cms.agents.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id) {
        $agent = Agent::findOrFail($id);
        $agent->delete();
        Storage::delete('agents/' . $agent->id . '.svg');

        $request->session()->flash('message', 'Η εγγραφή "' . $agent->name . '" διαγράφηκε με επιτυχία.');
        return redirect()->route('cms.agents.index');
    }

    private function createPicture($request, $agent) {
        if ($request->hasFile('picture')) {
            if ($request->file('picture')->getClientOriginalExtension() == "svg") {
                $request->file('picture')->storeAs('agents', $agent->id . '.' . $request->file('picture')->getClientOriginalExtension());
            }
        }
    }

}
