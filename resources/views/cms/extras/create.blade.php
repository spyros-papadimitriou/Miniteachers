@extends('layouts.cms')
@section('content')
<h3><img height="32" src="{{ asset('svg/cms/extra.svg') }}" alt=""  /> Επιπλέον Πληροφορίες</h3>
<p><a href="{{ route('cms.extras.index') }}">Πίσω στις επιπλέον πληροφορίες</a></p>

<div class="row">
    <div class="col-md-12">
        <form method="post" action="{{ route('cms.extras.store') }}">
            @csrf
            <div class="form-group row">
                <label for="extra" class="col-sm-2 col-form-label">Επιλογή</label>
                <div class="col-sm-10">
                    <select class="form-control" id=userType" name="userType">
                        @foreach ($userTypes as $userType)
                        <option value="{{ $userType->id }}">{{ $userType->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <label for="description" class="col-sm-2 col-form-label">Περιγραφή:</label>
                <div class="col-sm-10">
                    <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-6">
                    <button type="submit" class="btn btn-primary btn-sm">Αποθήκευση</button>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="{{ route('cms.extras.index') }}" class="btn btn-danger btn-sm">Άκυρο</a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection