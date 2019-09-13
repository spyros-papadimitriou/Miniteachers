<?php

/*
  |--------------------------------------------------------------------------
  | Web Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register web routes for your application. These
  | routes are loaded by the RouteServiceProvider within a group which
  | contains the "web" middleware group. Now create something great!
  |
 */

// CMS Routes
Route::prefix('cms')->middleware('is_admin')->name('cms.')->namespace('Cms')->group(function () {
    Route::resources([
        'announcements' => 'AnnouncementController',
        'pages' => 'PageController',
        'genders' => 'GenderController',
        'extras' => 'ExtraController',
        'contact_data_types' => 'ContactDataTypeController',
        'institutions' => 'InstitutionController',
        'course_categories' => 'CourseCategoryController',
        'regions' => 'RegionController',
        'target_groups' => 'TargetGroupController',
        'experiences' => 'ExperienceController',
        'services' => 'ServiceController',
        'websites' => 'WebsiteController',
        'institutions.schools' => 'InstitutionSchoolController',
        'schools.departments' => 'SchoolDepartmentController',
        'course_categories.courses' => 'CourseCategoryCourseController',
        'regions.regional_units' => 'RegionRegionalUnitController',
        'regional_units.municipalities' => 'RegionalUnitMunicipalityController',
        'actions' => 'ActionController',
        'achievement_types' => 'AchievementTypeController',
        'achievement_types.achievements' => 'AchievementTypeAchievementController',
        'levels' => 'LevelController',
        'age_ranges' => 'AgeRangeController',
        'agents' => 'AgentController',
        'tips' => 'TipController',
        'notification_types' => 'NotificationTypeController',
        'adjectives' => 'AdjectiveController',
    ]);
    Route::resource('users', 'UserController')->only([
        'index', 'show'
    ]);

    Route::get('', function() {
        return view('cms.dashboard');
    })->name('dashboard');
});

// Edit Profile Routes
Route::prefix('profile/edit')->middleware('auth')->namespace('Profile')->name('profile.')->group(function () {
    Route::resource('basic-info', 'BasicInfoController')->only([
        'edit', 'update'
    ]);
    Route::resource('extra', 'ExtraController')->except([
        'show'
    ]);
    Route::resource('target-groups', 'TargetGroupController')->only([
        'index', 'create', 'store', 'destroy'
    ]);
    Route::resource('services', 'ServiceController')->only([
        'index', 'create', 'store', 'destroy'
    ]);
    Route::resource('departments', 'DepartmentController')->except([
        'show'
    ]);
    Route::resource('postgraduates', 'PostGraduateController')->except([
        'show'
    ]);
    Route::resource('phds', 'PhdController')->except([
        'show'
    ]);
    Route::resource('contact-data', 'ContactDataController')->except([
        'show'
    ]);
    Route::resource('websites', 'WebsiteController')->except([
        'show'
    ]);
    Route::resource('courses', 'CourseController')->only([
        'index', 'create', 'store', 'destroy'
    ]);
    Route::resource('municipalities', 'MunicipalityController')->only([
        'index', 'create', 'store', 'destroy'
    ]);
    Route::resource('favourites', 'FavouriteController')->only([
        'index', 'destroy'
    ]);
    Route::resource('adjectives', 'AdjectiveController')->only([
        'index', 'create', 'store', 'destroy'
    ]);
});

Auth::routes();
Route::get('/', 'HomeController@index')->name('home');

// Various routes (page, messages, contact)
Route::get('/page/{page}-{slug}', 'PageController@show')->name('page');
Route::get('/contact', 'ContactController@show')->name('contact');
Route::post('/contact', 'ContactController@send')->name('contact');
Route::put('/favourite/{user}', 'FavouriteController@update')->middleware('auth')->name('update-favourites');

// Profile routes
Route::get('/profile/{user?}', 'ProfileController@show')->name('profile-show');
Route::get('/profile/{user}-{slug}', 'ProfileController@show')->name('profile-slug-show');
Route::get('/svg/user/{user}', 'SvgController@show')->name('svg-user');

// Search routes
Route::get('/course/{course}-{slug}', 'SearchController@searchByCourse')->name('search-by-course');
Route::get('/course/{course}-{slug_course}/municipality/{municipality}-{slug_municipality}', 'SearchController@searchByCourseAndMunicipality')->name('search-by-course-and-municipality');
Route::get('/course/{course}-{slug_course}/regional-unit/{regional_unit}-{slug_regional_unit}', 'SearchController@searchByCourseAndRegionalUnit')->name('search-by-course-and-regional-unit');
Route::get('/search', 'SearchController@search')->name('search');

// Analytics routes
Route::get('/analytics', 'AnalyticsController@search')->name('analytics');
Route::get('/analytics-popular', 'AnalyticsController@popular')->name('analytics-popular');

// Statistics routes
Route::get('/statistics', 'StatisticsController@index')->name('statistics');
Route::get('/statistics-popular/{usertype}-{slug}', 'StatisticsController@popular')->name('statistics-popular');

// Leaderboard routes
Route::get('/leaderboard', 'LeaderboardController@index')->name('leaderboard');

// Social OAuth 2.0
Route::get('/login/{service}', 'SocialAuthController@login')->name('login-service');
Route::get('/callback/{service}', 'SocialAuthController@callback');

// GDPR routes
Route::get('/gdpr', 'GDPRController@index')->name('gdpr-index');
Route::get('/gdpr-right-to-be-informed', 'GDPRController@rightToBeInformed')->name('gdpr-right-to-be-informed');
Route::get('/gdpr-right-of-access', 'GDPRController@rightOfAccess')->middleware('auth')->name('gdpr-right-of-access');
Route::get('/gdpr-export-data', 'GDPRController@exportData')->middleware('auth')->name('gdpr-export-data');
Route::delete('/gdpr-right-to-be-forgotten', 'GDPRController@rightToBeForgotten')->middleware('auth')->name('gdpr-right-to-be-forgotten');

// Conversations - Messages routes
Route::resource('conversations', 'ConversationController')->middleware('auth')->only([
    'index', 'create', 'store', 'show', 'destroy'
]);
Route::resource('messages', 'MessageController')->middleware('auth')->only([
    'destroy'
]);

// User Actions routes
Route::get('/points', 'UserActionController@index')->name('points');

// Achievements
Route::get('/achievements', 'AchievementController@index')->name('achievements');

// Announcements routes
Route::get('/announcements', 'AnnouncementController@index')->name('announcements');
