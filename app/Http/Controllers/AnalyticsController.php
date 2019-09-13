<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\UserType;
use App\Gender;
use \App\Experience;
use App\TargetGroup;
use App\Service;
use App\Website;
use App\Region;
use App\AgeRange;
use App\Institution;
use App\CourseCategory;
use App\Course;
use App\Search;
use App\Criteria;
use App\Municipality;
use App\Department;
use App\RegionalUnit;
use App\Adjective;

class AnalyticsController extends Controller {

    private $maxResults = 20;

    public function __construct() {
        $this->middleware('auth');
    }

    public function search(Request $request) {
        $userTypes = UserType::whereNotIn('id', [UserType::ADMIN])->get();
        $genders = Gender::all();
        $experiences = Experience::all();
        $targetGroups = TargetGroup::all();
        $services = Service::all();
        $websites = Website::all();
        $adjectives = Adjective::all();
        $regions = Region::with('regionalUnits')->get();
        $ageRanges = AgeRange::all();
        $institutions = Institution::all();
        $courseCategories = CourseCategory::with('courses')->get();

        $criteria = new Criteria();

        if ($request->submitted == 1) {
            // Free text
            $criteria->id = 1;
            $criteria->name = $request->name;
            $criteria->price_from = $request->priceFrom;
            $criteria->price_to = $request->priceTo;

            // Boolean
            $criteria->postgraduate = $request->postgraduate == 1;
            $criteria->phd = $request->phd == 1;

            // Belongs to
            if ($request->userType == UserType::TEACHER || $request->userType == UserType::GUEST)
                $criteria->userType = UserType::find($request->userType);
            if ($request->gender > 0)
                $criteria->gender = Gender::find($request->gender);
            if ($request->ageRange > 0)
                $criteria->ageRange = AgeRange::find($request->ageRange);
            if ($request->course > 0)
                $criteria->course = Course::find($request->course);
            if ($request->municipality > 0)
                $criteria->municipality = Municipality::find($request->municipality);

            // Has many
            $criteria->services = Service::find($request->services);
            $criteria->courses = Course::find($request->courses);
            $criteria->departments = Department::find($request->departments);
            $criteria->websites = Website::find($request->websites);
            $criteria->adjectives = Adjective::find($request->adjectives);

            $searches = $this->searchByCriteria($criteria);
        } else {
            $searches = null;
        }

        $request->flash();
        return view('analytics.index', ['title' => 'Σύνθετη αναζήτηση', 'criteria' => $criteria, 'userTypes' => $userTypes, 'courseCategories' => $courseCategories, 'targetGroups' => $targetGroups, 'services' => $services, 'websites' => $websites, 'adjectives' => $adjectives, 'experiences' => $experiences, 'regions' => $regions, 'ageRanges' => $ageRanges, 'genders' => $genders, 'institutions' => $institutions, 'searches' => $searches]);
    }

    public function popular() {
        // Db::enableQueryLog();
        $courses = Course::withCount('searches')
                ->orderBy('searches_count', 'desc')
                ->paginate(10);

        $departments = Department::withCount('searches')
                ->orderBy('searches_count', 'desc')
                ->paginate(10);

        $services = Service::withCount('searches')
                ->orderBy('searches_count', 'desc')
                ->paginate(10);

        $websites = Website::withCount('searches')
                ->orderBy('searches_count', 'desc')
                ->paginate(10);

        $adjectives = Adjective::withCount('searches')
                ->orderBy('searches_count', 'desc')
                ->paginate(10);

        $municipalities = Municipality::withCount('searches')
                ->orderBy('searches_count', 'desc')
                ->paginate(10);

        $genders = Gender::withCount('searches')
                ->orderBy('searches_count', 'desc')
                ->paginate(10);

        $ageRanges = AgeRange::withCount('searches')
                ->orderBy('searches_count', 'desc')
                ->paginate(10);

        $experiences = Experience::withCount('searches')
                ->orderBy('searches_count', 'desc')
                ->paginate(10);

        $regionalUnits = RegionalUnit::withCount('searches')
                ->orderBy('searches_count', 'desc')
                ->paginate(10);

        $targetGroups = TargetGroup::withCount('searches')
                ->orderBy('searches_count', 'desc')
                ->paginate(10);

        $userTypes = UserType::withCount('searches')
                ->where('id', '<>', UserType::ADMIN)
                ->orderBy('searches_count', 'desc')
                ->paginate(10);

        $postgraduates = Search::where('postgraduate', 1)->count();
        $phds = Search::where('phd', 1)->count();

        // dd(Db::getQueryLog());

        return view('analytics.popular', ['courses' => $courses, 'departments' => $departments, 'services' => $services, 'websites' => $websites, 'adjectives' => $adjectives, 'municipalities' => $municipalities, 'genders' => $genders, 'ageRanges' => $ageRanges, 'experiences' => $experiences, 'regionalUnits' => $regionalUnits, 'targetGroups' => $targetGroups, 'userTypes' => $userTypes, 'postgraduates' => $postgraduates, 'phds' => $phds]);
    }

    // Private methods
    private function searchByCriteria(Criteria $criteria) {
        Db::enableQueryLog();
        $query = Search:: orderBy('search.id', 'desc');

        // Free text
        if ($criteria->name != null) {
            $query->where('name', 'like', '%' . $criteria->name . '%');
        }
        if ($criteria->price_from != null) {
            $query->where('price_from', $criteria->price_from);
        }
        if ($criteria->price_to != null) {
            $query->where('price_to', $criteria->price_to);
        }

        // Boolean
        if ($criteria->postgraduate == 1) {
            $query->where('postgraduate', 1);
        }
        if ($criteria->phd == 1) {
            $query->where('phd', 1);
        }

        // Belongs to
        if ($criteria->userType != null) {
            $query->where('id_user_type', $criteria->userType->id);
        }
        if ($criteria->gender != null) {
            $query->where('id_gender', $criteria->gender->id);
        }
        if ($criteria->ageRange != null) {
            $query->where('id_age_range', $criteria->ageRange->id);
        }
        if ($criteria->course != null) {
            $query->where('id_course', $criteria->course->id);
        }
        if ($criteria->municipality != null) {
            $query->where('id_municipality', $criteria->municipality->id);
        }

        // Has many
        $services = $criteria->services;
        if ($services != null) {
            $query->whereHas('services', function ($query) use ($services) {
                $query->whereIn('id', $services);
            });
        }

        $courses = $criteria->courses;
        if ($courses != null) {
            $query->whereHas('courses', function ($query) use ($courses) {
                $query->whereIn('id', $courses);
            });
        }

        $departments = $criteria->departments;
        if ($departments != null) {
            $query->whereHas('departments', function ($query) use ($departments) {
                $query->whereIn('id', $departments);
            });
        }

        $websites = $criteria->websites;
        if ($websites != null) {
            $query->whereHas('websites', function ($query) use ($websites) {
                $query->whereIn('id', $websites);
            });
        }

        $adjectives = $criteria->adjectives;
        if ($adjectives != null) {
            $query->whereHas('adjectives', function ($query) use ($adjectives) {
                $query->whereIn('id', $adjectives);
            });
        }

        $searches = $query->paginate($this->maxResults);
        // dd(DB::getQueryLog());
        //  dd($criteria);

        return $searches;
    }

}
