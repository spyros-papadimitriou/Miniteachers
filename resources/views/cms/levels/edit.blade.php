@extends('layouts.cms')
@section('content')
<h3><img height="32" src="{{ asset('svg/cms/levels.svg') }}" alt=""  /> Επίπεδα</h3>
<p><a href="{{ route('cms.levels.index') }}">Πίσω στα επίπεδα</a></p>

<div class="row">
    <div class="col-md-12">
        <form method="post" action="{{ route('cms.levels.update', ['id'=>$level->id]) }}">
            @csrf
            @method('put')
            <div class="form-group row">
                <label for="name" class="col-sm-2 col-form-label">Όνομα (άνδρας):</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control form-control-sm" id="name_male" name="name_male" value="{{ $level->name_male }}">
                </div>
            </div>
            <div class="form-group row">
                <label for="name" class="col-sm-2 col-form-label">Όνομα (γυναίκα):</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control form-control-sm" id="name_female" name="name_female" value="{{ $level->name_female }}">
                </div>
            </div>
            <div class="form-group row">
                <label for="name" class="col-sm-2 col-form-label">Πόντοι που απαιτούνται:</label>
                <div class="col-sm-10">
                    <input type="number" class="form-control form-control-sm" id="points_needed" name="points_needed" value="{{ $level->points_needed }}">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-6">
                    <button type="submit" class="btn btn-primary btn-sm">Αποθήκευση</button>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="{{ route('cms.levels.index') }}" class="btn btn-danger btn-sm">Άκυρο</a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection