@extends('layouts.app')

@section('content')
<div class="container">    
    <div class="row">
        <div class="col-md-12">
            <h5><img src="{{ asset('svg/home.svg') }}" height="32" alt=""> {{ $page->title }}</h5>
            <hr />
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-9 mb-3 text-justify">
            {!! html_entity_decode($page->content) !!}

            @if (count($announcements))
            <h6><img height="32" src="{{ asset('svg/megaphone.svg') }}" alt=""> Τελευταίες ανακοινώσεις</h6>
            <hr />
            @foreach ($announcements as $announcement)
            <div class="row mb-3">
                <div class="col-md-1 text-center">
                    <span class="badge badge-primary">{{ $loop->iteration }}</span>
                </div>
                <div class="col-md-11">
                    {{ $announcement->created_at  }}<br />
                    <span class="font-weight-bold">{{ $announcement->title }}</span><br />
                    {{ $announcement->content }}
                </div>
            </div>
            @endforeach
            <div class="row mb-3">
                <div class="col-md-12 text-md-right text-sm-center">
                    <a class="btn btn-sm btn-outline-primary" href="{{ route('announcements') }}">Όλες οι ανακοινώσεις</a>
                </div>
            </div>
            @endif     
           
        </div>

        <div class="col-md-3">
            <div class="card">
                <div class="card-header">
                    <img height="24" src="{{ asset('svg/'.$usersTitleImage.'.svg') }}"> {!! $usersTitle !!}
                </div>

                @if (count($users) > 0)
                @foreach($users as $user)
                <div class="card-body small">
                    @if ($user->picture)
                    <a href="{{ route('profile-slug-show', ['user'=>$user->id, 'slug'=>str_slug($user->name)]) }}"><img class="card-img-top" src="{{ asset('uploads/users/'.$user->picture) }}" alt="" title="{{ $user->name }}"></a>
                    @else
                    <a href="{{ route('profile-slug-show', ['user'=>$user->id, 'slug'=>str_slug($user->name)]) }}"><img width="100%" class="card-img-top" src="{{ route('svg-user', ['user' => $user->id]) }}" alt="" title="{{ $user->name }}"></a>
                    @endif
                    <br /><br />
                    Όνομα: <a href="{{ route('profile-slug-show', ['user'=>$user->id, 'slug'=>str_slug($user->name)]) }}">{{ $user->name }}</a><br />
                    Επίπεδο: <span class="badge badge-primary">{{ $user->gender->id == 1 ? $user->userStat->level->name_male: $user->userStat->level->name_female }}</span><br />
                    Minipoints: <span class="badge badge-primary">{{ $user->userStat->points }}</span><br />
                    Τιμή ανά ώρα: {!! $user->userStat->price_per_hour > 0 ? $user->userStat->price_per_hour. ' &euro;': 'Συζητήσιμη' !!}<br />
                    Εμπειρία: {{ $user->userStat->experience->name }}<br />
                    @if (count($user->courses) > 0)
                    Μαθήματα:
                    @foreach ($user->courses as $userCourse)
                    @if (!$loop->last)
                    {{ $userCourse->name }},                                  
                    @else
                    {{ $userCourse->name }}
                    @endif
                    @endforeach
                    @endif
                </div>
                @endforeach
                @else
                <div class="card-body">
                    <blockquote class="mb-3">
                        <p class="small">Δε βρέθηκε κάποιος χρήστης!</p>
                        <p class="small">Μπορείτε να κοινοποιήσετε την πλατφόρμα στα μέσα κοινωνικής δικτύωσης σε περίπτωση που κάποιος εκπαιδευτικός ενδιαφέρεται να γίνει miniteacher ή κάποιος αναζητεί εκπαιδευτικό για ιδιαίτερα και επιθυμεί να γίνει miniguest!</p>
                        <footer class="blockquote-footer">Ελένη</footer>
                    </blockquote>

                    <p class="text-center">
                        <a class="btn btn-sm btn-primary" target="_blank" href='https://www.facebook.com/sharer/sharer.php?u={{ url()->current() }}&display=popup'>Κοινοποίηση στο Facebook</a>
                    </p>

                    <div class="text-center mt-3">
                        <img src='{{ asset('svg/tips/9.svg') }}' height="300" alt=''>
                    </div>
                </div>        
                @endif

            </div>
        </div>
    </div>

</div>
@endsection
