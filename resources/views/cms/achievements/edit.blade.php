@extends('layouts.cms')
@section('content')
<h3><img height="32" src="{{ asset('svg/cms/achievement.svg') }}" alt=""  /> Επιτεύγματα</h3>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('cms.achievement_types.index') }}">Κατηγορίες Επιτευγμάτων</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{ $achievementType->name }}</li>
    </ol>
</nav>

<div class="row">
    <div class="col-md-12">
        <form method="post" action="{{ route('cms.achievement_types.achievements.update', ['achievement_type' =>$achievementType->id, 'achievement'=>$achievement->id]) }}">
            @csrf
            @method('put')
            <div class="form-group row">
                <label for="value" class="col-sm-2 col-form-label">Τιμή:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control form-control-sm" id="value" name="value" value="{{ $achievement->value }}">
                </div>
            </div>
            <div class="form-group row">
                <label for="points" class="col-sm-2 col-form-label">Πόντοι:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control form-control-sm" id="points" name="points" value="{{ $achievement->points }}">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-6">
                    <button type="submit" class="btn btn-primary btn-sm">Αποθήκευση</button>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="{{ route('cms.achievement_types.achievements.index', ['achievement_type'=>$achievementType->id]) }}" class="btn btn-danger btn-sm">Άκυρο</a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection