<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Course;
use App\Region;
use App\RegionalUnit;
use App\Municipality;
use App\User;
use App\Experience;
use App\TargetGroup;
use App\Service;
use App\Website;
use App\Gender;
use App\AgeRange;
use App\Institution;
use App\Search;
use App\CourseCategory;
use App\UserType;
use App\Adjective;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;
use Jenssegers\Agent\Agent;

class SearchController extends Controller {

    private $maxResults = 12;

    public function searchByCourse(Request $request, $courseId) {
        // Db::enableQueryLog();
        // dd(DB::getQueryLog());
        $userType = $this->adjustUserType();
        $course = Course::findOrFail($courseId);
        $regions = Region::with('regionalUnits')->orderBy('name')->get();
        $users = User::join('user_stat', 'user.id', '=', 'user_stat.id')
                ->where('user_stat.published', 1)
                ->where('id_user_type', $userType->id)
                ->orderBy('user_stat.points', 'desc')
                ->whereHas('courses', function ($query) use ($course) {
                    $query->where('id', $course->id);
                })
                ->paginate($this->maxResults);

        $search = new Search();
        if (Auth::check()) {
            $search->id_user = Auth::user()->id;
        }
        $search->userType()->associate($userType);
        $search->ip = $request->ip();
        $search->user_agent = $request->header('User-Agent');
        $search->page = ($request->page == null ? 1 : (int) $request->page);
        $agent = new Agent();
        if (!(Auth::check() && Auth::user()->id_user_type == UserType::ADMIN) && !$agent->isRobot()) {
            try {
                $search->save();
                $search->courses()->attach($course);
            } catch (QueryException $e) {
                // do nothing
            }
        }

        return view('search.simple', ['title' => $course->name, 'course' => $course, 'users' => $users, 'regions' => $regions, 'search' => $search]);
    }

    public function searchByCourseAndMunicipality(Request $request, $courseId, $slugCourse, $municipalityId, $slugMunicipality) {
        $userType = $this->adjustUserType();
        $course = Course::findOrFail($courseId);
        $municipality = Municipality::findOrFail($municipalityId);
        $regions = Region::with('regionalUnits')->orderBy('name')->get();
        $users = User::join('user_stat', 'user.id', '=', 'user_stat.id')
                ->where('user_stat.published', 1)
                ->where('id_user_type', $userType->id)
                ->orderBy('user_stat.points', 'desc')
                ->whereHas('courses', function ($query) use ($course) {
                    $query->where('id', $course->id);
                })
                ->whereHas('municipalities', function ($query) use ($municipality) {
                    $query->where('id', $municipality->id);
                })
                ->paginate($this->maxResults);

        $search = new Search();
        if (Auth::check()) {
            $search->id_user = Auth::user()->id;
        }
        $search->userType()->associate($userType);
        $search->ip = $request->ip();
        $search->user_agent = $request->header('User-Agent');
        $search->page = ($request->page == null ? 1 : (int) $request->page);
        $search->municipality()->associate($municipality);
        $agent = new Agent();
        if (!(Auth::check() && Auth::user()->id_user_type == UserType::ADMIN) && !$agent->isRobot()) {
            try {
                $search->save();
                $search->courses()->attach($course);
            } catch (QueryException $e) {
                // do nothing
            }
        }

        return view('search.simple', ['title' => $course->name . ', ' . $municipality->name, 'course' => $course, 'municipality' => $municipality, 'users' => $users, 'regions' => $regions, 'search' => $search]);
    }

    public function searchByCourseAndRegionalUnit(Request $request, $courseId, $slugCourse, $regionalUnitId, $slugRegionalUnit) {
        $userType = $this->adjustUserType();
        $course = Course::findOrFail($courseId);
        $regionalUnit = RegionalUnit::findOrFail($regionalUnitId);
        $regions = Region::with('regionalUnits')->orderBy('name')->get();

        $users = User::join('user_stat', 'user.id', '=', 'user_stat.id')
                ->where('user_stat.published', 1)
                ->where('id_user_type', $userType->id)
                ->orderBy('user_stat.points', 'desc')
                ->whereHas('courses', function ($query) use ($course) {
                    $query->where('id', $course->id);
                })
                ->whereHas('municipalities', function ($query) use ($regionalUnit) {
                    $query->where('id_regional_unit', $regionalUnit->id);
                })
                ->paginate($this->maxResults);

        $search = new Search();
        if (Auth::check()) {
            $search->id_user = Auth::user()->id;
        }
        $search->userType()->associate($userType);
        $search->ip = $request->ip();
        $search->user_agent = $request->header('User-Agent');
        $search->page = ($request->page == null ? 1 : (int) $request->page);
        $search->regionalUnit()->associate($regionalUnit);
        $agent = new Agent();
        if (!(Auth::check() && Auth::user()->id_user_type == UserType::ADMIN) && !$agent->isRobot()) {
            try {

                $search->save();
                $search->courses()->attach($course);
            } catch (QueryException $e) {
                // do nothing
            }
        }

        return view('search.simple', ['title' => $course->name . ', ' . $regionalUnit->name, 'course' => $course, 'regionalUnit' => $regionalUnit, 'users' => $users, 'regions' => $regions, 'search' => $search]);
    }

