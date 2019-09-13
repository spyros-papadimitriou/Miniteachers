<?php

namespace App\Http\Controllers\Cms;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use App\Website;

class WebsiteController extends Controller {

    public function index() {
        $websites = Website::all();
        foreach ($websites as $website) {
            if (Storage::exists('websites/' . $website->id . '.svg')) {
                $website->picture = asset('storage/websites/' . $website->id . '.svg');
            } else {
                $website->picture = asset('svg/book.svg');
            }
        }

        return view('cms.websites.index', ['websites' => $websites]);
    }

    public function show($id) {
        return redirect()->route('cms.websites.index');
    }

    public function create() {
        return view('cms.websites.create');
    }

    public function store(Request $request) {
        $website = new Website;
        $website->name = $request->name;
        $website->url_pattern = $request->url_pattern;
        $website->save();
        $this->createPicture($request, $website);

        $request->session()->flash('message', 'Η εγγραφή δημιουργήθηκε με επιτυχία.');
        return redirect()->route('cms.websites.index');
    }

    public function edit($id) {
        $website = Website::findOrFail($id);
        if (Storage::exists('websites/' . $website->id . '.svg'))
            $website->picture = asset('storage/websites/' . $website->id . '.svg');

        return view('cms.websites.edit', ['website' => $website]);
    }

    public function update(Request $request, $id) {
        $website = Website::findOrFail($id);
        $website->name = $request->name;
        $website->url_pattern = $request->url_pattern;
        $website->save();
        $this->createPicture($request, $website);

        $request->session()->flash('message', 'Η εγγραφή με id ' . $id . ' ενημερώθηκε με επιτυχία.');
        return redirect()->route('cms.websites.index');
    }

    public function destroy(Request $request, $id) {
        $website = Website::findOrFail($id);
        $website->delete();

        $request->session()->flash('message', 'Η εγγραφή "' . $website->name . '" διαγράφηκε με επιτυχία.');
        return redirect()->route('cms.websites.index');
    }

    private function createPicture($request, $website) {
        if ($request->hasFile('picture')) {
            if ($request->file('picture')->getClientOriginalExtension() == "svg") {
                $request->file('picture')->storeAs('websites', $website->id . '.' . $request->file('picture')->getClientOriginalExtension());
            }
        }
    }

}
