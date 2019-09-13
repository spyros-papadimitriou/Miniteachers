<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;
use App\UserType;
use App\Course;
use App\RegionalUnit;
use App\Municipality;
use App\Department;
use App\TargetGroup;
use App\Service;
use App\Adjective;

class StatisticsController extends Controller {

    private $total = 5;

    public function index() {
        $userTypes = UserType::where('id', '<>', UserType::ADMIN)->get();

        return view('statistics.index', ['userTypes' => $userTypes]);
    }

    public function popular($userTypeid) {
        // Db::enableQueryLog();
        $userType = UserType::where('id', '<>', UserType::ADMIN)->where('id', $userTypeid)->firstOrFail();

        $totalUsers = User::where('id_user_type', $userType->id)->count();

        $courses = Course::withCount(['users' => function ($query) use ($userType) {
                        $query->where('id_user_type', $userType->id);
                    }])
                ->orderBy('users_count', 'desc')
                ->paginate($this->total);
        $regionalUnit = RegionalUnit::inRandomOrder()->first();
        $municipalities = Municipality::withCount(['users' => function ($query) use ($userType) {
                        $query->where('id_user_type', $userType->id);
                    }])
                ->where('id_regional_unit', $regionalUnit->id)
                ->orderBy('users_count', 'desc')
                ->paginate($this->total);
        $deparments = Department::withCount(['users' => function ($query) use ($userType) {
                        $query->where('id_user_type', $userType->id);
                    }])
                ->orderBy('users_count', 'desc')
                ->paginate($this->total);
        $prices = User::join('user_stat', 'user.id', '=', 'user_stat.id')
                ->select('user_stat.price_per_hour', DB::raw('count(*) as total'))
                ->where('id_user_type', $userType->id)
                ->groupBy('user_stat.price_per_hour')
                ->orderBy('total', 'desc')
                ->paginate($this->total);
        $targetGroups = TargetGroup::withCount(['users' => function ($query) use ($userType) {
                        $query->where('id_user_type', $userType->id);
                    }])
                ->orderBy('users_count', 'desc')
                ->paginate($this->total);
        $experiences = User::join('user_stat', 'user.id', '=', 'user_stat.id')
                ->join('experience', 'user_stat.id_experience', '=', 'experience.id')
                ->where('id_user_type', $userType->id)
                ->select('user_stat.id_experience', 'experience.name', DB::raw('count(*) as total'))
                ->groupBy('user_stat.id_experience', 'experience.name')
                ->orderBy('total', 'desc')
                ->paginate($this->total);
        $genders = User::join('gender', 'user.id_gender', '=', 'gender.id')
                ->where('id_user_type', $userType->id)
                ->select('gender.id', 'gender.name', DB::raw('count(*) as total'))
                ->groupBy('gender.id', 'gender.name')
                ->orderBy('total', 'desc')
                ->paginate($this->total);
        $postgraduates = User::whereHas('postgraduates')
                ->where('id_user_type', $userType->id)
                ->count();
        $phds = User::whereHas('phds')
                ->where('id_user_type', $userType->id)
                ->count();
        $services = Service::withCount(['users' => function ($query) use ($userType) {
                        $query->where('id_user_type', $userType->id);
                    }])
                ->orderBy('users_count', 'desc')
                ->paginate($this->total);
        $adjectives = Adjective::withCount(['users' => function ($query) use ($userType) {
                        $query->where('id_user_type', $userType->id);
                    }])
                ->orderBy('users_count', 'desc')
                ->paginate($this->total);

        return view('statistics.popular', ['userType' => $userType, 'totalUsers' => $totalUsers, 'courses' => $courses, 'municipalities' => $municipalities, 'regionalUnit' => $regionalUnit, 'departments' => $deparments, 'prices' => $prices, 'targetGroups' => $targetGroups, 'experiences' => $experiences, 'genders' => $genders, 'postgraduates' => $postgraduates, 'phds' => $phds, 'services' => $services, 'adjectives' => $adjectives]);
    }

}
