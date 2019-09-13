@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row">
        <div class="col-md-12">
            <h5><img src='{{ asset('svg/presentation.svg') }}' height="32" alt=''> <a href="{{ route('statistics') }}">Στατιστικά</a> &raquo; Δημοφιλή στατιστικά ανά κατηγορία - {{ $userType->name }} (αριθμός χρηστών:  {{ $totalUsers }})</h5>
        </div>
    </div>
    <hr />

    <div class="row mb-3 text-left">
        <div class="col-md-12 small">
            <div class="card-group">                    
                <div class="card">
                    <div class="card-header">
                        <img src="{{ asset('svg/book.svg') }}" height="24" alt=""> Κορυφαία μαθήματα
                    </div>
                    <div class="card-body">

                        @forelse ($courses as $course)
                        <div class="row">
                            <div class="col-md-9">
                                {{ $course->name }}
                            </div>
                            <div class="col-md-3">
                                {{ $course->users_count }}
                            </div>
                        </div>
                        <hr />
                        @empty
                        Δεν υπάρχουν στοιχεία.
                        @endforelse

                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <img src="{{ asset('svg/municipality.svg') }}" height="24" alt=""> Δημοφιλέστεροι δήμοι ({{ $regionalUnit->name }})
                    </div>
                    <div class="card-body">
                        @forelse ($municipalities as $municipality)
                        <div class="row">                                   
                            <div class="col-md-9">
                                {{ $municipality->name }}
                            </div>
                            <div class="col-md-3">
                                {{ $municipality->users_count }}
                            </div>                         
                        </div>
                        <hr />
                        @empty   
                        Δεν υπάρχουν στοιχεία.
                        @endforelse
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <img src="{{ asset('svg/bachelor.svg') }}" height="24" alt=""> Δημοφιλέστερα πτυχία
                    </div>
                    <div class="card-body">
                        @forelse ($departments as $department)
                        <div class="row">
                            <div class="col-md-9">
                                {{ $department->name }}
                            </div>
                            <div class="col-md-3">
                                {{ $department->users_count }}
                            </div>

                        </div>
                        <hr />
                        @empty
                        Δεν υπάρχουν στοιχεία.
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-3 text-left">
        <div class="col-md-12 small">
            <div class="card-group">                    
                <div class="card">
                    <div class="card-header">
                        <img src="{{ asset('svg/euro.svg') }}" height="24" alt=""> Δημοφιλέστερες τιμές χρέωσης
                    </div>
                    <div class="card-body">

                        @forelse ($prices as $price)
                        <div class="row">
                            <div class="col-md-9">
                                {{ (int)$price->price_per_hour > 0 ? $price->price_per_hour. ' €': 'Συζητήσιμη' }}
                            </div>
                            <div class="col-md-3">
                                {{ $price->total }}
                            </div>
                        </div>
                        <hr />
                        @empty
                        Δεν υπάρχουν στοιχεία.
                        @endforelse

                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <img src="{{ asset('svg/target-group.svg') }}" height="24" alt=""> Δημοφιλέστερες κατηγορίες μαθητών
                    </div>
                    <div class="card-body">
                        @forelse ($targetGroups as $targetGroup)
                        <div class="row">                                   
                            <div class="col-md-9">
                                {{ $targetGroup->name }}
                            </div>
                            <div class="col-md-3">
                                {{ $targetGroup->users_count }}
                            </div>                         
                        </div>
                        <hr />
                        @empty   
                        Δεν υπάρχουν στοιχεία.
                        @endforelse
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <img src="{{ asset('svg/experience.svg') }}" height="24" alt=""> Δημοφιλέστερες εμπειρίες
                    </div>
                    <div class="card-body">
                        @forelse ($experiences as $experience)
                        <div class="row">
                            <div class="col-md-9">
                                {{ $experience->name }}
                            </div>
                            <div class="col-md-3">
                                {{ $experience->total }}
                            </div>

                        </div>
                        <hr />
                        @empty
                        Δεν υπάρχουν στοιχεία.
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-3 text-left">
        <div class="col-md-12 small">
            <div class="card-group">                    
                <div class="card">
                    <div class="card-header">
                        <img src="{{ asset('svg/sex.svg') }}" height="24" alt=""> Φύλο
                    </div>
                    <div class="card-body">

                        @forelse ($genders as $gender)
                        <div class="row">
                            <div class="col-md-9">
                                {{ $gender->name }}
                            </div>
                            <div class="col-md-3">
                                {{ $gender->total }}
                            </div>
                        </div>
                        <hr />
                        @empty
                        Δεν υπάρχουν στοιχεία.
                        @endforelse

                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <img src="{{ asset('svg/philosopher.svg') }}" height="24" alt=""> Επιπλέον πτυχία
                    </div>
                    <div class="card-body">
                        <div class="row">                                   
                            <div class="col-md-9">
                                Με μεταπτυχιακό τίτλο
                            </div>
                            <div class="col-md-3">
                                {{ $postgraduates }}
                            </div>                         
                        </div>
                        <hr />
                        <div class="row">                                   
                            <div class="col-md-9">
                                Με διδακτορικό τίτλο
                            </div>
                            <div class="col-md-3">
                                {{ $phds }}
                            </div>                         
                        </div>
                        <hr />
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <img src="{{ asset('svg/services.svg') }}" height="24" alt=""> Δημοφιλέστερες υπηρεσίες
                    </div>
                    <div class="card-body">
                        @forelse ($services as $service)
                        <div class="row">
                            <div class="col-md-9">
                                {{ $service->name }}
                            </div>
                            <div class="col-md-3">
                                {{ $service->users_count }}
                            </div>

                        </div>
                        <hr />
                        @empty
                        Δεν υπάρχουν στοιχεία.
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-3 text-left">
        <div class="col-md-4 small">
            <div class="card-group">
                <div class="card">
                    <div class="card-header">
                        <img src="{{ asset('svg/adjective.svg') }}" height="24" alt=""> Δημοφιλέστερα στοιχεία χαρακτήρα
                    </div>
                    <div class="card-body">
                        @forelse ($adjectives as $adjective)
                        <div class="row">
                            <div class="col-md-9">
                                {{ $adjective->name_male }} ή {{ $adjective->name_female }}
                            </div>
                            <div class="col-md-3">
                                {{ $adjective->users_count }}
                            </div>

                        </div>
                        <hr />
                        @empty
                        Δεν υπάρχουν στοιχεία.
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
