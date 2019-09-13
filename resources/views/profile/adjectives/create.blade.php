@extends('layouts.profile')

@section('profile-content')

<div class="row">
    <div class="col-md-12">
        <h5>Προσθήκη στοιχείου χαρακτήρα</h5>
    </div>
</div>
<hr />

<div class="row">
    <div class="col-md-9">
        <form action="{{ route('profile.adjectives.store') }}" method="post">
            @csrf
            @foreach ($adjectives as $adjective)
            @if ($loop->iteration % 3 == 1)
            <div class="row mb-3">
                @endif
                <div class="col-md-4">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="adjectives[]" id="adjective{{ $adjective->id }}" value="{{ $adjective->id }}"{{ $user->adjectives->contains($adjective) ? ' checked': null}}>
                        <label class="form-check-label" for="adjective{{ $adjective->id }}">{{ $user->id_gender == \App\Gender::MALE ? $adjective->name_male: $adjective->name_female }}</label>
                    </div>
                    <br /><span class="small text-muted">{{ $user->id_gender == \App\Gender::MALE ? $adjective->description_male: $adjective->description_female }}</span>
                </div>
                @if ($loop->iteration % 3 == 0 || $loop->last)
            </div>
            <hr />
            @endif
            @endforeach
            <div class="row">
                <div class="col-md-12">
                    <button class="btn btn-primary btn-sm" type="submit">Αποθήκευση</button>
                    <a class="btn btn-danger btn-sm" href="{{ route('profile.adjectives.index') }}">Άκυρο</a>                        
                </div>
            </div>

        </form>
    </div> 


    <div class='col-md-3 mt-3'>                    
        @tip(adjectives-create)
    </div>
</div>
@endsection
