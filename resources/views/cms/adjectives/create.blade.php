@extends('layouts.cms')
@section('content')
<h3><img height="32" src="{{ asset('svg/cms/adjective.svg') }}" alt=""  /> Στοιχεία χαρακτήρα</h3>
<p><a href="{{ route('cms.adjectives.index') }}">Πίσω στα στοιχεία χαρακτήρα</a></p>

<div class="row">
    <div class="col-md-12">
        <form method="post" action="{{ route('cms.adjectives.store') }}">
            @csrf
            <div class="form-group row">
                <label for="name_male" class="col-sm-2 col-form-label">Όνομα (άνδρας):</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control form-control-sm" id="name_male" name="name_male">
                </div>
            </div>
            <div class="form-group row">
                <label for="name_female" class="col-sm-2 col-form-label">Όνομα (γυναίκα):</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control form-control-sm" id="name_female" name="name_female">
                </div>
            </div>
            <div class="form-group row">
                <label for="description_male" class="col-sm-2 col-form-label">Περιγραφή (άνδρας):</label>
                <div class="col-sm-10">
                    <textarea class="form-control" id="description_male" name="description_male" rows="2"></textarea>
                </div>
            </div>
            <div class="form-group row">
                <label for="description_female" class="col-sm-2 col-form-label">Περιγραφή (γυναίκα):</label>
                <div class="col-sm-10">
                    <textarea class="form-control" id="description_female" name="description_female" rows="2"></textarea>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-6">
                    <button type="submit" class="btn btn-primary btn-sm">Αποθήκευση</button>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="{{ route('cms.adjectives.index') }}" class="btn btn-danger btn-sm">Άκυρο</a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection