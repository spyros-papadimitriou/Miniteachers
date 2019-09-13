@extends('layouts.profile')

@section('profile-content')
<div class="row">
    <div class="col-md-12">
        <h5>Προσθήκη ιστοσελίδας</h5>
    </div>
</div>
<hr />

<div class="row">
    <div class="col-md-6">

        <form action="{{ route('profile.websites.store') }}" method="post">
            @csrf
            @method('post')

            <div class="form-group">
                <label for="website">Ιστοσελίδα</label>
                <select class="form-control" id="website" name="website" required>
                    @foreach ($websites as $website)
                    <option value="{{ $website->id }}">{{ $website->name }} ({{ $website->url_pattern }})</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="value">Τιμή</label>
                <input type="text" class="form-control" id="value" name="value" required>
                <small class="text-muted">
                    Το πεδίο 'τιμή' αντικαθιστά τη μεταβλητή [value] που εμπεριέχεται στη μορφή συνδέσμου.<br />
                    Σε περίπτωση που υπάρχει εγγραφή για την ιστοσελίδα που θα επιλέξετε, θα γίνει διαγραφή της προηγούμενης.
                </small>
            </div>

            <button type="submit" class="btn btn-primary btn-sm">Αποθήκευση</button>
            <a class="btn btn-danger btn-sm" href="{{ route('profile.websites.index') }}">Άκυρο</a>
        </form>
    </div>

    <div class='col-md-3 offset-lg-3 mt-3'>
        <div class="card bg-light">
            <div class="card-header">
                <img src='{{ asset('svg/info.svg') }}' height="24" alt=''> Tip
            </div>
            <div class="card-body">
                <blockquote class="mb-0">
                    <p>Θυμηθείτε ότι συμπληρώνετε μόνο την τιμή που θα αντικαταστήσει τη μεταβλητή [value] και όχι όλο το σύνδεσμο (εκτός αν απαιτείται).</p>
                    <p>
                        Για παράδειγμα, στην περίπτωση του facebook, αν ο σύνδεσμος του προφίλ είναι <code>https://www.facebook.com/puma0</code>, συμπληρώνετε μόνο το <code>puma0</code>.
                    </p>
                    <footer class="blockquote-footer">Μαρία</footer>
                </blockquote>
            </div>
        </div>
        <div class="text-center mt-3">
            <img src='{{ asset('svg/tips/11.svg') }}' height="300" alt=''>
        </div>
    </div>
</div>
@endsection
