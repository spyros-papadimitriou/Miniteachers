@extends('layouts.cms')
@section('content')
<h3><img height="32" src="{{ asset('svg/cms/university.svg') }}" alt=""  /> Σχολές</h3>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('cms.institutions.index') }}">Εκπαιδευτικά Ιδρύματα</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{ $institution->name }}</li>
    </ol>
</nav>

<div class="row">
    <div class="col-md-12">
        <form method="post" action="{{ route('cms.institutions.schools.update', ['institution' =>$institution->id, 'school'=>$school->id]) }}">
            @csrf
            @method('put')
            <div class="form-group row">
                <label for="name" class="col-sm-2 col-form-label">Όνομα:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control form-control-sm" id="name" name="name" value="{{ $school->name }}">
                </div>
            </div>
            <div class="form-group row">
                <label for="url" class="col-sm-2 col-form-label">Σύνδεσμος:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control form-control-sm" id="url" name="url" value="{{ $school->url }}">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-6">
                    <button type="submit" class="btn btn-primary btn-sm">Αποθήκευση</button>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="{{ route('cms.institutions.schools.index', ['institution'=>$institution->id]) }}" class="btn btn-danger btn-sm">Άκυρο</a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection