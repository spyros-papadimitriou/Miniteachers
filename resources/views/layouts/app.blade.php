<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

	<meta name="keywords" content="ιδιαίτερα μαθήματα, εκπαίδευση, miniteachers, miniguests, μαθηματικά, ιστορία, σχέδιο, πληροφορική, χημεία, δημοτικό, 
γυμνάσιο, λύκειο, σπουδές">
        <meta name="description" content="Διαδικτυακή πλατφόρμα αναζήτησης εκπαιδευτικών και μαθητών για ιδιαίτερα μαθήματα.">

        <title>{{ config('app.name')}} - {{ $title ?? 'Διαδικτυακή πλατφόρμα αναζήτησης εκπαιδευτικών και μαθητών για ιδιαίτερα μαθήματα' }}</title>

        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link href="{{ asset('css/custom.css') }}" rel="stylesheet">

        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-720983-8"></script>
        <script>
window.dataLayer = window.dataLayer || [];
function gtag() {
    dataLayer.push(arguments);
}
gtag('js', new Date());

gtag('config', 'UA-720983-8');
        </script>
    </head>
    <body>

        <div id="app">

            @auth
            @include('layouts.toasts')
            @endauth

            <nav class="navbar navbar-expand-md navbar-dark bg-primary navbar-laravel mb-2 small">
                <div class="container">
                    <a class="navbar-brand" href="{{ url('/') }}">
                        <img height="30" src="{{ asset('svg/logo.svg') }}" alt=""> 
                        {{ config('app.name') }}
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <!-- Left Side Of Navbar -->
                        <ul class="navbar-nav mr-auto">
                            @foreach ($courseCategories as $courseCategory)
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="dropdownCourseCategory{{ $courseCategory->id}}" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    {{ $courseCategory->name}}
                                </a>
                                <div class="dropdown-menu" aria-labelledby="dropdownCourseCategory{{ $courseCategory->id}}">
                                    @foreach ($courseCategory->courses->sortBy('name') as $course)
                                    <a class="dropdown-item small" href="{{ route('search-by-course', ['course' => $course->id, 'slug'=>str_slug($course->name)]) }}">{{ $course->name }}</a>
                                    @endforeach
                                </div>
                            </li>
                            @endforeach
                            <li class="nav-item dropdown"><a class="nav-link" href="{{ route('search') }}">Σύνθετη αναζήτηση</a></li>
                        </ul>

                        <!-- Right Side Of Navbar -->
                        @guest
                        @include('menu.guest')
                        @endguest
                        @auth
                        @include('menu.auth')
                        @endauth
                    </div>
                </div>
            </nav>


            @auth
            <section id="top-bar">
                <div class="container">
                    <div class="row">                        
                        <div class="col-md-12">
                            <div class="progress" style="height: 25px;">
                                <div class="progress-bar bg-light" role="progressbar" style="width: 5%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                                    <img height="20" src="{{ asset('svg/usertypes/avatar-'.$globalUser->userType->id.'-'.$globalUser->gender->id.'.svg') }}" alt="">
                                </div>

                                <div class="progress-bar" role="progressbar" style="width: 20%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">Επίπεδο {{ $globalUser->userStat->level->id }}</div>

                                <div class="progress-bar bg-success" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                                    @male
                                    {{ $globalUser->userStat->level->name_male }}
                                    @else
                                    {{ $globalUser->userStat->level->name_female }}
                                    @endmale
                                </div>
                                <div class="progress-bar bg-info text-dark" role="progressbar" style="width: {{ $globalUser->userStat->percent * 0.5 }}%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">minipoints: {{ $globalUser->userStat->points }} από {{ $globalUser->userStat->nextLevel->points_needed }} ({{ $globalUser->userStat->percent }}%)</div>

                            </div>
                        </div>
                    </div>

                </div>
            </section>
            @endauth

            <main class="py-4">
                @yield('content')
            </main>

            <footer class="footer small">
                <div class="container">
                    <div class="row">
                        <div class="col-md-3 text-md-left text-center">
                            &copy; 2019 <a href="http://www.miniplay.gr" target="_blank">miniplay.gr</a>
                            |
                            <a href="{{ route('page', ['page'=>6,'slug'=>'credits']) }}">credits</a>
                        </div>
                        <div class="col-md-9 text-md-right text-center">
                            <a href="{{ route('page', ['page'=>5, 'slug' => 'ti-einai-to-miniteachers']) }}">Τι είναι το miniteachers</a> |
                            <a href="{{ route('page', ['page'=>2, 'slug' => 'oroi-xrisis']) }}">Όροι χρήσης</a> | 
                            <a href="{{ route('gdpr-index') }}">GDPR - Δικαιώματα</a> | 
                            <a href="{{ route('contact') }}">Επικοινωνία</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>




        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <script src='https://www.google.com/recaptcha/api.js?explicit&hl=el'></script> 
        <script src="{{ asset('js/custom.js') }}" defer></script>
    </body>
</html>
