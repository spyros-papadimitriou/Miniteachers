<?php

namespace App\Http\View\Composers;

use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
use App\CourseCategory;
use App\Level;
use App\Notification;

class MenuComposer {

    protected $courseCategories, $totalUnreadMessages = 0, $globalUser, $notifications;

    public function __construct() {
        // Dependencies automatically resolved by service container...
        $this->courseCategories = CourseCategory::all();

        if (Auth::check()) {
            $this->notifications = Auth::user()->notifications;
            Notification::where('id_user', Auth::user()->id)->delete();

            $this->totalUnreadMessages = Auth::user()
                    ->userMessages()
                    ->where('is_read', 0)
                    ->count();

            $user = Auth::user();
            $nextLevel = Level::where('points_needed', '>', $user->userStat->points)->orderBy('points_needed')->first();
            $nextPoints = $nextLevel->points_needed;
            $previousLevel = Level::where('id', '<', $nextLevel->id)->orderBy('id', 'desc')->first();
            $previousPoints = $previousLevel == null ? 0 : $previousLevel->points_needed;
            $pointsNeeded = $nextPoints - $previousPoints;
            $pointsCurrent = $user->userStat->points - $previousPoints;

            $percent = round(100 * ($pointsCurrent / $pointsNeeded));

            $user->userStat->nextLevel = $nextLevel;
            $user->userStat->percent = $percent;
            $this->globalUser = $user;
        }
    }

    public function compose(View $view) {
        $view->with('courseCategories', $this->courseCategories)->with('totalUnreadMessages', $this->totalUnreadMessages)->with('globalUser', $this->globalUser)->with('notifications', $this->notifications);
    }

}
?>

