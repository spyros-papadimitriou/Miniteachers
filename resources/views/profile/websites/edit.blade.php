@extends('layouts.profile')

@section('profile-content')
<div class="row">
    <div class="col-md-12">
        <h5>Επεξεργασία ιστοσελίδας</h5>
    </div>
</div>
<hr />

<div class="row">
    <div class="col-md-6">

        <form action="{{ route('profile.websites.update', ['website'=>$website->id]) }}" method="post">
            @csrf
            @method('put')

            <small>Ιστοσελίδα</small>: {{ $website->name }}<br />
            <small>Μορφή συνδέσμου</small>: {{ $website->url_pattern }}
            <div class="form-group">
                <label for="value">Τιμή</label>
                <input type="text" class="form-control" id="value" name="value" required value='{{ $website->pivot->value }}'>
                <small class="text-muted">
                    Το πεδίο 'τιμή' αντικαθιστά τη μεταβλητή [value] που εμπεριέχεται στη μορφή συνδέσμου.
                </small>
            </div>

            <button type="submit" class="btn btn-primary btn-sm">Αποθήκευση</button>
            <a class="btn btn-danger btn-sm" href="{{ route('profile.websites.index') }}">Άκυρο</a>
        </form>
    </div>
</div>
@endsection
