@extends('layouts.cms')
@section('content')
<h3><img height="32" src="{{ asset('svg/cms/age-range.svg') }}" alt=""  /> Ηλικιακά φάσματα</h3>
<p><a href="{{ route('cms.age_ranges.index') }}">Πίσω στα ηλικιακά φάσματα</a></p>

<div class="row">
    <div class="col-md-12">
        <form method="post" action="{{ route('cms.age_ranges.update', ['id'=>$ageRange->id]) }}">
            @csrf
            @method('put')
            <div class="form-group row">
                <label for="name" class="col-sm-2 col-form-label">Ηλικία από:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control form-control-sm" id="age_from" name="age_from" value="{{ $ageRange->age_from }}">
                </div>
            </div>
            <div class="form-group row">
                <label for="name" class="col-sm-2 col-form-label">Ηλικία έως:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control form-control-sm" id="age_to" name="age_to" value="{{ $ageRange->age_to }}">
                </div>
            </div>
            <div class="form-group row">
                <label for="name" class="col-sm-2 col-form-label">Περιγραφή:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control form-control-sm" id="description" name="description" value="{{ $ageRange->description }}">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-6">
                    <button type="submit" class="btn btn-primary btn-sm">Αποθήκευση</button>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="{{ route('cms.age_ranges.index') }}" class="btn btn-danger btn-sm">Άκυρο</a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection