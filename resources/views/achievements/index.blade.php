@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h5><img src='{{ asset('svg/trophy.svg') }}' height="32" alt=''> Επιτεύγματα</h5>
            <hr />
        </div>
    </div>

    <div class="row">
        <div class="col-md-9">
            <div class="row font-weight-bold">
                <div class="col-md-2">&nbsp;</div>
                <div class="col-md-6">Τύπος επιτεύγματος</div>
                <div class="col-md-2">Τιμές</div>
                <div class="col-md-2">Τρέχουσα τιμή</div>
            </div>
            <hr />
            @foreach ($achievementTypes as $achievementType)
            <div class="row">
                <div class="col-md-2 text-center">
                    <img height="64" src="{{ asset($achievementType->picture) }}" alt="{{ $achievementType->name }}">
                </div>
                <div class="col-md-6">
                    {{ $achievementType->name }}
                </div>

                <div class="col-md-2">
                    @foreach ($achievementType->achievements as $achievement)

                    @if (Auth::user()->achievements->contains($achievement))
                    <span data-toggle="tooltip" data-placement="top" title="Δίνει {{ $achievement->points }} minipoints." class="badge badge-primary">{{ $achievement->value }}</span>
                    @else
                    <span data-toggle="tooltip" data-placement="top" title="Δίνει {{ $achievement->points }} minipoints." class="badge">{{ $achievement->value }}</span>
                    @endif
                    @endforeach
                </div>
                <div class="col-md-2 text-center">
                    {{ $achievementType->currentNum }}
                </div>
            </div>
            <hr />
            @endforeach
        </div>

        <div class='col-md-3'>
            @tip(achievements)
        </div>
    </div>
</div>
@endsection
