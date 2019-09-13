@extends('layouts.cms')
@section('content')
<h3><img height="32" src="{{ asset('svg/cms/phone.svg') }}" alt=""  /> Είδη Στοιχείων Επικοινωνίας</h3>
<p><a href="{{ route('cms.contact_data_types.index') }}">Πίσω στα είδη στοιχείων επικοινωνίας</a></p>

<div class="row">
    <div class="col-md-12">
        <form method="post"  action="{{ route('cms.contact_data_types.update', ['id'=>$contact_data_type->id]) }}">
            @csrf
            @method('put')
            <div class="form-group row">
                <label for="name" class="col-sm-2 col-form-label">Όνομα:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control form-control-sm" id="name" name="name" value="{{ $contact_data_type->name }}">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-6">
                    <button type="submit" class="btn btn-primary btn-sm">Αποθήκευση</button>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="{{ route('cms.contact_data_types.index') }}" class="btn btn-danger btn-sm">Άκυρο</a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection