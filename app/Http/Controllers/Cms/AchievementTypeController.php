<?php

namespace App\Http\Controllers\Cms;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use App\AchievementType;

class AchievementTypeController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $achievementTypes = AchievementType::withCount('achievements')->get();

        foreach ($achievementTypes as $achievementType) {
            if (Storage::exists('achievement-types/' . $achievementType->id . '.svg')) {
                $achievementType->picture = asset('storage/achievement-types/' . $achievementType->id . '.svg');
            } else {
                $achievementType->picture = asset('svg/cms/trophy.svg');
            }
        }

        return view('cms.achievement_types.index', ['achievementTypes' => $achievementTypes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('cms.achievement_types.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $achievementType = new AchievementType;
        $achievementType->name = $request->name;
        $achievementType->save();
        $this->createPicture($request, $achievementType);

        $request->session()->flash('message', 'Η εγγραφή δημιουργήθηκε με επιτυχία.');
        return redirect()->route('cms.achievement_types.index');
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
        $achievementType = AchievementType::findOrFail($id);
        if (Storage::exists('achievement-types/' . $achievementType->id . '.svg'))
            $achievementType->picture = asset('storage/achievement-types/' . $achievementType->id . '.svg');

        return view('cms.achievement_types.edit', ['achievementType' => $achievementType]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $achievementType = AchievementType::findOrFail($id);
        $achievementType->name = $request->name;
        $achievementType->save();
        $this->createPicture($request, $achievementType);

        $request->session()->flash('message', 'Η εγγραφή με id ' . $id . ' ενημερώθηκε με επιτυχία.');
        return redirect()->route('cms.achievement_types.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id) {
        $achievementType = AchievementType::findOrFail($id);

        if ($achievementType->achievements->count())
            $request->session()->flash('message', 'Η εγγραφή "' . $achievementType->name . '" δεν μπορεί να διαγραφεί διότι συσχετίζεται με κατορθώματα.');
        else {
            $achievementType->delete();
            $request->session()->flash('message', 'Η εγγραφή "' . $achievementType->name . '" διαγράφηκε με επιτυχία.');
        }

        return redirect()->route('cms.achievement_types.index');
    }

    private function createPicture($request, $achievementType) {
        if ($request->hasFile('picture')) {
            if ($request->file('picture')->getClientOriginalExtension() == "svg") {
                $request->file('picture')->storeAs('achievement-types', $achievementType->id . '.' . $request->file('picture')->getClientOriginalExtension());
            }
        }
    }

}
