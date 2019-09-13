@extends('layouts.profile')

@section('profile-content')

<div class="row">
    <div class="col-md-12">
        <h5>Προσθήκη / Επεξεργασία δήμων</h5>
    </div>
</div>
<hr />

<div class="row">
    <div class="col-md-12">

        <form method="post" action="{{ route('profile.municipalities.store') }}">
            @csrf
            @method('post')
            @foreach ($regions as $region)
            <div class="mb-3">
                <small>{{ $loop->iteration }}.</small>
                <a data-toggle="collapse" href="#region{{ $region->id }}" role="button" aria-expanded="false" aria-controls="region{{ $region->id }}">{{ $region->name }}</a>
                <div class="collapse" id="region{{ $region->id }}">
                    @foreach ($region->regionalUnits as $regionalUnit)
                    @if ($loop->iteration % 4 == 1)
                    <div class="card-group mt-3">
                        @endif
                        <div class="card small">
                            <div class="card-header">
                                <small>{{ $loop->iteration }}.</small> {{ $regionalUnit->name }}
                            </div>
                            <div class="card-body">
                                <div>
                                    @foreach ($regionalUnit->municipalities as $municipality)
                                    <div class="custom-control custom-checkbox" id="regionalUnit{{ $regionalUnit->id }}">
                                        <input type="checkbox" class="custom-control-input" value="{{ $municipality->id }}" id="municipality{{ $municipality->id }}" name="municipalities[]"{{ $user->municipalities->contains($municipality) ? ' checked': null }}>
                                        <label class="custom-control-label" for="municipality{{ $municipality->id }}">{{ $municipality->name }}</label>
                                    </div>                        
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        @if ($loop->iteration % 4 == 0 || $loop->last)
                    </div>
                    @endif
                    @endforeach
                </div>
            </div>
            @endforeach

            <button class="btn btn-primary btn-sm" type="submit">Αποθήκευση</button>
            <a class="btn btn-danger btn-sm" href="{{ route('profile.municipalities.index') }}">Άκυρο</a>
        </form>
    </div>
</div>
@endsection
