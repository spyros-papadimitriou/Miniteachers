<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Action;

class UserActionController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        $user = Auth::user();
        $userActions = $user->userActions()->with('action')->orderBy('id', 'desc')->paginate(20);
        $actions = Action::all();

        return view('useractions.index', ['userActions' => $userActions, 'actions' => $actions]);
    }

}
