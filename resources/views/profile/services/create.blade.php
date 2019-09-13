@extends('layouts.profile')

@section('profile-content')

<div class="row">
    <div class="col-md-12">
        <h5>Προσθήκη - Επεξεργασία υπηρεσιών</h5>
    </div>
</div>
<hr />

<div class="row">
    <div class="col-md-9">
        <form action="{{ route('profile.services.store') }}" method="post">
            @csrf
            @foreach ($services as $service)
            @if ($loop->iteration % 3 == 1)
            <div class="row mb-3">
                @endif
                <div class="col-md-4">
                    <div class="card small">
                        <label class="card-header text-center" style="cursor: pointer;" for="service{{ $service->id }}">
                            <b>{{ $service->name }}</b><br />
                            <img src="{{ $service->picture }}" height="48" alt="">
                        </label>

                        <div class="card-body text-center">                  
                            <input class="form-checkbox" type="checkbox" name="services[]" id="service{{ $service->id }}" value="{{ $service->id }}"{{ $user->services->contains($service) ? ' checked': null}}>
                        </div>
                    </div>
                </div>
                @if ($loop->iteration % 3 == 0 || $loop->last)
            </div>
            @endif    
            @endforeach
            <button class="btn btn-primary btn-sm" type="submit">Αποθήκευση</button>
            <a class="btn btn-danger btn-sm" href="{{ route('profile.services.index') }}">Άκυρο</a>
        </form>
    </div>

    <div class='col-md-3 mt-3'>
        @tip(services-create)
    </div>
</div>
@endsection
