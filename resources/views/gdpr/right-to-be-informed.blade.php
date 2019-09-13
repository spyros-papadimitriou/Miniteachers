@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <h5><img src='{{ asset('svg/gdpr2.svg') }}' height="32" alt=''> <a href="{{ route('gdpr-index') }}">GDPR - Δικαιώματα</a> &raquo; {{ $page->title }}</h5>
            <hr />
        </div>
        <div class="col-md-12">
            <div class="">
                {!! $page->content !!}
            </div>
        </div>

    </div>
</div>
@endsection
