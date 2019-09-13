<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name')}} - Διαχείριση</title>

        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    </head>
    <body>
        <div id="app">
            <nav class="navbar navbar-expand-md navbar-dark bg-primary navbar-laravel">
                <div class="container">
                    <a class="navbar-brand" href="{{ route('cms.dashboard') }}">
                        <img height="30" src="{{ asset('svg/logo.svg') }}" alt=""> 
                        {{ config('app.name', 'MiniTeachers') }} - Διαχείριση
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <!-- Left Side Of Navbar -->
                        <ul class="navbar-nav mr-auto">

                        </ul>

                        <!-- Right Side Of Navbar -->
                        <ul class="navbar-nav ml-auto">
                            <!-- Authentication Links -->
                            @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                            @endif
                            @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <img height="24" src="{{ asset('svg/cms/admin.svg') }}" alt="{{ Auth::user()->name }}" title="{{ Auth::user()->name }}" /> {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    @if (Auth::user()->id_user_type == App\UserType::ADMIN)
                                    <a class="dropdown-item" href="{{ route('home') }}" target="_blank"><img height="24" src="{{ asset('svg/cms/mainpage.svg') }}" alt="Κεντρική Σελίδα" title="Κεντρική Σελίδα" /> Κεντρική Σελίδα</a>
                                    @endif
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                               document.getElementById('logout-form').submit();">
                                        <img height="24" src="{{ asset('svg/cms/exit.svg') }}" alt="Έξοδος" title="Έξοδος" /> {{ __('Έξοδος') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                            @endguest
                        </ul>
                    </div>
                </div>
            </nav>

            <div class="container">
                <div class="row">&nbsp;</div>
                <div class="row">
                    <section id="sidebar" class="col-md-3">
                        <div class="list-group small">
                            <a href="{{ route('cms.dashboard') }}" class="list-group-item list-group-item-primary"><img height="24" src="{{ asset('svg/cms/home.svg') }}" alt="Αρχική Σελίδα" title="Αρχική Σελίδα" /> Αρχική Σελίδα</a>
                            <a href="{{ route('cms.announcements.index') }}" class="list-group-item"><img height="24" src="{{ asset('svg/cms/megaphone.svg') }}" alt="Σελίδες" title="Ανακοινώσεις" /> Ανακοινώσεις</a>
                            <a href="{{ route('cms.pages.index') }}" class="list-group-item"><img height="24" src="{{ asset('svg/cms/page.svg') }}" alt="Σελίδες" title="Σελίδες" /> Σελίδες</a>
                            <a href="{{ route('cms.genders.index') }}" class="list-group-item"><img height="24" src="{{ asset('svg/cms/gender.svg') }}" alt="Φύλα" title="Φύλα" /> Φύλα</a>
                            <a href="{{ route('cms.age_ranges.index') }}" class="list-group-item"><img height="24" src="{{ asset('svg/cms/age-range.svg') }}" alt="Φύλα" title="Φύλα" /> Ηλικιακά φάσματα</a>
                            <a href="{{ route('cms.extras.index') }}" class="list-group-item"><img height="24" src="{{ asset('svg/cms/extra.svg') }}" alt="Επιπλέον Πληροφορίες" title="Επιπλέον Πληροφορίες" /> Επιπλέον Πληροφορίες</a>
                            <a href="{{ route('cms.contact_data_types.index') }}" class="list-group-item"><img height="24" src="{{ asset('svg/cms/phone.svg') }}" alt="Είδη Στοιχείων Επικοινωνίας" title="Είδη Στοιχείων Επικοινωνίας" /> Είδη Στοιχείων Επικοινωνίας</a>
                            <a href="{{ route('cms.institutions.index') }}" class="list-group-item"><img height="24" src="{{ asset('svg/cms/university.svg') }}" alt="Εκπαιδευτικά Ιδρύματα" title="Εκπαιδευτικά Ιδρύματα" /> Εκπαιδευτικά Ιδρύματα</a>
                            <a href="{{ route('cms.course_categories.index') }}" class="list-group-item"><img height="24" src="{{ asset('svg/cms/course.svg') }}" alt="Κατηγορίες Μαθημάτων" title="Κατηγορίες Μαθημάτων" /> Κατηγορίες Μαθημάτων</a>
                            <a href="{{ route('cms.regions.index') }}" class="list-group-item"><img height="24" src="{{ asset('svg/cms/map.svg') }}" alt="Περιφέρειες" title="Περιφέρειες" /> Περιφέρειες</a>
                            <a href="{{ route('cms.target_groups.index') }}" class="list-group-item"><img height="24" src="{{ asset('svg/cms/target-group.svg') }}" alt="Ομάδες - Στόχοι" title="Ομάδες - Στόχοι" /> Ομάδες - Στόχοι</a>
                            <a href="{{ route('cms.experiences.index') }}" class="list-group-item"><img height="24" src="{{ asset('svg/cms/experience.svg') }}" alt="Εμπειρία" title="Εμπειρία" /> Εμπειρία</a>
                            <a href="{{ route('cms.services.index') }}" class="list-group-item"><img height="24" src="{{ asset('svg/cms/service.svg') }}" alt="Υπηρεσίες" title="Υπηρεσίες" /> Υπηρεσίες</a>
                            <a href="{{ route('cms.websites.index') }}" class="list-group-item"><img height="24" src="{{ asset('svg/cms/website.svg') }}" alt="Ιστοσελίδες" title="Ιστοσελίδες" /> Ιστοσελίδες</a>
                            <a href="{{ route('cms.agents.index') }}" class="list-group-item"><img height="24" src="{{ asset('svg/cms/agents.svg') }}" alt="Πράκτορες" title="Πράκτορες" /> Πράκτορες</a>
                            <a href="{{ route('cms.tips.index') }}" class="list-group-item"><img height="24" src="{{ asset('svg/cms/lightbulb.svg') }}" alt="Συμβουλές" title="Συμβουλές" /> Συμβουλές</a>
                            <a href="{{ route('cms.notification_types.index') }}" class="list-group-item"><img height="24" src="{{ asset('svg/cms/bell.svg') }}" alt="Τύποι ειδοποιήσεων" title="Τύποι ειδοποιήσεων" /> Τύποι ειδοποιήσεων</a>
                            <a href="{{ route('cms.adjectives.index') }}" class="list-group-item"><img height="24" src="{{ asset('svg/cms/adjective.svg') }}" alt="Στοιχεία χαρακτήρα" title="Στοιχεία χαρακτήρα" /> Στοιχεία χαρακτήρα</a>
                            <a href="{{ route('cms.users.index') }}" class="list-group-item"><img height="24" src="{{ asset('svg/cms/users.svg') }}" alt="Χρήστες" title="Χρήστες" /> Χρήστες</a>

                            <a href="{{ route('cms.levels.index') }}" class="list-group-item list-group-item-secondary"><img height="24" src="{{ asset('svg/cms/levels.svg') }}" alt="Επίπεδα" title="Επίπεδα" /> Επίπεδα</a>                       
                            <a href="{{ route('cms.actions.index') }}" class="list-group-item list-group-item-secondary"><img height="24" src="{{ asset('svg/cms/action.svg') }}" alt="Ενέργειες" title="Ενέργειες" /> Ενέργειες</a>                       
                            <a href="{{ route('cms.achievement_types.index') }}" class="list-group-item list-group-item-secondary"><img height="24" src="{{ asset('svg/cms/achievement.svg') }}" alt="Κατηγορίες Επιτευγμάτων" title="Κατηγορίες Επιτευγμάτων" /> Κατηγορίες Επιτευγμάτων</a>                       

                            <a href="{{ route('logout') }}"  onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();" class="list-group-item list-group-item-danger"><img height="24" src="{{ asset('svg/cms/exit.svg') }}" alt="Έξοδος" title="Έξοδος" /> Έξοδος</a>

                        </div>                
                    </section>
                    <main class="col-md-9 small">
                        @if ($errors->any())
                        <div class="col-md-6">                 
                            <div class="alert alert-danger small">
                                @foreach ($errors->all() as $error)
                                - {{ $error }}<br />
                                @endforeach
                            </div>
                        </div>
                        @endif
                        @yield('content')
                    </main>
                </div>
            </div>
        </div>

        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <script src="{{ asset('js/custom.js') }}" defer></script>

        <!-- Summernote WYSIWYG -->        
        <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote.css" rel="stylesheet">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote.js"></script>
        <script src="{{ asset('js/cms/custom.js') }}" defer></script>
    </body>
</html>
