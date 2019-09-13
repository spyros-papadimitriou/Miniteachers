@extends('layouts.profile')

@section('profile-content')
<div class="row">
    <div class="col-md-9">
        <h5>Προπτυχιακές σπουδές</h5>
    </div>
    <div class="col-md-3 text-right">
        @if (count($user->departments) < 3)
        <a class="btn btn-sm btn-success" href='{{ route('profile.departments.create') }}'>Προσθήκη</a>
        @endif
    </div>
</div>
<hr />

<div class="row">
    <div class="col-md-6">
        @if(session()->has('message'))
        <div class="alert alert-success small">{{ session()->get('message') }}</div>
        @endif

        @if (count($user->departments) > 0)
        @foreach ($user->departments as $department)
        <div>
            <small>{{ $loop->iteration }}.</small><br />
            <small>Τμήμα / Τομέας</small>: {{ $department->name }}<br />
            <small>Σχολή</small>: {{ $department->school->name }}<br />
            <small>Εκπαιδευτικό Ίδρυμα</small>: {{ $department->school->institution->name }}<br />
            <small>Έτος αποφοίτησης</small>: {{ $department->pivot->endyear }}

            <form action="{{ route('profile.departments.destroy', ['department'=>$department->id]) }}" method="post">
                @csrf
                @method('delete')
                <div class="text-right">
                    <a class="btn btn-sm btn-outline-info" href="{{ route('profile.departments.edit', ['department' => $department->id]) }}">Επεξεργασία</a>
                    <button type="submit" class="btn btn-sm btn-outline-danger">Διαγραφή</button>
                </div>
                <hr />
            </form>
        </div>
        @endforeach
        @else
        <p>Δεν υπάρχουν εγγραφές.</p>
        @endif
    </div>
    <div class='col-md-3 offset-lg-3 mt-3'>
        @miniteacher
        @tip(profile-edit-departments-miniteacher)
        @endminiteacher
        @miniguest
        @tip(profile-edit-departments-miniguest)
        @endminiguest
    </div>
</div>
@endsection
