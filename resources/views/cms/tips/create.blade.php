@extends('layouts.cms')
@section('content')
<h3><img height="32" src="{{ asset('svg/cms/lightbulb.svg') }}" alt=""  /> Συμβουλές</h3>
<p><a href="{{ route('cms.tips.index') }}">Πίσω στις συμβουλές</a></p>

<div class="row">
    <div class="col-md-12">
        <form method="post" action="{{ route('cms.tips.store') }}">
            @csrf
            <div class="form-group row">
                <label for="tip" class="col-sm-2 col-form-label">Επιλογή</label>
                <div class="col-sm-10">
                    <select class="form-control" id=agent" name="agent">
                        <option value="0">-</option>
                        @foreach ($agents as $agent)
                        <option value="{{ $agent->id }}">{{ $agent->name }} ({{ $agent->tips()->count() }})</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <label for="alias" class="col-sm-2 col-form-label">Alias:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control form-control-sm" id="alias" name="alias">
                </div>
            </div>

            <div class="form-group row">
                <label for="title" class="col-sm-2 col-form-label">Τίτλος:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control form-control-sm" id="title" name="title">
                </div>
            </div>

            <div class="form-group row">
                <label for="content" class="col-sm-2 col-form-label">Περιεχόμενο:</label>
                <div class="col-sm-10">
                    <textarea class="form-control summernote" id="description" name="content" rows="5"></textarea>
                </div>
</div>
<div class="form-group row">
    <div class="col-sm-6">
        <button type="submit" class="btn btn-primary btn-sm">Αποθήκευση</button>
    </div>
    <div class="col-sm-6 text-right">
        <a href="{{ route('cms.tips.index') }}" class="btn btn-danger btn-sm">Άκυρο</a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection