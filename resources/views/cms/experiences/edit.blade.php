@extends('layouts.cms')
@section('content')
<h3><img height="32" src="{{ asset('svg/cms/experience.svg') }}" alt=""  /> Εμπειρία</h3>
<p><a href="{{ route('cms.experiences.index') }}">Πίσω στις εμπειρίες</a></p>

<div class="row">
    <div class="col-md-12">
        <form method="post"  action="{{ route('cms.experiences.update', ['id'=>$experience->id]) }}">
            @csrf
            @method('put')
            <div class="form-group row">
                <label for="name" class="col-sm-2 col-form-label">Όνομα:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control form-control-sm" id="name" name="name" value="{{ $experience->name }}">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-6">
                    <button type="submit" class="btn btn-primary btn-sm">Αποθήκευση</button>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="{{ route('cms.experiences.index') }}" class="btn btn-danger btn-sm">Άκυρο</a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection