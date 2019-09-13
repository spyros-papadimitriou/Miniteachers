@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-9 mb-3">
            <div class="card">
                <div class="card-header">Εγγραφή εκπαιδευτικού</div>

                <div class="card-body">
                    <form method="post" action="{{ route('register') }}">
                        @csrf
                        @method('post')

                        <div class="row mb-3">
                            <div class="col-md-3 text-md-right">
                                <label for="userType">Τύπος χρήστη:</label>
                            </div>
                            <div class="col-md-9">
                                <div class="form-group">                                
                                    <select class="form-control" id="userType" name="userType">
                                        @foreach ($userTypes as $userType)
                                        <option value="{{ $userType->id }}">{{ $userType->name }}</option>
                                        @endforeach
                                    </select>
                                    <span class="text-muted small">
                                        Οι miniteachers είναι οι υποψήφιοι εκπαιδευτικοί.<br />
                                        Οι miniguests είναι οι επισκέπτες που ενδιαφέρονται να βρουν εκπαιδευτικό για ιδιαίτερα μαθήματα.
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-3 text-md-right">
                                Ονοματεπώνυμο:
                            </div>
                            <div class="col-md-9">
                                {{ $userSocial->name }}<br />
                                <span class="text-muted small">Μπορείτε να αλλάξετε το ονοματεπώνυμο (π.χ. από λατινικά σε ελληνικά) μετά την εγγραφή σας.</span>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-3 text-md-right">
                                Email:
                            </div>
                            <div class="col-md-9">
                                {{ $userSocial->email }}<br />
                            </div>
                        </div>

                        <div class="row mb-3">                           
                            <div class="col-md-9 offset-md-3">
                                <input required type="checkbox" id="age" name="age" value="1"{{ old('age') ? ' checked': '' }}>
                                       <label for="age">Είμαι τουλάχιστον 18 ετών (εκπαιδευτικός, μαθητής ή κηδεμόνας μαθητή).</label>                   
                                @if ($errors->has('age'))
                                <br />
                                <span class="small text-danger" role="alert">
                                    <strong>{{ $errors->first('age') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="row mb-3">                           
                            <div class="col-md-9 offset-md-3">
                                <input required type="checkbox" id="gdpr" name="gdpr" value="1"{{ old('gdpr') ? ' checked': '' }}>
                                       <label for="gdpr">Έχω διαβάσει την ενότητα 'Προσωπικά δεδομένα (GDPR)'.</label>                   
                                @if ($errors->has('gdpr'))
                                <br />
                                <span class="small text-danger" role="alert">
                                    <strong>{{ $errors->first('gdpr') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="row mb-3">                           
                            <div class="col-md-9 offset-md-3">
                                <input required type="checkbox" id="consent" name="consent" value="1"{{ old('consent') ? ' checked': '' }}>
                                       <label for="consent">Δίνω τη συγκατάθεσή μου για τη συλλογή/επεξεργασία των δεδομένων μου.</label>           
                                @if ($errors->has('consent'))
                                <br />
                                <span class="small text-danger" role="alert">
                                    <strong>{{ $errors->first('consent') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>


                        <div class="row mb-3">    
                            <div class="col-md-9 offset-md-3 small">
                                Περισσότερες πληροφορίες: <a target="_blank" href="{{ route('page', ['page'=>3, 'slug'=>'prosopika-dedomena-gdpr']) }}">GDPR - Ενημέρωση</a>.
                            </div>
                        </div>

                        <div class="row mb-3">    
                            <div class="col-md-9 offset-md-3 text-md-left text-sm-center">
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
            @tip(register)
        </div>
    </div>
</div>
@endsection
