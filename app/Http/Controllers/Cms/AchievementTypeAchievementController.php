<?php

namespace App\Http\Controllers\Cms;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\AchievementType;
use App\Achievement;

class AchievementTypeAchievementController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($achievementTypeId) {
        $achievementType = AchievementType::findOrFail($achievementTypeId);
        $achievements = $achievementType->achievements;

        return view('cms.achievements.index', ['achievementType' => $achievementType, 'achievements' => $achievements]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($achievementTypeId) {
        $achievementType = AchievementType::findOrFail($achievementTypeId);

        return view('cms.achievements.create', ['achievementType' => $achievementType]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $achievementTypeId) {
        $achievementType = AchievementType::findOrFail($achievementTypeId);

        $achievement = new Achievement;
        $achievement->id_achievement_type = $achievementType->id;
        $achievement->value = (int) $request->value;
        $achievement->points = (int) $request->points;
        $achievement->save();

        $request->session()->flash('message', 'Η εγγραφή δημιουργήθηκε με επιτυχία.');
        return redirect()->route('cms.achievement_types.achievements.index', ['achievement_type' => $achievementType->id]);
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
    public function edit($achievementTypeId, $achievementId) {
        $achievement = Achievement::findOrFail($achievementId);

        return view('cms.achievements.edit')->with('achievementType', $achievement->achievementType)->with('achievement', $achievement);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $achievementTypeId, $achievementId) {
        $achievementType = AchievementType::findOrFail($achievementTypeId);

        $achievement = Achievement::findOrFail($achievementId);
        $achievement->value = (int) $request->value;
        $achievement->points = (int) $request->points;
        $achievement->save();

        $request->session()->flash('message', 'Η εγγραφή με id ' . $achievement->id . ' ενημερώθηκε με επιτυχία.');
        return redirect()->route('cms.achievement_types.achievements.index', ['achievement_type' => $achievementType->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $achievementTypeId, $achievementId) {
        $achievementType = AchievementType::findOrFail($achievementTypeId);

        $achievement = Achievement::findOrFail($achievementId);
        $achievement->delete();

        $request->session()->flash('message', 'Η εγγραφή με id = ' . $achievement->id . ' διαγράφηκε με επιτυχία.');
        return redirect()->route('cms.achievement_types.achievements.index', ['achievement_type' => $achievementType->id]);
    }

}
