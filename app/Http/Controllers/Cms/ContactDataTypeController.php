<?php

namespace App\Http\Controllers\Cms;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ContactDataType;

class ContactDataTypeController extends Controller {

    public function index() {
        $contact_data_types = \App\ContactDataType::all();

        return view('cms.contact_data_types.index', ['contact_data_types' => $contact_data_types]);
    }

    public function show($id) {
        return redirect()->route('cms.contact_data_types.index');
    }

    public function create() {
        return view('cms.contact_data_types.create');
    }

    public function store(Request $request) {
        $contact_data_type = new ContactDataType;
        $contact_data_type->name = $request->name;
        $contact_data_type->save();

        $request->session()->flash('message', 'Η εγγραφή δημιουργήθηκε με επιτυχία.');
        return redirect()->route('cms.contact_data_types.index');
    }

    public function edit($id) {
        $contact_data_type = ContactDataType::findOrFail($id);

        return view('cms.contact_data_types.edit', ['contact_data_type' => $contact_data_type]);
    }

    public function update(Request $request, $id) {
        $contact_data_type = ContactDataType::findOrFail($id);
        $contact_data_type->name = $request->name;
        $contact_data_type->save();

        $request->session()->flash('message', 'Η εγγραφή με id ' . $id . ' ενημερώθηκε με επιτυχία.');
        return redirect()->route('cms.contact_data_types.index');
    }

    public function destroy(Request $request, $id) {
        $contact_data_type = ContactDataType::findOrFail($id);
        $contact_data_type->delete();

        $request->session()->flash('message', 'Η εγγραφή "' . $contact_data_type->name . '" διαγράφηκε με επιτυχία.');
        return redirect()->route('cms.contact_data_types.index');
    }

}
