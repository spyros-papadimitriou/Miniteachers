@extends('layouts.profile')

@section('profile-content')

<div class="row">
    <div class="col-md-12">
        <h5>Προσθήκη - επεξεργασία μαθημάτων</h5>
    </div>
</div>
<hr />

<div class="row">
    <div class="col-md-9">
        <form action="{{ route('profile.courses.store') }}" method="post">
            @csrf

            @foreach ($courseCategories as $courseCategory)
            @if ($loop->iteration % 3 == 1)
            <div class="card-group mb-3">
                @endif
                <div class="card small">
                    <div class="card-header text-center">
                        <img src='{{ $courseCategory->picture }}' alt='' height="48"><br />
                        {{ $courseCategory->name }}
                    </div>
                    <div class="card-body">
                        @foreach ($courseCategory->courses as $course)
                        <div class="form-group">
                            <div class="custom-control custom-checkbox">
                                <input class="custom-control-input" type="checkbox" value="{{ $course->id }}" name="courses[]" id="course{{ $course->id }}"{{ $user->courses->contains($course) ? ' checked': null }}>
                                <label class="custom-control-label" for="course{{ $course->id }}">
                                    {{ $course->name }}
                                </label>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @if ($loop->iteration % 3 == 0 || $loop->last)
            </div>
            @endif

            @endforeach
            <button class="btn btn-primary btn-sm" type="submit">Αποθήκευση</button>
            <a class="btn btn-danger btn-sm" href="{{ route('profile.courses.index') }}">Άκυρο</a>
        </form>
    </div>

    <div class='col-md-3 mt-3'>
        <div class="card bg-light">
            <div class="card-header">
                <img src='{{ asset('svg/info.svg') }}' height="24" alt=''> Tip
            </div>
            <div class="card-body">
                <blockquote class="mb-0">
                    <p>Μπορείτε να επιλέξετε πολλά μαθήματα μαζί. Αν αποεπιλέξετε κάποιο επιλεγμένο μάθημα, θα διαγραφεί από τη λίστα με τα μαθήματα που διδάσκετε.</p>
                    <p>Μπορείτε να δηλώσετε μέχρι 5 μαθήματα.</p>
                    <footer class="blockquote-footer">Γεωργία</footer>
                </blockquote>
            </div>
        </div>
        <div class="text-center mt-3">
            <img src='{{ asset('svg/tips/3.svg') }}' height="300" alt=''>
        </div>
    </div>
</div>
@endsection
