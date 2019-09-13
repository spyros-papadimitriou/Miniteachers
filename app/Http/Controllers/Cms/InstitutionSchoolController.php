<?php

namespace App\Http\Controllers\Cms;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Institution;
use App\School;

class InstitutionSchoolController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($institutionId) {
        $institution = Institution::findOrFail($institutionId);
        $schools = $institution->schools()->withCount('departments')->get();

        return view('cms.schools.index', ['institution' => $institution, 'schools' => $schools]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($institutionId) {
        $institution = Institution::findOrFail($institutionId);

        return view('cms.schools.create', ['institution' => $institution]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $institutionId) {
        $institution = Institution::findOrFail($institutionId);

        $school = new School;
        $school->id_institution = $institution->id;
        $school->name = $request->name;
        $school->url = $request->url;
        $school->save();

        $request->session()->flash('message', 'Η εγγραφή δημιουργήθηκε με επιτυχία.');
        return redirect()->route('cms.institutions.schools.index', ['institution' => $institution->id]);
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
    public function edit($institutionId, $schoolId) {
        $school = School::findOrFail($schoolId);

        return view('cms.schools.edit')->with('institution', $school->institution)->with('school', $school);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $institutionId, $schoolId) {
        $institution = Institution::findOrFail($institutionId);

        $school = School::findOrFail($schoolId);
        $school->name = $request->name;
        $school->url = $request->url;
        $school->save();

        $request->session()->flash('message', 'Η εγγραφή με id ' . $school->id . ' ενημερώθηκε με επιτυχία.');
        return redirect()->route('cms.institutions.schools.index', ['institution' => $institution->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $institutionId, $schoolId) {
        $institution = Institution::findOrFail($institutionId);
        $school = School::findOrFail($schoolId);

        if ($school->departments->count())
            $request->session()->flash('message', 'Η εγγραφή "' . $school->name . '" δεν μπορεί να διαγραφεί διότι συσχετίζεται με Τμήματα.');
        else {
            $school->delete();
            $request->session()->flash('message', 'Η εγγραφή "' . $school->name . '" διαγράφηκε με επιτυχία.');
        }

        return redirect()->route('cms.institutions.schools.index', ['institution' => $institution->id]);
    }

}
