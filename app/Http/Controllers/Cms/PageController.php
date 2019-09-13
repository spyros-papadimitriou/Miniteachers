<?php

namespace App\Http\Controllers\Cms;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Page;

class PageController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $pages = Page::all();

        return view('cms.pages.index', ['pages' => $pages]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('cms.pages.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $page = new Page;
        $page->name = $request->name;
        $page->title = $request->title;
        $page->content = $request->content;
        $page->save();

        $request->session()->flash('message', 'Η εγγραφή δημιουργήθηκε με επιτυχία.');
        return redirect()->route('cms.pages.index');
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
        $page = Page::findOrFail($id);

        return view('cms.pages.edit', ['page' => $page]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $page = Page::findOrFail($id);
        $page->name = $request->name;
        $page->title = $request->title;
        $page->content = $request->content;
        $page->save();

        $request->session()->flash('message', 'Η εγγραφή με id ' . $id . ' ενημερώθηκε με επιτυχία.');
        return redirect()->route('cms.pages.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id) {
        $page = Page::findOrFail($id);
        $page->delete();

        $request->session()->flash('message', 'Η εγγραφή "' . $page->name . '" διαγράφηκε με επιτυχία.');
        return redirect()->route('cms.pages.index');
    }

}
