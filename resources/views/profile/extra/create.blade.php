@extends('layouts.profile')

@section('profile-content')

<div class="row">
    <div class="col-md-12">
        <h5>Προσθήκη επιπλέον πληροφορίας</h5>
    </div>
</div>
<hr />

<div class="row">
    <div class="col-md-6">
        <form action="{{ route('profile.extra.store') }}" method="post">
            @csrf
            @method('post')

            <div class="form-group">
                <label for="extra">Επιλογή</label>
                <select class="form-control" id=extra" name="extra">
                    @foreach ($extras as $extra)
                    <option value="{{ $extra->id }}">{{ $extra->description }}{{ $user->extras->contains($extra) ? ' (έχετε προσθέσει ήδη κείμενο)': null }}</option>
                    @endforeach
                </select>
                <small class="text-muted">Αν έχετε προσθέσει ήδη κείμενο σε κάποια επιλογή, το κείμενο θα ενημερωθεί.</small> 
            </div>
            <div class="form-group">
                <label for="content">Περιγραφή</label>
                <textarea class="form-control" id="content" name="content" rows="3" required maxlength="1024"></textarea>        
                <small class="text-muted">Μέγιστος αριθμός χαρακτήρων: 1024</small>
            </div>

            <button type="submit" class="btn btn-primary btn-sm">Αποθήκευση</button>
            <a class="btn btn-danger btn-sm" href="{{ route('profile.extra.index') }}">Άκυρο</a>
        </form>
    </div>

    <div class='col-md-3 offset-lg-3 mt-3'>
        <div class="card bg-light">
            <div class="card-header">
                <img src='{{ asset('svg/info.svg') }}' height="24" alt=''> Tip
            </div>
            <div class="card-body">
                <blockquote class="mb-0">
                    <p>Στη λίστα με τις επιλογές, οπουδήποτε υπάρχει η φράση 'έχετε προσθέσει ήδη κείμενο', σημαίνει ότι έχετε κάνει ήδη καταχώριση.</p>
                    <p>Σε περίπτωση που διαλέξετε μία τέτοια επιλογή και πατήσετε 'Αποθήκευση', το κείμενο θα ενημερωθεί.</p>
                    <footer class="blockquote-footer">Δημήτρης</footer>
                </blockquote>
            </div>
        </div>
        <div class="text-center mt-3">
            <img src='{{ asset('svg/tips/2.svg') }}' height="300" alt=''>
        </div>
    </div>
</div>
@endsection
