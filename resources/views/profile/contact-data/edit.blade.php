@extends('layouts.profile')

@section('profile-content')
<div class="row">
    <div class="col-md-12">
        <h5>Επεξεργασία στοιχείων επικοινωνίας</h5>
    </div>
</div>
<hr />

<div class="row">
    <div class="col-md-6">

        <form action="{{ route('profile.contact-data.update', ['contact-data'=>$contactData->id]) }}" method="post">
            @csrf
            @method('put')

            <small>Τρόπος επικοινωνίας</small>: {{ $contactData->contactDataType->name }}
            <div class="form-group">
                <label for="value">Τιμή</label>
                <input  type="text" class="form-control" id="value" name="value" value="{{ $contactData->value }}">        
            </div>

            <button type="submit" class="btn btn-primary btn-sm">Αποθήκευση</button>
            <a class="btn btn-danger btn-sm" href="{{ route('profile.contact-data.index') }}">Άκυρο</a>
        </form>
    </div>
</div>
@endsection
