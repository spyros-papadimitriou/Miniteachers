<?php

namespace App\Http\Controllers\Cms;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Service;
use App\Http\Controllers\Controller;

class ServiceController extends Controller {

    public function index() {
        $services = Service::all();
        foreach ($services as $service) {
            if (Storage::exists('services/' . $service->id . '.svg')) {
                $service->picture = asset('storage/services/' . $service->id . '.svg');
            } else {
                $service->picture = asset('svg/services.svg');
            }
        }

        return view('cms.services.index', ['services' => $services]);
    }

    public function show($id) {
        return redirect()->route('cms.services.index');
    }

    public function create() {
        return view('cms.services.create');
    }

    public function store(Request $request) {
        $service = new Service;
        $service->name = $request->name;
        $service->save();
        $this->createPicture($request, $service);

        $request->session()->flash('message', 'Η εγγραφή δημιουργήθηκε με επιτυχία.');
        return redirect()->route('cms.services.index');
    }

    public function edit($id) {
        $service = Service::findOrFail($id);
        if (Storage::exists('services/' . $service->id . '.svg'))
            $service->picture = asset('storage/services/' . $service->id . '.svg');

        return view('cms.services.edit', ['service' => $service]);
    }

    public function update(Request $request, $id) {
        $service = Service::findOrFail($id);
        $service->name = $request->name;
        $service->save();
        $this->createPicture($request, $service);

        $request->session()->flash('message', 'Η εγγραφή με id ' . $id . ' ενημερώθηκε με επιτυχία.');
        return redirect()->route('cms.services.index');
    }

    public function destroy(Request $request, $id) {
        $service = Service::findOrFail($id);
        $service->delete();
        Storage::delete('services/' . $service->id . '.svg');

        $request->session()->flash('message', 'Η εγγραφή "' . $service->name . '" διαγράφηκε με επιτυχία.');
        return redirect()->route('cms.services.index');
    }

    private function createPicture($request, $service) {
        if ($request->hasFile('picture')) {
            if ($request->file('picture')->getClientOriginalExtension() == "svg") {
                $request->file('picture')->storeAs('services', $service->id . '.' . $request->file('picture')->getClientOriginalExtension());
            }
        }
    }

}
