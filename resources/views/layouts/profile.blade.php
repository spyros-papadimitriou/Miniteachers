@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mb-3">
        <div class="col-md-6 text-sm-center text-md-left">
            <h5><img src='{{ asset('svg/usertypes/edit-profile-'.$user->userType->id.'-'.$user->gender->id.'.svg') }}' height="32" alt=''> Επεξεργασία προφίλ</h5>
        </div>
        <div class="col-md-6 text-md-right text-sm-center">
            <a class="btn btn-sm btn-outline-primary" href="{{ route('profile-show') }}"><img height="16" src="{{ asset('svg/usertypes/avatar-'.$user->userType->id.'-'.$user->gender->id.'.svg') }}" alt=""> Προβολή προφίλ</a>      
        </div>
    </div>

    <div class="card">
        <div class="card-header">            
            <ul class="nav nav-pills nav-fill card-header-pills">
                <li class="nav-item">
                    <a class="nav-link{{ $menu == 'basic-info' ? ' active': null }}" href="{{ route('profile.basic-info.edit', ['user' => $user->id]) }}"><img height="24" src="{{ asset('svg/info.svg') }}" alt=""> Βασικές πληροφορίες</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link{{ $menu == 'extras' ? ' active': null }}" href="{{ route('profile.extra.index') }}"><img height="24" src="{{ asset('svg/extra.svg') }}" alt=""> Επιπλέον πληροφορίες</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link{{ $menu == 'courses' ? ' active': null }}" href="{{ route('profile.courses.index') }}"><img height="24" src="{{ asset('svg/book.svg') }}" alt=""> Μαθήματα</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link{{ $menu == 'target-groups' ? ' active': null }}" href="{{ route('profile.target-groups.index') }}"><img height="24" src="{{ asset('svg/target-group.svg') }}" alt=""> Κατηγορίες μαθητών</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link{{ $menu == 'services' ? ' active': null }}" href="{{ route('profile.services.index') }}"><img height="24" src="{{ asset('svg/services.svg') }}" alt=""> Υπηρεσίες</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link{{ $menu == 'departments' ? ' active': null }}" href="{{ route('profile.departments.index') }}"><img height="24" src="{{ asset('svg/bachelor.svg') }}" alt=""> Προπτυχιακές σπουδές</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link{{ $menu == 'postgraduates' ? ' active': null }}" href="{{ route('profile.postgraduates.index') }}"><img height="24" src="{{ asset('svg/certificate.svg') }}" alt=""> Μεταπτυχιακές σπουδές</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link{{ $menu == 'phds' ? ' active': null }}" href="{{ route('profile.phds.index') }}"><img height="24" src="{{ asset('svg/philosopher.svg') }}" alt="">Διδακτορικές σπουδές</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link{{ $menu == 'municipalities' ? ' active': null }}" href="{{ route('profile.municipalities.index') }}"><img height="24" src="{{ asset('svg/municipality.svg') }}" alt=""> Δήμοι</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link{{ $menu == 'contact-data' ? ' active': null }}" href="{{ route('profile.contact-data.index') }}"><img height="24" src="{{ asset('svg/contact-info.svg') }}" alt=""> Στοιχεία επικοινωνίας</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link{{ $menu == 'adjectives' ? ' active': null }}" href="{{ route('profile.adjectives.index') }}"><img height="24" src="{{ asset('svg/adjective.svg') }}" alt=""> Στοιχεία χαρακτήρα</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link{{ $menu == 'websites' ? ' active': null }}" href="{{ route('profile.websites.index') }}"><img height="24" src="{{ asset('svg/earth.svg') }}" alt=""> Ιστοσελίδες</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link{{ $menu == 'favourites' ? ' active': null }}" href="{{ route('profile.favourites.index') }}"><img height="24" src="{{ asset('svg/favourite.svg') }}" alt=""> Λίστα αγαπημένων</a>
                </li>
            </ul>

        </div>
        <div class="card-body">
            @if ($errors->any())
            <div class="col-md-6">                 
                <div class="alert alert-danger small">
                    @foreach ($errors->all() as $error)
                    - {{ $error }}<br />
                    @endforeach
                </div>
            </div>
            @endif
            @yield('profile-content')
        </div>
    </div>
</div>
@endsection

