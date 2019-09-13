@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">Εγγραφή εκπαιδευτικού</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Ονοματεπώνυμο:</label><br />

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>
                                <span class="text-muted small">Π.χ.: Δημήτρης Χαριλάου</span>

                                @if ($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">Email:</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Κωδικός:</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                                <span class="text-muted small">Τουλάχιστον 6 χαρακτήρες.</span>

                                @if ($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Επιβεβαίωση κωδικού</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <div class="col-md-6 offset-md-4">
                                <div class="custom-control custom-checkbox">
                                    <input required type="checkbox" class="custom-control-input{{ $errors->has('gdpr') ? ' is-invalid': ''}}" id="gdpr" name="gdpr" value="1"{{ old('gdpr') ? ' checked': '' }}>
                                           <label class="custom-control-label small" for="gdpr">Έχω διαβάσει την ενότητα 'Προσωπικά δεδομένα (GDPR)'.</label> 
                                    @if ($errors->has('gdpr'))
                                    <span class="small text-danger" role="alert">
                                        <strong>{{ $errors->first('gdpr') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <div class="col-md-6 offset-md-4">
                                <div class="custom-control custom-checkbox">
                                    <input required type="checkbox" class="custom-control-input{{ $errors->has('consent') ? ' is-invalid': ''}}" id="consent" name="consent" value="1"{{ old('consent') ? ' checked': '' }}>
                                           <label class="custom-control-label small" for="consent">Δίνω τη συγκατάθεσή μου για τη συλλογή/επεξεργασία των δεδομένων μου.</label>
                                    @if ($errors->has('consent'))
                                    <span class="small text-danger" role="alert">
                                        <strong>{{ $errors->first('consent') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <div class="col-md-6 offset-md-4 small">
                                Περισσότερες πληροφορίες: <a target="_blank" href="{{ route('page', ['page'=>3, 'slug'=>'prosopika-dedomena-gdpr']) }}">προσωπικά δεδομένα (GDPR)</a>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary btn-sm">
                                    Εγγραφή
                                </button>
                            </div>
                        </div>
                    </form>
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
                        <p>Μέσα από τη σελίδα αυτή μπορείτε να δημιουργήσετε λογαριασμό εκπαιδευτικού.</p>
                        <p>Παρακαλώ συμπληρώστε στο πεδίο 'ονοματεπώνυμο' πρώτα το όνομα και μετά το επώνυμο.</p>
                        <p>Επίσης, παρακαλώ αφιερώστε λίγο χρόνο για να διαβάσετε την ενότητα με το GDPR για να γνωρίζετε, σε περίπτωση εγγραφής, τι δεδομένα σας θα διατηρεί η ιστοσελίδα και τι είδους επεξεργασία θα πραγματοποιεί.</p>
                        <p>Σημειώνεται ότι ανά πάσα στιγμή μπορείτε να ασκήσετε τα δικαιώματα λήψης των δεδομένων σας αλλά και πλήρους διαγραφής από τη βάση δεδομένων της εφαρμογής</p>
                        <footer class="blockquote-footer">Σπύρος</footer>
                    </blockquote>
                </div>
            </div>
            <div class="text-center mt-3">
                <img src='{{ asset('svg/tips/8.svg') }}' height="300" alt=''>
            </div>
        </div>
    </div>
</div>
@endsection
