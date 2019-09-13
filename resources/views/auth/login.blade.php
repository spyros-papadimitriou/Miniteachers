@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">Είσοδος / Εγγραφή</div>

                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-lg-4 offset-lg-4">
                            <a class="btn btn-primary btn-block" href="{{ route('login-service', ['service'=>'google']) }}"><img alt="" height="24" src="{{ asset('svg/google-plus.svg')}}"> Είσοδος με Google</a>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-lg-4 offset-lg-4">
                            <a class="btn btn-info btn-block" href="{{ route('login-service', ['service'=>'facebook']) }}"><img alt="" height="24" src="{{ asset('svg/facebook.svg')}}"> Είσοδος με Facebook</a>
                        </div>
                    </div>

                    <div class="row mb-3 text-center">
                        <div class="col-lg-4 offset-lg-4">
                            <a class="btn btn-primary btn-block" href="{{ route('login-service', ['service'=>'linkedin']) }}"><img alt="" height="24" src="{{ asset('svg/linkedin.svg')}}"> Είσοδος με LinkedIn</a>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class='col-md-3'>
            <div class="card bg-light">
                <div class="card-header">
                    <img src='{{ asset('svg/info.svg') }}' height="24" alt=''> Tip
                </div>
                <div class="card-body">
                    <blockquote class="mb-0">
                        <p>Μπορείτε να πραγματοποιήσετε είσοδο στην πλατφόρμα μέσα από τις δημοφιλείς ιστοσελίδες κοινωνικής δικτύωσης. Η διασύνδεση με τις ιστοσελίδες αυτές χρησιμοποιείται για τη λήψη του email σας και μόνο.</p>
                        <p>Σε περίπτωση που δεν έχετε λογαριασμό στο MiniTeachers, θα σας ζητηθεί να δηλώσετε τη συγκατάθεσή σας για συλλογή και επεξεργασία των δεδομένων σας ώστε να είναι δυνατή η δημιουργία λογαριασμού στην πλατφόρμα.</p>
                        <footer class="blockquote-footer">Βασιλική</footer>
                    </blockquote>
                </div>
            </div>
            <div class="text-center mt-3">
                <img src='{{ asset('svg/tips/5.svg') }}' height="300" alt=''>
            </div>
        </div>
    </div>
</div>
@endsection
