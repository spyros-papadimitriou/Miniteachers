@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="card bg-light">
                <div class="card-header">
                    <img src='{{ asset('svg/no-entry.svg') }}' height="24" alt=''> Σφάλμα 403
                </div>
                <div class="card-body">
                    <blockquote class="mb-0">
                        <p>{{ $exception->getMessage() }}</p>
                        <footer class="blockquote-footer">Αστυνομικός</footer>
                    </blockquote>
                </div>
            </div>
            <div class="text-center mt-3">
                <img src='{{ asset('svg/tips/policeman.svg') }}' height="300" alt=''>
            </div>
        </div>
    </div>
</div>
@endsection