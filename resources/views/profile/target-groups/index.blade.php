@extends('layouts.profile')

@section('profile-content')
<div class="row">
    <div class="col-md-9">
        <h5>
            Κατηγορίες μαθητών
        </h5>
    </div>
    <div class="col-md-3 text-right">
        <a class="btn btn-sm btn-success" href='{{ route('profile.target-groups.create') }}'>Προσθήκη - Επεξεργασία</a>
    </div>
</div>
<hr />

<div class="row">
    <div class="col-md-6">
        @if(session()->has('message'))
        <div class="alert alert-success small">{{ session()->get('message') }}</div>
        @endif

        @if (count($user->targetGroups) > 0)
        @foreach ($user->targetGroups as $targetGroup)
        <div>
            <small>{{ $loop->iteration }}. Στόχος - Ομάδα</small><br />
            {{ $targetGroup->name }}<br />
            <form action="{{ route('profile.target-groups.destroy', ['target-group'=>$targetGroup->id]) }}" method="post">
                @csrf
                @method('delete')
                <div class="text-right">
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
        @tip(profile-edit-target-groups-miniteacher);
        @endminiteacher
        @miniguest
        @tip(profile-edit-target-groups-miniguest);
        @endminiguest
    </div>
</div>
@endsection
