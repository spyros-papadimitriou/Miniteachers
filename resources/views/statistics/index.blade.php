@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row">
        <div class="col-md-12">
            <h5><img src='{{ asset('svg/presentation.svg') }}' height="32" alt=''> Στατιστικά</h5>
        </div>
    </div>
    <hr />
    <div class="row">
        <div class="col-md-9">
            @foreach ($userTypes as $userType)
            <a class="btn btn-outline-primary btn-sm" href="{{ route('statistics-popular', ['userType'=>$userType->id,'slug'=>str_slug($userType->name)]) }}">Στατιστικά (δημοφιλή) βάσει {{ $userType->name }}</a>
            @endforeach
        </div>
        <div class="col-md-3">
            @tip(statistics)
        </div>
    </div>
</div>
@endsection
