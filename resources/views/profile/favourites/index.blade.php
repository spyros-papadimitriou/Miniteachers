@extends('layouts.profile')

@section('profile-content')
<div class="row">
    <div class="col-md-12">
        <h5>Λίστα αγαπημένων</h5>
    </div>
</div>
<hr />

<div class="row">
    <div class="col-md-9">
        @if(session()->has('message'))
        <div class="alert alert-success small">{{ session()->get('message') }}</div>
        @endif

        @if (count($user->favourites) > 0)
        @foreach ($user->favourites as $favourite)
        <div>
            <small>{{ $loop->iteration }}.</small><br />
            <small>Τύπος χρήστη:</small> {{ $favourite->userType->name }}<br />
            <small>Όνομα</small>:  <a href='{{ route('profile-show', ['user'=>$favourite->id]) }}'>{{ $favourite->name }}</a><br />
            <small>{{ $favourite->userType->id == App\UserType::TEACHER ? 'Διδάσκει τα μαθήματα:': 'Ενδιαφέρεται για τα μαθήματα' }}</small>
            @foreach ($favourite->courses as $course)
            {{ !$loop->last ? $course->name.', ': $course->name }}
            @endforeach
            <br />
            <small>{{ $favourite->userType->id == App\UserType::TEACHER ? 'Απευθύνεται σε:': 'Κατηγορία μαθητή' }}</small>
            @forelse ($favourite->targetGroups as $targetGroup)
            {{ !$loop->last ? $targetGroup->name.', ': $targetGroup->name }}
            @empty
            -
            @endforelse            
            <br />
            <small>{{ $favourite->userType->id == App\UserType::TEACHER ? 'Παρέχει τις εξής υπηρεσίες:': 'Επιθυμεί τις εξής υπηρεσίες:' }}</small>
            @forelse ($favourite->services as $service)
            {{ !$loop->last ? $service->name.', ': $service->name }}
            @empty
            -
            @endforelse
            <br />

            @if (count($favourite->postgraduates) > 0)
            <small>{{ $favourite->userType->id == App\UserType::TEACHER ? 'Διαθέτει ': 'Επιθυμεί ' }} μεταπτυχιακό τίτλο.</small><br />
            @endif
            @if (count($favourite->phds) > 0)
            <small>{{ $favourite->userType->id == App\UserType::TEACHER ? 'Διαθέτει ': 'Επιθυμεί ' }} διδακτορικό τίτλο.</small><br />
            @endif


            <form class="mt-3" action="{{ route('profile.favourites.destroy', ['user'=>$favourite->id]) }}" method="post">
                @csrf
                @method('delete')
                <div class="text-right">
                    <button type="submit" class="btn btn-sm btn-outline-danger">Αφαίρεση από τη λίστα</button>
                </div>
                <hr />
            </form>
        </div>
        @endforeach
        @else
        <p>Δεν υπάρχουν εγγραφές.</p>
        @endif
    </div>
    <div class='col-md-3 mt-3'>
        @tip(profile-edit-favourites)
    </div>
</div>
@endsection
