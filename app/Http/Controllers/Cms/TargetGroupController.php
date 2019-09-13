<?php

namespace App\Http\Controllers\Cms;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\Controller;
use App\TargetGroup;

class TargetGroupController extends Controller {

    public function index() {
        $targetGroups = TargetGroup::all();
        foreach ($targetGroups as $targetGroup) {
            if (Storage::exists('target-groups/' . $targetGroup->id . '.svg')) {
                $targetGroup->picture = asset('storage/target-groups/' . $targetGroup->id . '.svg');
            } else {
                $targetGroup->picture = asset('svg/target-group.svg');
            }
        }

        return view('cms.target_groups.index', ['targetGroups' => $targetGroups]);
    }

    public function show($id) {
        return redirect()->route('cms.target_groups.index');
    }

    public function create() {
        return view('cms.target_groups.create');
    }

    public function store(Request $request) {
        $targetGroup = new TargetGroup;
        $targetGroup->name = $request->name;
        $targetGroup->save();
        $this->createPicture($request, $targetGroup);

        $request->session()->flash('message', 'Η εγγραφή δημιουργήθηκε με επιτυχία.');
        return redirect()->route('cms.target_groups.index');
    }

    public function edit($id) {
        $targetGroup = TargetGroup::findOrFail($id);
        if (Storage::exists('target-groups/' . $targetGroup->id . '.svg'))
            $targetGroup->picture = asset('storage/target-groups/' . $targetGroup->id . '.svg');

        return view('cms.target_groups.edit', ['targetGroup' => $targetGroup]);
    }

    public function update(Request $request, $id) {
        $targetGroup = TargetGroup::findOrFail($id);
        $targetGroup->name = $request->name;
        $targetGroup->save();
        $this->createPicture($request, $targetGroup);

        $request->session()->flash('message', 'Η εγγραφή με id ' . $id . ' ενημερώθηκε με επιτυχία.');
        return redirect()->route('cms.target_groups.index');
    }

    public function destroy(Request $request, $id) {
        $targetGroup = TargetGroup::findOrFail($id);
        $targetGroup->delete();
        Storage::delete('target-groups/' . $targetGroup->id . '.svg');

        $request->session()->flash('message', 'Η εγγραφή "' . $targetGroup->name . '" διαγράφηκε με επιτυχία.');
        return redirect()->route('cms.target_groups.index');
    }

    private function createPicture($request, $targetGroup) {
        if ($request->hasFile('picture')) {
            if ($request->file('picture')->getClientOriginalExtension() == "svg") {
                $request->file('picture')->storeAs('target-groups', $targetGroup->id . '.' . $request->file('picture')->getClientOriginalExtension());
            }
        }
    }

}
