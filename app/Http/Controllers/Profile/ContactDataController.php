<?php

namespace App\Http\Controllers\Profile;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\User;
use App\UserType;
use App\ContactData;
use App\ContactDataType;

class ContactDataController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $user = User::findOrFail(Auth::user()->id);

        return view('profile.contact-data.index', ['menu' => 'contact-data', 'user' => $user, 'title' => 'Επεξεργασία προφίλ - Στοιχεία επικοινωνίας']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $user = User::findOrFail(Auth::user()->id);
        $contactDataTypes = ContactDataType::all();

        return view('profile.contact-data.create', ['menu' => 'contact-data', 'user' => $user, 'contactDataTypes' => $contactDataTypes, 'title' => 'Επεξεργασία προφίλ - Στοιχεία επικοινωνίας']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $user = User::findOrFail(Auth::user()->id);
        $contactDataType = ContactDataType::findOrFail($request->contactDataType);

        if (count($user->contactData) < 3) {
            $this->validateRequest($request, $contactDataType);

            $contactData = new ContactData;
            $contactData->id_user = $user->id;
            $contactData->id_contact_data_type = $contactDataType->id;
            $contactData->value = $request->value;
            $contactData->save();

            $request->session()->flash('message', 'Η αποθήκευση πραγματοποιήθηκε επιτυχώς.');
        } else {
            $request->session()->flash('message', 'Έχετε ήδη 3 εγγραφές.');
        }

        return redirect()->route('profile.contact-data.index');
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
        $user = User::findOrFail(Auth::user()->id);
        $contactData = $user->contactData()->findOrFail($id);

        return view('profile.contact-data.edit', ['menu' => 'contact-data', 'user' => $user, 'contactData' => $contactData, 'title' => 'Επεξεργασία προφίλ - Στοιχεία επικοινωνίας']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $user = User::findOrFail(Auth::user()->id);
        $contactData = ContactData::where('id', $id)->where('id_user', $user->id)->firstOrFail();
        $this->validateRequest($request, $contactData->contactDataType);

        $contactData->value = $request->value;
        $contactData->save();

        $request->session()->flash('message', 'Η αποθήκευση πραγματοποιήθηκε επιτυχώς.');
        return view('profile.contact-data.index', ['menu' => 'contact-data', 'user' => $user]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id) {
        $user = User::findOrFail(Auth::user()->id);
        $contactData = ContactData::where('id', $id)->where('id_user', $user->id)->firstOrFail();
        $contactData->delete();

        $request->session()->flash('message', 'Η εγγραφή με τρόπο επικοινωνίας "' . $contactData->contactDataType->name . '" και τιμή "' . $contactData->value . '" διαγράφηκε επιτυχώς.');
        return redirect()->route('profile.contact-data.index');
    }

    private function validateRequest(Request $request, ContactDataType $contactDataType) {
        if ($contactDataType->id == 1) {
            $rules = array('value' => 'required|email|max:24');
            $messages = ['value.required' => 'Δεν έχετε συμπληρώσει την τιμή του στοιχείου επικοινωνίας.', 'value.email' => 'Η τιμή που δώσατε δεν είναι έγκυρη μορφή email.', 'value.max' => 'Η τιμή του στοιχείου επικοινωνίας πρέπει να περιέχει το πολύ 24 χαρακτήρες.'];
        } else {
            $rules = array('value' => ['required', 'regex:/^[0-9]+$/', 'max:24']);
            $messages = ['value.required' => 'Δεν έχετε συμπληρώσει την τιμή του στοιχείου επικοινωνίας.', 'value.regex' => 'Η τιμή πρέπει να αποτελείται μόνο από αριθμούς.', 'value.max' => 'Η τιμή του στοιχείου επικοινωνίας πρέπει να περιέχει το πολύ 24 χαρακτήρες.'];
        }

        $request->validate($rules, $messages);
    }

}
