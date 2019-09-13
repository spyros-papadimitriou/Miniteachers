@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <h5><img src='{{ asset('svg/gdpr2.svg') }}' height="32" alt=''> {{ $page->title }}</h5>
            <hr />
            {!! $page->content !!}
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-md-12">
            <div class="row">
                <div class="col-lg-3 mb-3 text-center">
                    <a href="{{ route('gdpr-right-to-be-informed') }}" class="btn btn-sm btn-outline-primary btn-block">
                        <img src="{{ asset('svg/gdpr.svg') }}" alt="" height="24">
                        Ενημέρωση <small>(Right to be informed)</small>
                    </a>
                </div>

                @auth
                <div class="col-lg-3 mb-3 text-center">
                    <a href="{{ route('gdpr-right-of-access') }}" class="btn btn-sm btn-outline-primary btn-block">
                        <img src="{{ asset('svg/gdpr.svg') }}" alt="" height="24">
                        Προβολή δεδομένων <small>(Right of access)</small>
                    </a>
                </div>
                <div class="col-lg-3 mb-3 text-center">
                    <a target="_blank" href="{{ route('gdpr-export-data') }}" class="btn btn-sm btn-outline-success btn-block">
                        <img src="{{ asset('svg/gdpr.svg') }}" alt="" height="24">
                        Εξαγωγή δεδομένων <small>(Right of access)</small>
                    </a>
                </div>

                <div class="col-lg-3 mb-3 text-center">
                    <form method="post" action="{{ route('gdpr-right-to-be-forgotten') }}" onsubmit="return confirm('Είστε σίγουροι για την άσκηση του δικαιώματος; Θα διαγραφεί ο λογαριασμός σας χωρίς να υπάρχει δυνατότητα επαναφοράς του.')">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-sm btn-outline-danger btn-block">
                            <img src="{{ asset('svg/gdpr.svg') }}" alt="" height="24">
                            Διαγραφή λογαριασμού
                        </button>              
                    </form>
                </div>
                @endauth
            </div>
        </div>
    </div>

    <div class="row mt-3">
        <div class='col-md-4 mb-3'>
            @tip(gdpr-right-to-be-informed)
        </div>

        @auth
        <div class='col-md-4 mb-3'>
            @tip(gdpr-right-of-access)
        </div>

        <div class='col-md-4'>
            @tip(gdpr-right-to-be-forgotten)
        </div>
        @endauth
    </div>
</div>
@endsection
