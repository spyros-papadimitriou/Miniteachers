<?php

namespace App\Http\Controllers\Profile;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use App\User;
use App\UserType;
use App\Course;
use App\CourseCategory;

class CourseController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $user = User::findOrFail(Auth::user()->id);

        return view('profile.courses.index', ['menu' => 'courses', 'user' => $user, 'title' => 'Επεξεργασία προφίλ - Μαθήματα']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $user = User::findOrFail(Auth::user()->id);
        $courseCategories = CourseCategory::all();
        foreach ($courseCategories as $courseCategory) {
            if (Storage::exists('course-categories/' . $courseCategory->id . '.svg')) {
                $courseCategory->picture = asset('storage/course-categories/' . $courseCategory->id . '.svg');
            } else {
                $courseCategory->picture = asset('svg/book.svg');
            }
        }

        return view('profile.courses.create', ['menu' => 'courses', 'user' => $user, 'courseCategories' => $courseCategories, 'title' => 'Επεξεργασία προφίλ - Μαθήματα']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $request->validate(['courses' => 'max:5'], ['courses.max' => 'Μπορείτε να δηλώσετε μέχρι 5 μαθήματα το πολύ.']);

        $user = User::findOrFail(Auth::user()->id);
        $courses = Course::find($request->courses);

        $user->courses()->detach();
        $user->courses()->attach($courses);

        $request->session()->flash('message', 'Η αποθήκευση πραγματοποιήθηκε επιτυχώς.');
        return redirect()->route('profile.courses.index');
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id) {
        $user = User::findOrFail(Auth::user()->id);
        $course = Course::findOrFail($id);
        $user->courses()->detach($course);

        $request->session()->flash('message', 'Η εγγραφή "' . $course->name . '" διαγράφηκε επιτυχώς.');
        return redirect()->route('profile.courses.index');
    }

}
