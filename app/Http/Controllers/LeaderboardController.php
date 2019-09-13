<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UserType;
use App\User;

class LeaderboardController extends Controller {

    public function index() {
        $users = $users = User::join('user_stat', 'user.id', '=', 'user_stat.id')
                ->where('id_user_type', '<>', UserType::ADMIN)
				->where('user_stat.published', '1')
                ->orderBy('user_stat.points', 'desc')
				->orderBy('user_stat.id', 'asc')
                ->paginate(10);

        return view('leaderboard.index', ['title' => 'Leaderboard', 'users' => $users]);
    }

}
