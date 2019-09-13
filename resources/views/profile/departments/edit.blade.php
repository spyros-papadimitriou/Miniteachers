@extends('layouts.profile')

@section('profile-content')

<div class="row">
    <div class="col-md-12">
        <h5>Επεξεργασία προπτυχιακών σπουδών</h5>
    </div>
</div>
<hr />

<div class="row">
    <div class="col-md-6">

        <form action="{{ route('profile.departments.update', ['department'=>$department->id]) }}" method="post">
            @csrf
            @method('put')

            <div class="form-group">
                <small>Τμήμα/Τομέας</small>: {{ $department->name }}<br />
                <small>Σχολή</small>: {{ $department->school->name }}<br />
                <small>Εκπαιδευτικό Ίδρυμα</small>: {{ $department->school->institution->name }}
            </div>
            <div class="form-group">
                <label for="endyear">Έτος αποφοίτησης</label>
                <input size="4" maxlength="4" type="number" class="form-control" id="endyear" name="endyear" value="{{ $department->pivot->endyear }}">
                <small class="text-muted">
                    @miniteacher
                    Στην περίπτωση που δεν έχετε τελειώσει ακόμα, αφήστε το πεδίο κενό.
                    @endminiteacher
                    @miniguest
                    Είναι το νωρίτερο επιθυμητό έτος αποφοίτησης που θέλετε να διαθέτει ένας miniteacher (π.χ. να έχει τελειώσει από το 2015 και μετά).
                    @endminiguest
                </small>
            </div>

            <button type="submit" class="btn btn-primary btn-sm">Αποθήκευση</button>
            <a class="btn btn-danger btn-sm" href="{{ route('profile.departments.index') }}">Άκυρο</a>
        </form>
    </div>
</div>
@endsection
