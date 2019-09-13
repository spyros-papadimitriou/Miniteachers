<?php

namespace App\Http\Controllers\Profile;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\User;
use App\UserType;
use App\Department;
use App\Institution;

class DepartmentController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $user = User::findOrFail(Auth::user()->id);

        return view('profile.departments.index', ['menu' => 'departments', 'user' => $user, 'title' => 'Επεξεργασία προφίλ - Προπτυχιακές σπουδές']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $user = User::findOrFail(Auth::user()->id);
        $institutions = Institution::all();

        foreach ($institutions as $institution) {
            if (Storage::exists('institutions/' . $institution->id . '.png')) {
                $institution->picture = asset('storage/institutions/' . $institution->id . '.png');
            } else {
                $institution->picture = asset('svg/university.svg');
            }
        }

        return view('profile.departments.create', ['menu' => 'departments', 'user' => $user, 'institutions' => $institutions, 'title' => 'Επεξεργασία προφίλ - Προπτυχιακές σπουδές']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $user = User::findOrFail(Auth::user()->id);
        $department = Department::find($request->department);

        if (!$user->departments->contains($department) && count($user->departments) < 3) {
            $user->departments()->attach($department);

            $request->session()->flash('message', 'Η αποθήκευση του Τμήματος/Τομέα "' . $department->name . '" πραγματοποιήθηκε επιτυχώς.');
        }

        return redirect()->route('profile.departments.index');
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
        $department = $user->departments()->findOrFail($id);

        return view('profile.departments.edit', ['menu' => 'departments', 'user' => $user, 'department' => $department, 'title' => 'Επεξεργασία προφίλ - Προπτυχιακές σπουδές']);
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

        $currentYear = date('Y', time());
        $request->validate([
            'endyear' => 'nullable|integer|between:1970,' . $currentYear
                ], ['endyear.between' => 'Το έτος αποφοίτησης δέχεται τιμές από 1970 έως ' . $currentYear . "."]);

        $user->departments()->updateExistingPivot($id, ['endyear' => $request->endyear]);
        $request->session()->flash('message', 'Η αποθήκευση πραγματοποιήθηκε επιτυχώς.');

        return redirect()->route('profile.departments.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id) {
        $user = User::findOrFail(Auth::user()->id);
        $department = Department::findOrFail($id);
        $user->departments()->detach($department);

        $request->session()->flash('message', 'Η εγγραφή "' . $department->name . '" διαγράφηκε επιτυχώς.');
        return redirect()->route('profile.departments.index');
    }

}
