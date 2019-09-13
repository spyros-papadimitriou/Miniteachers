@extends('layouts.profile')

@section('profile-content')
<div class="row">
    <div class="col-md-9">
        <h5>Διδακτορικές σπουδές</h5>
    </div>
    <div class="col-md-3 text-right">
        @if (count($user->phds) < 2)
        <a class="btn btn-sm btn-success" href='{{ route('profile.phds.create') }}'>Προσθήκη</a>
        @endif
    </div>
</div>
<hr />

<div class="row">
    <div class="col-md-6">
        @if(session()->has('message'))
        <div class="alert alert-success small">{{ session()->get('message') }}</div>
        @endif

        @if (count($user->phds) > 0)
        @foreach ($user->phds as $phd)
        <div>
            <small>{{ $loop->iteration }}.</small><br />
            <small>Θέμα διδακτορικής διατριβής</small>:  {{ $phd->name }}<br />
            <small>Έτος αποφοίτησης</small>:  {{ $phd->endyear }}
            <form action="{{ route('profile.phds.destroy', ['phd'=>$phd->id]) }}" method="post">
                @csrf
                @method('delete')
                <div class="text-right">
                    <a class="btn btn-sm btn-outline-info" href="{{ route('profile.phds.edit', ['phd' => $phd->id]) }}">Επεξεργασία</a>
                    <button type="submit" class="btn btn-sm btn-outline-danger">Διαγραφή</button>
                </div>
                <hr />
            </form>
        </div>
        @endforeach
        @else
        <p>Δεν υπάρχουν εγγραφές.</p>
        @endif
    </div>

    <div class='col-md-3 offset-lg-3 mt-3'>
        @miniteacher
        @tip(profile-edit-phds-miniteacher)
        @endminiteacher
        @miniguest
        @tip(profile-edit-phds-miniguest)
        @endminiguest
    </div>
</div>
@endsection
