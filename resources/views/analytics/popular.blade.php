@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h5><img src='{{ asset('svg/analytics.svg') }}' height="32" alt=''> <a href="{{ route('analytics') }}">Analytics</a> &raquo; Δημοφιλείς αναζητήσεις ανά κατηγορία</h5>
            <hr />
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-md-12">
            <div class="card-group">
                <div class="card small">
                    <div class="card-header">
                        <img src="{{ asset('svg/book.svg') }}" height="24" alt=""> Μαθήματα
                    </div>
                    <div class="card-body">
                        @forelse ($courses as $course)
                        <div class="row">
                            <div class="col-lg-9 text-md-right text-sm-center">{{ $course->name }}</div>
                            <div class="col-lg-3 text-sm-center text-sm-center">{{ $course->searches_count  }}</div>
                        </div>
                        <hr />
                        @empty
                        -
                        @endforelse
                    </div>
                </div>

                <!-- target groups -->
                <div class="card small">
                    <div class="card-header">
                        <img src="{{ asset('svg/target-group.svg') }}" height="24" alt=""> Κατηγορία μαθητή
                    </div>
                    <div class="card-body">
                        @forelse ($targetGroups as $targetGroup)
                        <div class="row">
                            <div class="col-lg-9 text-md-right text-sm-center">{{ $targetGroup->name }}</div>
                            <div class="col-lg-3 text-sm-center text-sm-center">{{ $targetGroup->searches_count  }}</div>
                        </div>
                        <hr />
                        @empty
                        -
                        @endforelse
                    </div>
                </div>

                <!-- departments -->
                <div class="card small">
                    <div class="card-header">
                        <img src="{{ asset('svg/bachelor.svg') }}" height="24" alt=""> Προπτυχιακές σπουδές
                    </div>
                    <div class="card-body">
                        @forelse ($departments as $department)
                        <div class="row">
                            <div class="col-lg-9 text-md-right text-sm-center">
                                {{ $department->name }}<br />
                                ({{ $department->school->institution->name }})
                            </div>
                            <div class="col-lg-3 text-sm-center text-sm-center">{{ $department->searches_count  }}</div>
                        </div>
                        <hr />
                        @empty
                        -
                        @endforelse
                    </div>
                </div>


                <!-- postgraduates, phds -->
                <div class="card small">
                    <div class="card-header">
                        <img src="{{ asset('svg/philosopher.svg') }}" height="24" alt=""> Επιπλέον πτυχίο
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-9 text-md-right text-sm-center">Μεταπτυχιακό</div>
                            <div class="col-lg-3 text-sm-center text-sm-center">{{ $postgraduates }}</div>
                        </div>
                        <hr />
                        <div class="row">
                            <div class="col-lg-9 text-md-right text-sm-center">Διδακτορικό</div>
                            <div class="col-lg-3 text-sm-center text-sm-center">{{ $phds }}</div>
                        </div>
                        <hr />
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="row mb-3">

        <div class="col-md-12 mb-3">
            <div class="card-group">

                <!-- municipalities -->
                <div class="card small">
                    <div class="card-header">
                        <img src="{{ asset('svg/municipality.svg') }}" height="24" alt=""> Δήμος
                    </div>
                    <div class="card-body">
                        @forelse ($municipalities as $municipality)
                        <div class="row">
                            <div class="col-lg-9 text-md-right text-sm-center">{{ $municipality->name }}</div>
                            <div class="col-lg-3 text-sm-center">{{ $municipality->searches_count  }}</div>
                        </div>
                        <hr />
                        @empty
                        -
                        @endforelse
                    </div>
                </div>

                <!-- regional units -->
                <div class="card small">
                    <div class="card-header">
                        <img src="{{ asset('svg/map.svg') }}" height="24" alt=""> Περιφερειακή ενότητα
                    </div>
                    <div class="card-body">
                        @forelse ($regionalUnits as $regionalUnit)
                        <div class="row">
                            <div class="col-lg-9 text-md-right text-sm-center">{{ $regionalUnit->name }}</div>
                            <div class="col-lg-3 text-sm-center">{{ $regionalUnit->searches_count  }}</div>
                        </div>
                        <hr />
                        @empty
                        -
                        @endforelse
                    </div>
                </div>

                <!-- genders -->
                <div class="card small">
                    <div class="card-header">
                        <img src="{{ asset('svg/sex.svg') }}" height="24" alt=""> Φύλο
                    </div>
                    <div class="card-body">
                        @forelse ($genders as $gender)
                        <div class="row">
                            <div class="col-lg-9 text-md-right text-sm-center">{{ $gender->name }}</div>
                            <div class="col-lg-3 text-sm-center">{{ $gender->searches_count  }}</div>
                        </div>
                        <hr />
                        @empty
                        -
                        @endforelse
                    </div>
                </div>

                <!-- age ranges -->
                <div class="card small">
                    <div class="card-header">
                        <img src="{{ asset('svg/age-range.svg') }}" height="24" alt=""> Ηλικία
                    </div>
                    <div class="card-body">
                        @forelse ($ageRanges as $ageRange)
                        <div class="row">
                            <div class="col-lg-9 text-md-right text-sm-center">{{ $ageRange->description }}</div>
                            <div class="col-lg-3 text-sm-center">{{ $ageRange->searches_count  }}</div>
                        </div>
                        <hr />
                        @empty
                        -
                        @endforelse
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-md-12">
            <div class="card-group">

                <!-- experience -->
                <div class="card small">
                    <div class="card-header">
                        <img src="{{ asset('svg/experience.svg') }}" height="24" alt=""> Εμπειρία
                    </div>
                    <div class="card-body">
                        @forelse ($experiences as $experience)
                        <div class="row">
                            <div class="col-lg-9 text-md-right text-sm-center">{{ $experience->name }}</div>
                            <div class="col-lg-3 text-sm-center">{{ $experience->searches_count  }}</div>
                        </div>
                        <hr />
                        @empty
                        -
                        @endforelse
                    </div>
                </div>

                <!-- services -->
                <div class="card small">
                    <div class="card-header">
                        <img src="{{ asset('svg/services.svg') }}" height="24" alt=""> Υπηρεσίες
                    </div>
                    <div class="card-body">
                        @forelse ($services as $service)
                        <div class="row">
                            <div class="col-lg-9 text-md-right text-sm-center">{{ $service->name }}</div>
                            <div class="col-lg-3 text-sm-center">{{ $service->searches_count  }}</div>
                        </div>
                        <hr />
                        @empty
                        -
                        @endforelse
                    </div>
                </div>

                <!-- user types -->
                <div class="card small">
                    <div class="card-header">
                        <img src="{{ asset('svg/role.svg') }}" height="24" alt=""> Τύπος χρήστη
                    </div>
                    <div class="card-body">
                        @forelse ($userTypes as $userType)
                        <div class="row">
                            <div class="col-lg-9 text-md-right text-sm-center">{{ $userType->name }}</div>
                            <div class="col-lg-3 text-sm-center">{{ $userType->searches_count  }}</div>
                        </div>
                        <hr />
                        @empty
                        -
                        @endforelse
                    </div>
                </div>

                <!-- websites -->
                <div class="card small">
                    <div class="card-header">
                        <img src="{{ asset('svg/earth.svg') }}" height="24" alt=""> Ιστοσελίδες
                    </div>
                    <div class="card-body">
                        @forelse ($websites as $website)
                        <div class="row">
                            <div class="col-lg-9 text-md-right text-sm-center">{{ $website->name }}</div>
                            <div class="col-lg-3 text-sm-center">{{ $website->searches_count  }}</div>
                        </div>
                        <hr />
                        @empty
                        -
                        @endforelse
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-md-3">
            <div class="card-group">
                <!-- adjectives -->
                <div class="card small">
                    <div class="card-header">
                        <img src="{{ asset('svg/adjective.svg') }}" height="24" alt=""> Στοιχεία χαρακτήρα
                    </div>
                    <div class="card-body">
                        @forelse ($adjectives as $adjective)
                        <div class="row">
                            <div class="col-lg-9 text-md-right text-sm-center">{{ $adjective->name_male }} ή {{ $adjective->name_female }}</div>
                            <div class="col-lg-3 text-sm-center">{{ $adjective->searches_count  }}</div>
                        </div>
                        <hr />
                        @empty
                        -
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
