@extends('layouts.profile')

@section('profile-content')
<div class="row">
    <div class="col-md-9">
        <h5>Ιστοσελίδες</h5>
    </div>
    <div class="col-md-3 text-right">
        <a class="btn btn-sm btn-success" href='{{ route('profile.websites.create') }}'>Προσθήκη</a>
    </div>
</div>
<hr />

<div class="row">
    <div class="col-md-6">
        @if(session()->has('message'))
        <div class="alert alert-success small">{{ session()->get('message') }}</div>
        @endif

        @if (count($user->websites) > 0)
        @foreach ($user->websites as $website)
        @php($url = str_replace('[value]', $website->pivot->value, $website->url_pattern))
        <div>
            <small>{{ $loop->iteration }}.</small><br />
            <small>Ιστοσελίδα</small>:  {{ $website->name }}<br />
            <small>Σύνδεσμος</small>:  <a href='{{ $url }}' target="_blank">{{ $url }}</a>
            <form action="{{ route('profile.websites.destroy', ['website'=>$website->id]) }}" method="post">
                @csrf
                @method('delete')
                <div class="text-right">
                    <a class="btn btn-sm btn-outline-info" href="{{ route('profile.websites.edit', ['extra' => $website->id]) }}">Επεξεργασία</a>
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
        @tip(profile-edit-websites)
    </div>
</div>
@endsection
