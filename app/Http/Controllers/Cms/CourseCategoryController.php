<?php

namespace App\Http\Controllers\Cms;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use App\CourseCategory;
use App\Course;

class CourseCategoryController extends Controller {

    public function index() {
        $courseCategories = CourseCategory::withCount('courses')->get();
        foreach ($courseCategories as $courseCategory) {
            if (Storage::exists('course-categories/' . $courseCategory->id . '.svg')) {
                $courseCategory->picture = asset('storage/course-categories/' . $courseCategory->id . '.svg');
            } else {
                $courseCategory->picture = asset('svg/book.svg');
            }
        }

        return view('cms.course_categories.index', ['courseCategories' => $courseCategories]);
    }

    public function show($id) {
        return redirect()->route('cms.course_categories.index');
    }

    public function create() {
        return view('cms.course_categories.create');
    }

    public function store(Request $request) {
        $courseCategory = new CourseCategory;
        $courseCategory->name = $request->name;
        $courseCategory->save();
        $this->createPicture($request, $courseCategory);

        $request->session()->flash('message', 'Η εγγραφή δημιουργήθηκε με επιτυχία.');
        return redirect()->route('cms.course_categories.index');
    }

    public function edit($id) {
        $courseCategory = CourseCategory::findOrFail($id);

        return view('cms.course_categories.edit', ['courseCategory' => $courseCategory]);
    }

    public function update(Request $request, $id) {
        $courseCategory = CourseCategory::findOrFail($id);
        $courseCategory->name = $request->name;
        $courseCategory->save();
        $this->createPicture($request, $courseCategory);

        $request->session()->flash('message', 'Η εγγραφή με id ' . $id . ' ενημερώθηκε με επιτυχία.');
        return redirect()->route('cms.course_categories.index');
    }

    public function destroy(Request $request, $id) {
        $course_category = CourseCategory::findOrFail($id);

        if ($course_category->courses->count())
            $request->session()->flash('message', 'Η εγγραφή "' . $course_category->name . '" δεν μπορεί να διαγραφεί διότι συσχετίζεται με μαθήματα.');
        else {
            $course_category->delete();
            $request->session()->flash('message', 'Η εγγραφή "' . $course_category->name . '" διαγράφηκε με επιτυχία.');
        }

        return redirect()->route('cms.course_categories.index');
    }

    private function createPicture($request, $courseCategory) {
        if ($request->hasFile('picture')) {
            if ($request->file('picture')->getClientOriginalExtension() == "svg") {
                $request->file('picture')->storeAs('course-categories', $courseCategory->id . '.' . $request->file('picture')->getClientOriginalExtension());
            }
        }
    }

}
