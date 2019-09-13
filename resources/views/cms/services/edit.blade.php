@extends('layouts.cms')
@section('content')
<h3><img height="32" src="{{ asset('svg/cms/service.svg') }}" alt=""  /> Υπηρεσίες</h3>
<p><a href="{{ route('cms.services.index') }}">Πίσω στις υπηρεσίες</a></p>

<div class="row">
    <div class="col-md-12">
        <form method="post" action="{{ route('cms.services.update', ['id'=>$service->id]) }}" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="form-group row">
                <label for="name" class="col-sm-2 col-form-label">Όνομα:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control form-control-sm" id="name" name="name" value="{{ $service->name }}">
                </div>
            </div>
            <div class="form-group">
                <label for="picture">Εικόνα (μόνο SVG)</label>
                <input type="file" class="form-control-file" id="picture" name="picture">
            </div>
            @if ($service->picture)
            <div class="form-group">
                <img src="{{ $service->picture }}" width="64" alt="">
            </div>
            @endif
            <div class="form-group row">
                <div class="col-sm-6">
                    <button type="submit" class="btn btn-primary btn-sm">Αποθήκευση</button>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="{{ route('cms.services.index') }}" class="btn btn-danger btn-sm">Άκυρο</a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection