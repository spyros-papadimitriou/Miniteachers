@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">

        @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
        @endif

        <div class="col-md-12">
            <h5>{{ $page->title }}</h5>
            <hr />
            <div>
                {!! html_entity_decode($page->content) !!}
            </div>
        </div>
    </div>
</div>
@endsection
