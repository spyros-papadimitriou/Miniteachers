@extends('layouts.profile')

@section('profile-content')
<div class="row">
    <div class="col-md-9">
        <h5>Επιπλέον πληροφορίες</h5>
    </div>
    <div class="col-md-3 text-right">
        <a class="btn btn-sm btn-success" href='{{ route('profile.extra.create') }}'>Προσθήκη</a>
    </div>
</div>
<hr />

<div class="row">
    <div class="col-md-6">
        @if(session()->has('message'))
        <div class="alert alert-success small">{{ session()->get('message') }}</div>
        @endif

        @if (count($user->extras) > 0)
        @foreach($user->extras as $extra)

        <small>{{ $loop->iteration }}.</small><br />
        <small>Τίτλος</small>: {{ $extra->description }}<br />
        <small>Περιγραφή</small>: {{ $extra->pivot->content }}

        <form action="{{ route('profile.extra.destroy', ['extra'=>$extra->id]) }}" method="post">
            @csrf
            @method('delete')
            <div class="text-right">
                <a class="btn btn-sm btn-outline-info" href="{{ route('profile.extra.edit', ['extra' => $extra->id]) }}">Επεξεργασία</a>
                <button type="submit" class="btn btn-sm btn-outline-danger">Διαγραφή</button>
            </div>
            <hr />
        </form>
        @endforeach
        @else
        <p>Δεν υπάρχουν εγγραφές.</p>
        @endif
    </div>

    <div class='col-md-3 offset-lg-3 mt-3'>
        @tip(profile-edit-extra)
    </div>
</div>
@endsection
