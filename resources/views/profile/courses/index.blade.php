@extends('layouts.profile')

@section('profile-content')
<div class="row">
    <div class="col-md-9">
        <h5>
            @miniteacher
            Μαθήματα που διδάσκω
            @endminiteacher
            @miniguest
            Μαθήματα που με ενδιαφέρουν
            @endminiguest
            @admin
            Μαθήματα
            @endadmin
        </h5>
    </div>
    <div class="col-md-3 text-right">
        <a class="btn btn-sm btn-success" href='{{ route('profile.courses.create') }}'>Προσθήκη - Επεξεργασία</a>
    </div>
</div>
<hr />

<div class="row">
    <div class="col-md-6">
        @if(session()->has('message'))
        <div class="alert alert-success small">{{ session()->get('message') }}</div>
        @endif

        @if (count($user->courses) > 0)
        @foreach ($user->courses as $course)
        <div>
            <small>{{ $loop->iteration }}.</small><br />
            <small>Μάθημα</small>:  {{ $course->name }}<br />
            <small>Κατηγορία</small>:  {{ $course->courseCategory->name }}
            <form action="{{ route('profile.courses.destroy', ['service'=>$course->id]) }}" method="post">
                @csrf
                @method('delete')
                <div class="text-right">
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
        @tip(profile-edit-courses-miniteacher)
        @endminiteacher
        @miniguest
        @tip(profile-edit-courses-miniguest)
        @endminiguest
    </div>
</div>
@endsection
