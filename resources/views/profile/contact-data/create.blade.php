@extends('layouts.profile')

@section('profile-content')
<div class="row">
    <div class="col-md-12">
        <h5>Προσθήκη στοιχείων επικοινωνίας</h5>
    </div>
</div>
<hr />

<div class="row">
    <div class="col-md-6">
        @if(session()->has('message'))
        <div class="alert alert-success mt-5">{{ session()->get('message') }}</div>
        @endif

        <form action="{{ route('profile.contact-data.store') }}" method="post">
            @csrf
            @method('post')

            <div class="form-group">
                <label for="contactDataType">Τρόπος επικοινωνίας</label>
                <select class="form-control form-control-sm" id="contactDataType" name="contactDataType" required>
                    @foreach ($contactDataTypes as $contactDataType)
                    <option value="{{ $contactDataType->id }}">{{ $contactDataType->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="value">Τιμή</label>
                <input  type="text" class="form-control" id="value" name="value">        
            </div>

            <button type="submit" class="btn btn-primary btn-sm">Αποθήκευση</button>
            <a class="btn btn-danger btn-sm" href="{{ route('profile.contact-data.index') }}">Άκυρο</a>
        </form>
    </div>
</div>
@endsection
