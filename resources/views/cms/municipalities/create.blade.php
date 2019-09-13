@extends('layouts.cms')
@section('content')
<h3><img height="32" src="{{ asset('svg/cms/map.svg') }}" alt=""  /> Δήμοι</h3>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('cms.regions.index') }}">Περιφέρειες</a></li>
        <li class="breadcrumb-item"><a href="{{ route('cms.regions.regional_units.index', ['region'=>$region->id]) }}">{{ $region->name }}</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{ $regionalUnit->name }}</li>
    </ol>
</nav>

<div class="row">
    <div class="col-md-12">
        <form method="post" action="{{ route('cms.regional_units.municipalities.store', ['regional_unit'=>$regionalUnit->id]) }}">
            @csrf
            <div class="form-group row">
                <label for="name" class="col-sm-2 col-form-label">Όνομα:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control form-control-sm" id="name" name="name">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-6">
                    <button type="submit" class="btn btn-primary btn-sm">Αποθήκευση</button>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="{{ route('cms.regional_units.municipalities.index', ['regional_unit'=>$regionalUnit->id]) }}" class="btn btn-danger btn-sm">Άκυρο</a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection