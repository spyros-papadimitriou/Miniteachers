<?php

namespace App\Http\Controllers\Cms;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\School;
use App\Department;

class SchoolDepartmentController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($schoolId) {
        $school = School::findOrFail($schoolId);
        $institution = $school->institution;
        $departments = $school->departments;

        return view('cms.departments.index', ['institution' => $institution, 'school' => $school, 'departments' => $departments]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($schoolId) {
        $school = School::findOrFail($schoolId);
        $institution = $school->institution;

        return view('cms.departments.create', ['institution' => $institution, 'school' => $school]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $schoolId) {
        $school = School::findOrFail($schoolId);

        $department = new Department;
        $department->id_school = $school->id;
        $department->name = $request->name;
        $department->url = $request->url;
        $department->save();

        $request->session()->flash('message', 'Η εγγραφή δημιουργήθηκε με επιτυχία.');
        return redirect()->route('cms.schools.departments.index', ['school' => $school->id]);
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
    public function edit($schoolId, $departmentId) {
        $department = Department::findOrFail($departmentId);

        return view('cms.departments.edit')->with('institution', $department->school->institution)->with('school', $department->school)->with('department', $department);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $schoolId, $departmentId) {
        $school = School::findOrFail($schoolId);

        $department = Department::findOrFail($departmentId);
        $department->name = $request->name;
        $department->url = $request->url;
        $department->save();

        $request->session()->flash('message', 'Η εγγραφή με id ' . $department->id . ' ενημερώθηκε με επιτυχία.');
        return redirect()->route('cms.schools.departments.index', ['school' => $department->school->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $schoolId, $departmentId) {
        $school = School::findOrFail($schoolId);

        $department = Department::findOrFail($departmentId);
        $department->delete();

        $request->session()->flash('message', 'Η εγγραφή "' . $department->name . '" διαγράφηκε με επιτυχία.');
        return redirect()->route('cms.schools.departments.index', ['school' => $school->id]);
    }

}
