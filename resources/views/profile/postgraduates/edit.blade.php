@extends('layouts.profile')

@section('profile-content')
<div class="row">
    <div class="col-md-12">
        <h5>Επεξεργασία μεταπτυχιακών σπουδών</h5>
    </div>
</div>
<hr />

<div class="row">
    <div class="col-md-6">
        @if(session()->has('message'))
        <div class="alert alert-success mt-5">{{ session()->get('message') }}</div>
        @endif

        <form action="{{ route('profile.postgraduates.update', ['postgraduate'=>$postgraduate->id]) }}" method="post">
            @csrf
            @method('put')

            <div class="form-group">
                <label for="name">Όνομα μεταπτυχιακού</label>
                <input type="text" class="form-control" id="name" name="name" required value="{{ $postgraduate->name }}">
            </div>
            <div class="form-group">
                <label for="endyear">Έτος αποφοίτησης</label>
                                                                                                                                               <input size="4" maxlength="4" type="number" class="form-control" id="endyear" name="endyear" value="{{ $postgraduate->endyear }}">
                <small class="text-muted">Στην περίπτωση που δεν έχετε τελειώσει ακόμα, αφήστε το πεδίο κενό.</small>
            </div>

        <button type="submit" class="btn btn-primary btn-sm">Αποθ            ήκευση</button>
        <a class="btn btn-danger btn-sm" href="{{ route('profile.postgraduates.index') }}">Άκυρο</a>
        </form>
    </div>
</div>
@endsection
