@extends('layouts.cms')
@section('content')
<h3><img height="32" src="{{ asset('svg/cms/megaphone.svg') }}" alt=""  /> Ανακοινώσεις</h3>
<p><a href="{{ route('cms.announcements.index') }}">Πίσω στις ανακοινώσεις</a></p>

<div class="row">
    <div class="col-md-12">
        <form method="post" action="{{ route('cms.announcements.store') }}">
            @csrf
            <div class="form-group row">
                <label for="title" class="col-sm-2 col-form-label">Τίτλος:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control form-control-sm" id="title" name="title">
                </div>
            </div>
            <div class="form-group row">
                <label for="content" class="col-sm-2 col-form-label">Περιεχόμενο:</label>
                <div class="col-sm-10">
                    <textarea class="form-control" id="content" name="content" rows="3"></textarea>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-6">
                    <button type="submit" class="btn btn-primary btn-sm">Αποθήκευση</button>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="{{ route('cms.announcements.index') }}" class="btn btn-danger btn-sm">Άκυρο</a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection