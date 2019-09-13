<?php

namespace App\Http\Controllers\Profile;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use App\User;
use App\UserType;
use App\TargetGroup;

class TargetGroupController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $user = User::findOrFail(Auth::user()->id);

        return view('profile.target-groups.index', ['menu' => 'target-groups', 'user' => $user, 'title' => 'Επεξεργασία προφίλ - Στόχοι - Ομάδες']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $user = User::findOrFail(Auth::user()->id);
        $targetGroups = TargetGroup::all();

        foreach ($targetGroups as $targetGroup) {
            if (Storage::exists('target-groups/' . $targetGroup->id . '.svg')) {
                $targetGroup->picture = asset('storage/target-groups/' . $targetGroup->id . '.svg');
            } else {
                $targetGroup->picture = asset('svg/target-group.svg');
            }
        }

        return view('profile.target-groups.create', ['menu' => 'target-groups', 'user' => $user, 'targetGroups' => $targetGroups, 'title' => 'Επεξεργασία προφίλ - Στόχοι - Ομάδες']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $user = User::findOrFail(Auth::user()->id);
        $targetGroups = TargetGroup::find($request->targetGroups);

        $user->targetGroups()->detach();
        $user->targetGroups()->attach($targetGroups);

        $request->session()->flash('message', 'Η αποθήκευση πραγματοποιήθηκε επιτυχώς.');
        return redirect()->route('profile.target-groups.index');
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id) {
        $user = User::findOrFail(Auth::user()->id);
        $targetGroup = TargetGroup::findOrFail($id);
        $user->targetGroups()->detach($targetGroup);

        $request->session()->flash('message', 'Η εγγραφή "' . $targetGroup->name . '" διαγράφηκε επιτυχώς.');
        return redirect()->route('profile.target-groups.index');
    }

}
