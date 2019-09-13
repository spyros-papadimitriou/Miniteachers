<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Announcement;

class AnnouncementController extends Controller {

    public function index() {
        $announcements = Announcement::orderBy('id', 'desc')->paginate(10);

        return view('announcements.index', ['announcements' => $announcements]);
    }

}
