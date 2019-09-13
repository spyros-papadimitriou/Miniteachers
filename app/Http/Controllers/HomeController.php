<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Page;
use App\CourseCategory;
use App\User;
use App\UserType;
use App\Course;
use App\Municipality;
use App\RegionalUnit;
use App\Announcement;

class HomeController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $page = Page::findOrFail(1);
        $courseCategories = CourseCategory::with('courses')->get();

        $rand = rand(1, 4);
        // $rand = 3;

        switch ($rand) {
            case 1:
                $randomCourse = Course::inRandomOrder()->first();
                $usersTitle = "Κορυφαίοι miniteachers στο μάθημα " . $randomCourse->name . ".";
                $usersTitleImage = "points";
                $users = $this->getTopByCourse($randomCourse, UserType::TEACHER);
                break;

            case 2:
                $randomCourse = Course::inRandomOrder()->first();
                $usersTitle = "Κορυφαίοι miniguests που ενδιαφέρονται για ιδιαίτερα στο μάθημα " . $randomCourse->name . ".";
                $usersTitleImage = "points";
                $users = $this->getTopByCourse($randomCourse, UserType::GUEST);
                break;

            case 3:
                $randomCourse = Course::inRandomOrder()->first();
                $randomMunicipality = Municipality::inRandomOrder()->first();

                $usersTitle = "Κορυφαίοι miniteachers στο μάθημα " . $randomCourse->name . " στο " . str_replace('Δήμος', 'Δήμο', $randomMunicipality->name) . ".";
                $usersTitleImage = "points";
                $users = $this->getTopByCourseAndMunicipality($randomCourse, $randomMunicipality, UserType::TEACHER);
                break;

            case 4:
                $randomCourse = Course::inRandomOrder()->first();
                $randomMunicipality = Municipality::inRandomOrder()->first();

                $usersTitle = "Κορυφαίοι miniguests που ενδιαφέρονται για το μάθημα " . $randomCourse->name . " στο " . str_replace('Δήμος', 'Δήμο', $randomMunicipality->name) . ".";
                $usersTitleImage = "points";
                $users = $this->getTopByCourseAndMunicipality($randomCourse, $randomMunicipality, UserType::GUEST);
                break;

            case 5:
                $randomCourse = Course::inRandomOrder()->first();
                $randomRegionalUnit = RegionalUnit::inRandomOrder()->first();

                $usersTitle = "Κορυφαίοι miniteachers στο μάθημα " . $randomCourse->name . " στην περιοχή " . $randomRegionalUnit->name . ".";
                $usersTitleImage = "points";
                $users = $this->getTopByCourseAndRegionalUnit($randomCourse, $randomRegionalUnit, UserType::TEACHER);
                break;

            case 6:
                $randomCourse = Course::inRandomOrder()->first();
                $randomRegionalUnit = RegionalUnit::inRandomOrder()->first();

                $usersTitle = "Κορυφαίοι miniguests που ενδιαφέρονται για το μάθημα " . $randomCourse->name . " στην περιοχή " . $randomRegionalUnit->name . ".";
                $usersTitleImage = "points";
                $users = $this->getTopByCourseAndRegionalUnit($randomCourse, $randomRegionalUnit, UserType::GUEST);
                break;

            case 7:
                $usersTitle = "Νέοι miniguests.";
                $usersTitleImage = "new";
                $users = $this->getLatest(UserType::GUEST);
                break;

            default:
                $usersTitle = "Νέοι miniteachers.";
                $usersTitleImage = "new";
                $users = $this->getLatest(UserType::TEACHER);
                break;
        }

        $announcements = Announcement::orderBy('id', 'desc')->paginate(5);


        return view('home', ['page' => $page, 'courseCategories' => $courseCategories, 'users' => $users, 'usersTitle' => $usersTitle, 'usersTitleImage' => $usersTitleImage, 'announcements' => $announcements]);
    }

    private function getLatest($userTypeId) {
        $users = User::join('user_stat', 'user.id', '=', 'user_stat.id')
                        ->where('user_stat.published', 1)
                        ->where('id_user_type', $userTypeId)
                        ->orderBy('user.id', 'desc')->limit(4)->get();

        return $users;
    }

    private function getTopByCourse(Course $course, $userTypeId) {
        $users = User::join('user_stat', 'user.id', '=', 'user_stat.id')
                        ->where('user_stat.published', 1)
                        ->where('id_user_type', $userTypeId)
                        ->whereHas('courses', function ($query) use ($course) {
                            $query->where('id', $course->id);
                        })
                        ->orderBy('user_stat.points', 'desc')->limit(4)->get();

        return $users;
    }

    private function getTopByCourseAndMunicipality(Course $course, Municipality $municipality, $userTypeId) {
        $users = User::join('user_stat', 'user.id', '=', 'user_stat.id')
                        ->where('user_stat.published', 1)
                        ->where('id_user_type', $userTypeId)
                        ->whereHas('courses', function ($query) use ($course) {
                            $query->where('id', $course->id);
                        })
                        ->whereHas('municipalities', function ($query) use ($municipality) {
                            $query->where('id', $municipality->id);
                        })
                        ->orderBy('user_stat.points', 'desc')->limit(4)->get();

        return $users;
    }

    private function getTopByCourseAndRegionalUnit(Course $course, RegionalUnit $regionalUnit, $userTypeId) {
        $users = User::join('user_stat', 'user.id', '=', 'user_stat.id')
                        ->where('user_stat.published', 1)
                        ->where('id_user_type', $userTypeId)
                        ->whereHas('courses', function ($query) use ($course) {
                            $query->where('id', $course->id);
                        })
                        ->whereHas('municipalities', function ($query) use ($regionalUnit) {
                            $query->where('id_regional_unit', $regionalUnit->id);
                        })
                        ->orderBy('user_stat.points', 'desc')->limit(4)->get();

        return $users;
    }

}
