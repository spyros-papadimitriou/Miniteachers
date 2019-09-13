<?php

namespace App\Listeners\Gamification;

use App\Events\Gamification\ActionEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\DB;
use App\Action;
use App\UserAction;
use App\Message;
use App\UserStat;
use App\Level;
use App\User;
use App\AchievementType;
use App\Achievement;
use App\NotificationType;
use App\Notification;

class ActionEventListener {

    private $action, $request, $user, $otherUser;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct() {
        //
    }

    /**
     * Handle the event.
     *
     * @param  ActionEvent  $event
     * @return void
     */
    public function handle(ActionEvent $event) {
        $this->action = Action::findOrFail($event->actionId);
        $this->request = $event->request;
        $this->user = $event->user;
        $this->otherUser = $event->otherUser;

        switch ($this->action->id) {
            case ActionEvent::VIEW_PROFILE_BY_GUEST:
                $this->handleViewProfileByGuestAction();
                break;

            case ActionEvent::VIEW_PROFILE_BY_MINIUSER:
                $this->handleViewProfileByMiniuserAction();
                break;

            case ActionEvent::LOGIN_CURRENT_DATE:
                $this->handleLoginCurrentDateAction();
                break;

            case ActionEvent::CREATE_CONVERSATION_ΒY_YOU:
                $this->handleCreateConversationByYouAction();
                break;

            case ActionEvent::CREATE_CONVERSATION_BY_OTHER:
                $this->handleCreateConversationByOtherAction();
                break;

            case ActionEvent::CREATE_PROFILE:
                $this->handleCreateProfileAction();
                break;
        }
    }

    // private methods
    private function handleViewProfileByGuestAction() {
        // Check ip
        try {
            $userAction = UserAction::where('id_user', $this->user->id)
                    ->where('ip', $this->request->ip())
                    ->where('id_action', ActionEvent::VIEW_PROFILE_BY_GUEST)
                    ->first();

            if ($userAction == null) {
                $userAction = new UserAction();
                $userAction->ip = $this->request->ip();
                $userAction->id_action = ActionEvent::VIEW_PROFILE_BY_GUEST;
                $userAction->id_user = $this->user->id;
                $userAction->points = $this->action->points + $this->calculateFavourites();
                $userAction->save();

                $this->calculatePoints();
                $this->checkAchievement(1);
                $this->createNotification(1, "+" . $userAction->points . " minipoints", $this->action->name);
            }
        } catch (QueryException $e) {
            // do nothing
        }
    }

    private function handleViewProfileByMiniuserAction() {
        // Check miniuser
        try {
            if ($this->user->id != $this->otherUser->id) {
                $userAction = UserAction::where('id_user', $this->user->id)
                        ->where('id_action', ActionEvent::VIEW_PROFILE_BY_MINIUSER)
                        ->where('id_other_user', $this->otherUser->id)
                        ->first();

                if ($userAction == null) {
                    $userAction = new UserAction();
                    $userAction->ip = $this->request->ip();
                    $userAction->id_action = ActionEvent::VIEW_PROFILE_BY_MINIUSER;
                    $userAction->id_user = $this->user->id;
                    $userAction->id_other_user = $this->otherUser->id;
                    $userAction->points = $this->action->points + $this->calculateFavourites();
                    $userAction->save();

                    $this->calculatePoints();
                    $this->checkAchievement(2);
                    $this->createNotification(1, "+" . $userAction->points . " minipoints", $this->action->name);
                }
            }
        } catch (QueryException $e) {
            // do nothing
        }
    }

    private function handleLoginCurrentDateAction() {
        // Check date
        try {
            $userAction = UserAction::where('id_user', $this->user->id)
                    ->where('id_action', ActionEvent::LOGIN_CURRENT_DATE)
                    ->whereDate('created_at', date('Y-m-d', time()))
                    ->first();

            if ($userAction == null) {
                $userAction = new UserAction();
                $userAction->ip = $this->request->ip();
                $userAction->id_action = ActionEvent::LOGIN_CURRENT_DATE;
                $userAction->id_user = $this->user->id;
                $userAction->points = $this->action->points + $this->calculateFavourites();
                $userAction->save();

                $this->calculatePoints();
                $this->checkAchievement(3);
                $this->createNotification(1, "+" . $userAction->points . " minipoints", $this->action->name);
            }
        } catch (QueryException $e) {
            // do nothing
        }
    }

