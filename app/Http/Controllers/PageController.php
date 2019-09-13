<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Page;

class PageController extends Controller {

    public function show($id) {
        $page = Page::findOrFail($id);
        $title = $page->title;

        return view('pages.show', ['page' => $page, 'title' => $title]);
    }

}
