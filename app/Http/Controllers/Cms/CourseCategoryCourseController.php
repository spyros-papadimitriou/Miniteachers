<?php

namespace App\Http\Controllers\Cms;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use App\CourseCategory;
use App\Course;

class CourseCategoryCourseController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($courseCategoryId) {
        $courseCategory = CourseCategory::findOrFail($courseCategoryId);
        $courses = $courseCategory->courses;
        foreach ($courses as $course) {
            if (Storage::exists('courses/' . $course->id . '.svg')) {
                $course->picture = asset('storage/courses/' . $course->id . '.svg');
            } else {
                $course->picture = asset('svg/book.svg');
            }
        }

        return view('cms.courses.index', ['courseCategory' => $courseCategory, 'courses' => $courses]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($courseCategoryId) {
        $courseCategory = CourseCategory::findOrFail($courseCategoryId);

        return view('cms.courses.create', ['courseCategory' => $courseCategory]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $courseCategoryId) {
        $courseCategory = CourseCategory::findOrFail($courseCategoryId);

        $course = new Course;
        $course->id_course_category = $courseCategory->id;
        $course->name = $request->name;
        $course->save();
        $this->createPicture($request, $course);

        $request->session()->flash('message', 'Η εγγραφή δημιουργήθηκε με επιτυχία.');
        return redirect()->route('cms.course_categories.courses.index', ['courseCategory' => $courseCategory->id]);
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
    public function edit($courseCategoryId, $courseId) {
        $course = Course::findOrFail($courseId);
        if (Storage::exists('courses/' . $course->id . '.svg'))
            $course->picture = asset('storage/courses/' . $course->id . '.svg');

        return view('cms.courses.edit')->with('courseCategory', $course->courseCategory)->with('course', $course);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $courseCategoryId, $courseId) {
        $courseCategory = CourseCategory::findOrFail($courseCategoryId);

        $course = Course::findOrFail($courseId);
        $course->name = $request->name;
        $course->save();
        $this->createPicture($request, $course);

        $request->session()->flash('message', 'Η εγγραφή με id ' . $course->id . ' ενημερώθηκε με επιτυχία.');
        return redirect()->route('cms.course_categories.courses.index', ['course_category' => $courseCategory->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $courseCategoryId, $courseId) {
        $courseCategory = CourseCategory::findOrFail($courseCategoryId);

        $course = Course::findOrFail($courseId);
        $course->delete();
        Storage::delete('courses/' . $course->id . '.svg');

        $request->session()->flash('message', 'Η εγγραφή "' . $course->name . '" διαγράφηκε με επιτυχία.');
        return redirect()->route('cms.course_categories.courses.index', ['course_category' => $courseCategory->id]);
    }

    private function createPicture($request, $course) {
        if ($request->hasFile('picture')) {
            if ($request->file('picture')->getClientOriginalExtension() == "svg") {
                $request->file('picture')->storeAs('courses', $course->id . '.' . $request->file('picture')->getClientOriginalExtension());
            }
        }
    }

}