    public function search(Request $request) {
        $userType = $this->adjustUserType();
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

        $search = new Search();
        $search->userType()->associate($userType);

        if ($request->submitted == 1) {
            $search->name = $request->name;
            $search->price_from = $request->priceFrom;
            $search->price_to = $request->priceTo;

            if ($request->userType != 0)
                $search->userType()->associate(UserType::find($request->userType));
            if ($request->gender != 0)
                $search->gender()->associate(Gender::find($request->gender));
            if ($request->ageRange != 0)
                $search->ageRange()->associate(AgeRange::find($request->ageRange));
            if ($request->experience != 0)
                $search->experience()->associate(Experience::find($request->experience));
            if ($request->municipality != 0)
                $search->municipality()->associate(Municipality::find($request->municipality));
            if ($request->targetGroup != 0)
                $search->targetGroup()->associate(TargetGroup::find($request->targetGroup));


            $search->postgraduate = (int) $request->postgraduate > 0;
            $search->phd = (int) $request->phd > 0;
            $search->ip = $request->ip();
            $search->user_agent = $request->header('User-Agent');
            $search->page = ($request->page == null ? 1 : (int) $request->page);

            if (Auth::check()) {
                $search->id_user = Auth::user()->id;
            }

            $agent = new Agent();
            if (!(Auth::check() && Auth::user()->id_user_type == UserType::ADMIN) && !$agent->isRobot()) {
                try {
                    $search->save();
                    $search->departments()->attach($request->departments);
                    $search->websites()->attach($request->websites);
                    $search->adjectives()->attach($request->adjectives);
                    $search->services()->attach($request->services);
                    $search->courses()->attach($request->courses);
                } catch (QueryException $e) {
                    // do nothing
                }
            }

            $users = $this->searchByCriteria($search);
        } else {
            $users = null;
        }

        return view('search.advanced', ['title' => 'Σύνθετη αναζήτηση', 'search' => $search, 'userTypes' => $userTypes, 'courseCategories' => $courseCategories, 'targetGroups' => $targetGroups, 'services' => $services, 'websites' => $websites, 'experiences' => $experiences, 'regions' => $regions, 'ageRanges' => $ageRanges, 'genders' => $genders, 'institutions' => $institutions, 'adjectives' => $adjectives, 'users' => $users]);
    }

    private function searchByCriteria(Search $search) {
        // Db::enableQueryLog();
        $query = User::join('user_stat', 'user.id', '=', 'user_stat.id')
                ->where('user_stat.published', 1)
                ->orderBy('user_stat.points', 'desc')
				->orderBy('user_stat.id', 'asc');


        if ($search->userType != null) {
            $query->where('id_user_type', $search->userType->id);
        }
        if ($search->name != null) {
            $query->where('name', 'like', '%' . $search->name . '%');
        }
        if ($search->price_from != null) {
            $query->where('user_stat.price_per_hour', ">=", $search->price_from);
        }
        if ($search->price_to != null) {
            $query->where('user_stat.price_per_hour', "<=", $search->price_to);
        }
        if ($search->gender != null) {
            $query->where('id_gender', $search->gender->id);
        }
        if ($search->ageRange != null) {
            $time = time();
            $currentYear = date('Y', $time);
            $currentMonth = date('m', $time);
            $currentDay = date('d', $time);

            if ($search->ageRange->age_from != null) {
                $dateTo = ($currentYear - $search->ageRange->age_from) . '-' . $currentMonth . '-' . $currentDay;
            } else {
                $dateTo = date('Y-m-d', $time);
            }
            if ($search->ageRange->age_to != null) {
                $dateFrom = ($currentYear - $search->ageRange->age_to) . '-' . $currentMonth . '-' . $currentDay;
            } else {
                $dateFrom = '1900-01-01';
            }

            $query->whereBetween('birthdate', [$dateFrom, $dateTo]);
        }
        if ($search->experience != null) {
            $query->where('id_experience', $search->experience->id);
        }
        if ($search->targetGroup != null) {
            $targetGroup = $search->targetGroup;
            $query->whereHas('targetGroups', function ($query) use ($targetGroup) {
                $query->where('id', $targetGroup->id);
            });
        }
        if ($search->services->count()) {
            $services = $search->services;
            $query->whereHas('services', function ($query) use ($services) {
                $query->whereIn('id', $services);
            });
        }
        if ($search->courses->count()) {
            $courses = $search->courses;
            $query->whereHas('courses', function ($query) use ($courses) {
                $query->whereIn('id', $courses);
            });
        }
        if ($search->municipality != null) {
            $municipality = $search->municipality;
            $query->whereHas('municipalities', function ($query) use ($municipality) {
                $query->where('id', $municipality->id);
            });
        }
        if ($search->departments->count()) {
            $departments = $search->departments;
            $query->whereHas('departments', function ($query) use ($departments) {
                $query->whereIn('id', $departments);
            });
        }
        if ($search->postgraduate) {
            $query->whereHas('postgraduates');
        }
        if ($search->phd) {
            $query->whereHas('phds');
        }
        if ($search->websites->count()) {
            $websites = $search->websites;
            $query->whereHas('websites', function ($query) use ($websites) {
                $query->whereIn('id', $websites);
            });
        }
        if ($search->adjectives->count()) {
            $adjectives = $search->adjectives;
            $query->whereHas('adjectives', function ($query) use ($adjectives) {
                $query->whereIn('id', $adjectives);
            });
        }

        $users = $query->paginate($this->maxResults);
        // dd(DB::getQueryLog());

        return $users;
    }

    private function adjustUserType() {
        if (Auth::check() && Auth::user()->userType->id == UserType::TEACHER) {
            $userType = UserType::find(UserType::GUEST);
        } else {
            $userType = UserType::find(UserType::TEACHER);
        }

        return $userType;
    }

}
