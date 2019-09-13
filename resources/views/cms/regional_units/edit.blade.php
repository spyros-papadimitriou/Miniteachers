@extends('layouts.cms')
@section('content')
<h3><img height="32" src="{{ asset('svg/cms/map.svg') }}" alt=""  /> Περιφερειακές Ενότητες</h3>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('cms.regions.index') }}">Περιφέρειες</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{ $region->name }}</li>
    </ol>
</nav>

<div class="row">
    <div class="col-md-12">
        <form method="post" action="{{ route('cms.regions.regional_units.update', ['region' =>$region->id, 'regional_unit'=>$regionalUnit->id]) }}">
            @csrf
            @method('put')
            <div class="form-group row">
                <label for="name" class="col-sm-2 col-form-label">Όνομα:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control form-control-sm" id="name" name="name" value="{{ $regionalUnit->name }}">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-6">
                    <button type="submit" class="btn btn-primary btn-sm">Αποθήκευση</button>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="{{ route('cms.regions.regional_units.index', ['region'=>$region->id]) }}" class="btn btn-danger btn-sm">Άκυρο</a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection