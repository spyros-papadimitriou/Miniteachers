@extends('layouts.profile')

@section('profile-content')
<div class="row">
    <div class="col-md-9">
        <h5>Στοιχεία χαρακτήρα</h5>
    </div>
    <div class="col-md-3 text-right">
        <a class="btn btn-sm btn-success" href='{{ route('profile.adjectives.create') }}'>Προσθήκη - επεξεργασία</a>
    </div>
</div>
<hr />

<div class="row">
    <div class="col-md-9">
        @if(session()->has('message'))
        <div class="alert alert-success small">{{ session()->get('message') }}</div>
        @endif

        @forelse ($user->adjectives as $adjective)
        @if ($loop->iteration % 3 == 1)
        <div class="card-deck mb-3">
            @endif

            <div class="card">
                <div class="card-header text-center">
                    <span class="btn btn-sm btn-info">{{ $user->id_gender == \App\Gender::MALE ? $adjective->name_male: $adjective->name_female }}</span>
                </div>
                <div class="card-body text-center">
                    <p class="card-text">
                        {{ $user->id_gender == \App\Gender::MALE ? $adjective->description_male: $adjective->description_female }}
                    </p>
                </div>
                <div class="card-footer">
                    <small class="text-muted">Προστέθηκε: {{ $adjective->pivot->created_at }}</small>
                </div>
            </div>

            @if ($loop->iteration % 3 == 0 || $loop->last)
        </div>
        @endif
        @empty
        <p>Δεν υπάρχουν εγγραφές.</p>
        @endforelse
    </div>

    <div class='col-md-3'>
        @tip(adjectives-index)
    </div>
</div>
@endsection