    private function handleCreateConversationByYouAction() {
        // Check miniuser
        try {
            $userAction = UserAction::where('id_user', $this->user->id)
                    ->where('id_other_user', $this->otherUser->id)
                    ->where(function ($query) {
                        $query->where('id_action', ActionEvent::CREATE_CONVERSATION_ΒY_YOU)
                        ->orWhere('id_action', ActionEvent::CREATE_CONVERSATION_BY_OTHER);
                    })
                    ->first();

            if ($userAction == null) {
                $userAction = new UserAction();
                $userAction->ip = $this->request->ip();
                $userAction->id_action = ActionEvent::CREATE_CONVERSATION_ΒY_YOU;
                $userAction->id_user = $this->user->id;
                $userAction->id_other_user = $this->otherUser->id;
                $userAction->points = $this->action->points + $this->calculateFavourites();
                $userAction->save();

                $this->calculatePoints();
            }
        } catch (QueryException $e) {
            // do nothing
        }
    }

    private function handleCreateConversationByOtherAction() {
        // Check miniuser
        try {
            $userAction = UserAction::where('id_user', $this->user->id)
                    ->where('id_other_user', $this->otherUser->id)
                    ->where(function ($query) {
                        $query->where('id_action', ActionEvent::CREATE_CONVERSATION_ΒY_YOU)
                        ->orWhere('id_action', ActionEvent::CREATE_CONVERSATION_BY_OTHER);
                    })
                    ->first();

            if ($userAction == null) {
                $userAction = new UserAction();
                $userAction->ip = $this->request->ip();
                $userAction->id_action = ActionEvent::CREATE_CONVERSATION_BY_OTHER;
                $userAction->id_user = $this->user->id;
                $userAction->id_other_user = $this->otherUser->id;
                $userAction->points = $this->action->points + $this->calculateFavourites();
                $userAction->save();

                $this->calculatePoints();
                $this->checkAchievement(5);
                $this->createNotification(1, "+" . $userAction->points . " minipoints", $this->action->name);
            }
        } catch (QueryException $e) {
            // do nothing
        }
    }

    private function handleCreateProfileAction() {
        try {
            $userAction = new UserAction();
            $userAction->ip = $this->request->ip();
            $userAction->id_action = ActionEvent::CREATE_PROFILE;
            $userAction->id_user = $this->user->id;
            $userAction->points = $this->action->points + $this->calculateFavourites();
            $userAction->save();

            $this->calculatePoints();
            $this->createNotification(1, "+" . $userAction->points . " minipoints", $this->action->name);
        } catch (QueryException $e) {
            // do nothing
        }
    }

    private function calculateFavourites() {
        // Being in favourite lists
        $user = $this->user;
        $favouritesPoints = User::query()
                        ->whereHas('favourites', function ($query) use ($user) {
                            $query->where('id', $user->id);
                        })->count();

        return $favouritesPoints;
    }

    private function calculatePoints() {
        $userActions = UserAction::where('id_user', $this->user->id)->get();
        $points = 0;
        foreach ($userActions as $userAction) {
            $points += $userAction->points;
        }

        $level = Level::where('points_needed', '<=', $points)->orderBy('points_needed', 'desc')->first();
        UserStat::where('id', $this->user->id)->update(['points' => $points, 'id_level' => $level->id]);
        // todo: compare currentLevel with level to notify user
    }

    private function checkAchievement($achievementTypeId) {
        $total = UserAction::where('id_user', $this->user->id)
                        ->where('id_action', $this->action->id)->count();
        $achievement = Achievement::where('id_achievement_type', $achievementTypeId)
                ->where('value', '<=', $total)
                ->orderBy('id', 'desc')
                ->first();

        if ($achievement != null && !$this->user->achievements->contains($achievement)) {
            $this->user->achievements()->attach($achievement);
            $action = Action::find(ActionEvent::ACHIEVEMENT);

            $userAction = new UserAction();
            $userAction->ip = $this->request->ip();
            $userAction->id_action = $action->id;
            $userAction->id_user = $this->user->id;
            $userAction->id_achievement = $achievement->id;
            $userAction->points = $action->points + $achievement->points + $this->calculateFavourites();
            $userAction->save();

            $this->calculatePoints();
            $this->createNotification(1, "+" . $userAction->points . " minipoints", $action->name . "<br />" . $achievement->achievementType->name . " = " . $achievement->value);
        }
    }

    private function createNotification($notificationTypeId, $title, $content) {
        $notificationType = NotificationType::find($notificationTypeId);

        if ($notificationType != null) {
            $notification = new Notification();
            $notification->id_notification_type = $notificationType->id;
            $notification->id_user = $this->user->id;
            $notification->title = $title;
            $notification->content = $content;

            $notification->save();
        }
    }

}
