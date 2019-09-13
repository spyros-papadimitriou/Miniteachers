<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\AchievementType;
use App\Achievement;
use App\UserAction;

class AchievementController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        $user = Auth::user();
        $achievementTypes = \App\AchievementType::all();
        foreach ($achievementTypes as $achievementType) {
            if (Storage::exists('achievement-types/' . $achievementType->id . '.svg')) {
                $achievementType->picture = asset('storage/achievement-types/' . $achievementType->id . '.svg');
            } else {
                $achievementType->picture = asset('svg/trophy.svg');
            }

            $achievementType->userAchievements = Achievement::whereHas('users', function ($query) use ($user) {
                        $query->where('id', $user->id);
                    })
                    ->where('id_achievement_type', $achievementType->id)
                    ->get();

            $ids = array(1 => 1, 2 => 2, 3 => 3, 4 => 5);
            $achievementType->currentNum = UserAction::where('id_user', $user->id)
                            ->where('id_action', $ids[$achievementType->id])->count();
        }
        return view('achievements.index', ['achievementTypes' => $achievementTypes]);
    }

}
