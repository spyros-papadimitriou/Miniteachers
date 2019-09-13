<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\AgeRange;
use App\User;
use App\Level;
use App\Events\Gamification\ActionEvent;
use Illuminate\Support\Carbon;
use App\UserAction;

class ProfileController extends Controller {

    public function show(Request $request, $id = null) {
        if ($id == null) {
            if (Auth::check()) {
                $user = Auth::user();
            } else {
                return redirect()->route('home');
            }
        } else {
            $user = User::join('user_stat', 'user.id', '=', 'user_stat.id')->where('user.id', $id)->where('user_stat.published', 1)->firstOrFail();
        }

        if (Auth::check()) {
            event(new ActionEvent(ActionEvent::VIEW_PROFILE_BY_MINIUSER, $request, $user, Auth::user()));
        } else {
            event(new ActionEvent(ActionEvent::VIEW_PROFILE_BY_GUEST, $request, $user));
        }

        $canEdit = Auth::check() && $user->id == Auth::user()->id;

        $nextLevel = Level::where('points_needed', '>', $user->userStat->points)->orderBy('points_needed')->first();
        $nextPoints = $nextLevel->points_needed;
        $previousLevel = Level::where('id', '<', $nextLevel->id)->orderBy('id', 'desc')->first();
        $previousPoints = $previousLevel == null ? 0 : $previousLevel->points_needed;
        $pointsNeeded = $nextPoints - $previousPoints;
        $pointsCurrent = $user->userStat->points - $previousPoints;

        $percent = round(100 * ($pointsCurrent / $pointsNeeded));
        $user->userStat->percent = $percent;

        $birthdate = new Carbon($user->birthdate);
        $today = new Carbon(date('Y-m-d', time()));
        $diffInYears = $today->diffInYears($birthdate);
        $user->ageRange = AgeRange::where(function ($query) use ($diffInYears) {
                    $query->where('age_from', '<=', $diffInYears);
                    $query->orWhereNull('age_from');
                })
                ->where(function ($query) use ($diffInYears) {
                    $query->where('age_to', '>=', $diffInYears);
                    $query->orWhereNull('age_to');
                })
                ->first();

        // Being in favourite lists
        $favouritesInverseCount = User::query()
                        ->whereHas('favourites', function ($query) use ($user) {
                            $query->where('id', $user->id);
                        })->count();

        // Total views
        $user->totalViewsByGuests = UserAction::where('id_user', $user->id)
                ->where('id_action', ActionEvent::VIEW_PROFILE_BY_GUEST)
                ->count();
        $user->totalViewsByMiniUsers = UserAction::where('id_user', $user->id)
                ->where('id_action', ActionEvent::VIEW_PROFILE_BY_MINIUSER)
                ->count();
        $user->totalViews = $user->totalViewsByGuests + $user->totalViewsByMiniUsers;

        return view('profile.show', ['user' => $user, 'nextLevel' => $nextLevel, 'canEdit' => $canEdit, 'title' => $user->name, 'favouritesInverseCount' => $favouritesInverseCount]);
    }

}
