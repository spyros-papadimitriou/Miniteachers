@extends('layouts.profile')

@section('profile-content')

<div class="row">
    <div class="col-md-12">
        <h5>Βασικές πληροφορίες</h5>
    </div>
</div>
<hr />

<div class="row">
    <div class="col-md-6">
        @if(session()->has('message'))
        <div class="alert alert-success small">{{ session()->get('message') }}</div>
        @endif

        <form action="{{ route('profile.basic-info.update', ['user'=>$user->id]) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('put')

            <div class="form-group">
                <label for="gender">Τύπος χρήστη</label>
                <select class="form-control form-control-sm" id="userType" name="userType" required>
                    @foreach ($userTypes as $userType)
                    <option value="{{ $userType->id }}"{{ $userType->id == $user->userType->id ? ' selected': null }}>{{ $userType->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="name">Όνομα</label>
                <input type="text" class="form-control form-control-sm" id="name" name="name" required value="{{ $user->name }}">
                <small class="text-muted">Προτιμήστε ελληνικούς χαρακτήρες με πρώτο το όνομα και δεύτερο το επώνυμο.<br />Π.χ. Σπύρος Παπαδημητρίου.</small>
            </div>
            <div class="form-group">
                <label for="gender">Φύλο</label>
                <select class="form-control form-control-sm" id="gender" name="gender" required>
                    @foreach ($genders as $gender)
                    <option value="{{ $gender->id }}"{{ $gender->id == $user->gender->id ? ' selected': null }}>{{ $gender->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="birthdate">Ημ/νία γέννησης</label>
                <input type="text" class="form-control form-control-sm" id="birthdate" name="birthdate" required value="{{ $user->birthdate }}">
                <small class="text-muted">Μορφή ημερομηνίας: yyyy-mm-dd.<br />Δηλαδή: έτος-μήνας-ημέρα<br />Π.χ.: 1980-02-27</small>
            </div>

            <hr />
            <div class="form-group">
                <label for="gender">Εμπειρία</label>
                <select class="form-control form-control-sm" id="experience" name="experience" required>
                    @foreach ($experiences as $experience)
                    <option value="{{ $experience->id }}"{{ $experience->id == $user->userStat->experience->id ? ' selected': null }}>{{ $experience->name }}</option>
                    @endforeach
                </select>
                <small class="text-muted">
                    miniteacher: Η εμπειρία ως εκπαιδευτικός.<br/>
                    miniguest: Η εμπειρία ως μαθητής (πόσα έτη απευθύνεται σε εκπαιδευτικούς για ιδιαίτερα μαθήματα).
                </small>
            </div>
            <div class="form-group">
                <label for="name">Τιμή ανά ώρα <small>(0 έως 50 &euro;)</small></label>
                <input type="number" class="form-control form-control-sm" id="pricePerHour" name="pricePerHour" required value="{{ (int) $user->userStat->price_per_hour }}">
                <small class="text-muted">
                    Αν βάλετε 0, οι υπόλοιποι χρήστες θα βλέπουν 'Τιμή: συζητήσιμη'. <br />
                    miniteacher: Η τιμή ανά ώρα που χρεώνει.<br />
                    miniguest: Η μέγιστη τιμή ανά ώρα που μπορεί να διαθέσει.
                </small>
            </div>
            <div class="form-group">
                <label for="picture">Εικόνα</label>
                <input type="file" class="form-control-file" id="picture" name="picture">
            </div>

            @if($user->picture)
            <div class="form-group">
                <img class="img-thumbnail" src="{{ asset('uploads/users/'.$user->picture) }}" alt="{{ $user->picture }}">
            </div>
            <div class="custom-control custom-checkbox">
                <input class="custom-control-input" type="checkbox" name="deletePicture" id="deletePicture" value="1">
                <label class="custom-control-label" for="deletePicture">
                    Διαγραφή εικόνας
                </label>
            </div>
            @endif

            <hr />
            <div class="form-group">
                <label for="gender">Δημοσίευση προφίλ</label>
                <select class="form-control form-control-sm" id="published" name="published" required>
                    <option value="1"{{ $user->userStat->published == 1 ? ' selected': '' }}>Δημοσιευμένο</option>
                    <option value="0"{{ $user->userStat->published == 0 ? ' selected': '' }}>Κρυφό</option>
                </select>
                <p class="small text-muted">
                    Πρέπει να επιλέξετε 'Δημοσιευμένο' για να είναι ορατό το προφίλ σας στους υπόλοιπους χρήστες.<br />
                    Χρήσιμο στην περίπτωση που θέλετε το προφίλ σας να είναι ορατό αφού συμπληρώσετε όλες τις πληροφορίες του.</p>
            </div>

            <button class="mt-3 btn btn-primary btn-sm" type="submit">Αποθήκευση</button>
            <a class="mt-3 btn btn-danger btn-sm" href="{{ route('profile-show') }}">Άκυρο</a>
        </form>
    </div>

    <div class="col-md-3 offset-lg-3 mt-3">
        @tip(profile-edit-basic-info)
    </div>
</div>
@endsection
