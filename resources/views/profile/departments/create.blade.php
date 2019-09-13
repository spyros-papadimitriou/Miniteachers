@extends('layouts.profile')

@section('profile-content')

<div class="row">
    <div class="col-md-12">
        <h5>Προσθήκη προπτυχιακών σπουδών</h5>
    </div>
</div>
<hr />

<div class="row">
    <div class="col-md-12">

        @foreach ($institutions as $institution)
        @if ($loop->iteration % 3 == 1)
        <div class="row mb-3">
            @endif
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header text-center"><a href="#" data-toggle="modal" data-target="#institution{{ $institution->id }}"><img src="{{ $institution->picture }}" height="64" alt=""></a></div>
                    <div class="card-body">
                        <p class="card-text text-center">
                            <a href="#" data-toggle="modal" data-target="#institution{{ $institution->id }}">{{ $institution->name }}
                            </a>
                        </p>                       
                    </div>
                </div>
            </div>
            @if ($loop->iteration % 3 == 0 || $loop->last)
        </div>
        @endif    
        <form id="form{{ $institution->id }}" action="{{ route('profile.departments.store') }}" method="post">
            @csrf
            <div class="modal fade small" id="institution{{ $institution->id }}" tabindex="-1" role="dialog" aria- aria-hidden="true">
                <div class="modal-dialog modal-xl" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            {{ $institution->name }}
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            @foreach ($institution->schools as $school)   
                            @if ($loop->iteration % 3 == 1)
                            <div class="card-deck mb-3">
                                @endif
                                <div class="card">
                                    <div class="card-header">{{ $school->name }}</div>
                                    <div class="card-body">                                    
                                        <ul class="list-group list-group-flush">
                                            @foreach ($school->departments as $department)
                                            <li class="list-group-item">
                                                <div class="custom-control custom-checkbox">
                                                    <input class="custom-control-input" type="radio" name="department" id="department{{ $department->id }}" value="{{ $department->id }}"{{ $loop->first && $loop->parent->first ? ' checked': null }}>
                                                    <label class="custom-control-label" for="department{{ $department->id }}">{{ $department->name }}</label>                               
                                                </div>
                                            </li>
                                            @endforeach
                                        </ul>
                                    </div>                                
                                </div>
                                @if ($loop->iteration % 3 == 0 || $loop->last)
                            </div>
                            @endif

                            @endforeach
                        </div>
                        <div class="modal-footer">
                            <small class="text-muted">Μετά την αποθήκευση, μπορείτε να πατήσετε επεξεργασία της εγγραφής και να προσθέσετε έτος αποφοίτησης.</small>
                            <button class="btn btn-primary btn-sm" type="submit">Αποθήκευση</button>
                            <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Άκυρο</button>
                        </div>
                    </div>                
                </div>


            </div>
        </form>
        @endforeach


        <a class="btn btn-danger btn-sm" href="{{ route('profile.departments.index') }}">Άκυρο</a>
    </div>
</div>
@endsection
