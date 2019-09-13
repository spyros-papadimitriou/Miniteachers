@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="card bg-light">
                <div class="card-header">
                    <img src='{{ asset('svg/error-404.svg') }}' height="24" alt=''> Σφάλμα 404
                </div>
                <div class="card-body">
                    <blockquote class="mb-0">
                        <p>Η σελίδα που ζητήσατε δε βρέθηκε ή έγινε προσπάθεια εκτέλεσης διαδικασίας με μη έγκυρα δεδομένα.</p>
                        <footer class="blockquote-footer">Μαρία</footer>
                    </blockquote>
                </div>
            </div>
            <div class="text-center mt-3">
                <img src='{{ asset('svg/tips/11.svg') }}' height="300" alt=''>
            </div>
        </div>
    </div>
</div>
@endsection