@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mb-3">
        <div class="col-md-6 text-sm-center text-md-left">
            <h5><img src='{{ asset('svg/usertypes/avatar-'.$user->userType->id.'-'.$user->gender->id.'.svg') }}' height="32" alt=''> {{ $user->name }}</h5>
        </div>
        @if ($canEdit)
        <div class="col-md-6 text-md-right text-sm-center">
            <a class="btn btn-sm btn-outline-primary" href="{{ route('profile.basic-info.edit', ['user'=>Auth::user()->id]) }}"><img height="16" src="{{ asset('svg/usertypes/edit-profile-'.Auth::user()->userType->id.'-'.Auth::user()->gender->id.'.svg') }}"> Επεξεργασία προφίλ</a>
        </div>
        @endif
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <ul class="nav nav-pills nav-fill card-header-pills" role='tablist'>
                        <li class="nav-item">
                            <a id='pills-basic-info-tab' data-toggle="pill" href="#pills-basic-info" role='tab' aria-controls='pills-basic-profile.basic-info' aria-selected="true" class="nav-link active"><img height="24" src="{{ asset('svg/info.svg') }}" alt=""> Βασικές πληροφορίες</a>
                        </li>
                        <li class="nav-item">
                            <a id='pills-extra-tab' data-toggle="pill" href="#pills-extra" role='tab' aria-controls='pills-extra' aria-selected="false" class="nav-link" ><img height="24" src="{{ asset('svg/extra.svg') }}" alt=""> Επιπλέον πληροφορίες <small>({{ count($user->extras) }})</small></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id='pills-courses-tab' data-toggle="pill" href="#pills-courses" role='tab' aria-controls='pills-courses' aria-selected="false"><img height="24" src="{{ asset('svg/book.svg') }}" alt=""> Μαθήματα <small>({{ count($user->courses) }})</small></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id='pills-target-groups-tab' data-toggle="pill" href="#pills-target-groups" role='tab' aria-controls='pills-target-groups' aria-selected="false"><img height="24" src="{{ asset('svg/target-group.svg') }}" alt=""> Κατηγορίες μαθητών <small>({{ count($user->targetGroups) }})</small></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id='pills-services-tab' data-toggle="pill" href="#pills-services" role='tab' aria-controls='pills-services' aria-selected="false"><img height="24" src="{{ asset('svg/services.svg') }}" alt=""> Υπηρεσίες <small>({{ count($user->services) }})</small></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id='pills-departments-tab' data-toggle="pill" href="#pills-departments" role='tab' aria-controls='pills-departments' aria-selected="false"><img height="24" src="{{ asset('svg/bachelor.svg') }}" alt=""> Προπτυχιακές σπουδές <small>({{ count($user->departments) }})</small></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id='pills-postgraduates-tab' data-toggle="pill" href="#pills-postgraduates" role='tab' aria-controls='pills-postgraduates' aria-selected="false"><img height="24" src="{{ asset('svg/certificate.svg') }}" alt=""> Μεταπτυχιακές σπουδές <small>({{ count($user->postgraduates) }})</small></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id='pills-phds-tab' data-toggle="pill" href="#pills-phds" role='tab' aria-controls='pills-phds' aria-selected="false"><img height="24" src="{{ asset('svg/philosopher.svg') }}" alt="">Διδακτορικές σπουδές <small>({{ count($user->phds) }})</small></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id='pills-phds-tab' data-toggle="pill" href="#pills-municipalities" role='tab' aria-controls='pills-municipalities' aria-selected="false"><img height="24" src="{{ asset('svg/municipality.svg') }}" alt=""> Δήμοι <small>({{ count($user->municipalities) }})</small></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id='pills-contact-data-tab' data-toggle="pill" href="#pills-contact-data" role='tab' aria-controls='pills-contact-data' aria-selected="false"><img height="24" src="{{ asset('svg/contact-info.svg') }}" alt=""> Στοιχεία επικοινωνίας <small>({{ count($user->contactData) }})</small></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id='pills-adjectives-tab' data-toggle="pill" href="#pills-adjectives" role='tab' aria-controls='pills-adjectives' aria-selected="false"><img height="24" src="{{ asset('svg/adjective.svg') }}" alt=""> Στοιχεία χαρακτήρα <small>({{ count($user->adjectives) }})</small></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id='pills-websites-tab' data-toggle="pill" href="#pills-websites" role='tab' aria-controls='pills-websites' aria-selected="false"><img height="24" src="{{ asset('svg/earth.svg') }}" alt=""> Ιστοσελίδες <small>({{ count($user->websites) }})</small></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id='pills-favourites-tab' data-toggle="pill" href="#pills-favourites" role='tab' aria-controls='pills-favourites' aria-selected="false"><img height="24" src="{{ asset('svg/favourite.svg') }}" alt=""> Λίστα αγαπημένων <small>({{ $favouritesInverseCount }})</small></a>
                        </li>
                    </ul>
                </div>

                <div class="row">
                    <div class="col-md-8">

                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" role='tabpanel' aria-labelledby="pills-basic-info-tab" id="pills-basic-info">
                                <div class="card-body" id="basic-basic-info">
                                    <h5 class="card-title"><img height="24" src="{{ asset('svg/info.svg') }}" alt=""> Βασικές πληροφορίες @if ($canEdit) <a class="small" href="{{ route('profile.basic-info.edit', ['user'=>$user->id]) }}"><img height="16" src="{{ asset('svg/pencil.svg') }}" alt=""></a>@endif</h5>
                                    <hr />

                                    @if ($canEdit && $user->userStat->published == 0)
                                    <div class="row mb-2">
                                        <div class="col-md-12">
                                            <small class="text-danger">Το προφίλ σας είναι μη δημοσιευμένο. Μπορείτε να δημοσιεύσετε το προφίλ σας πατώντας επεξεργασία των βασικών πληροφοριών και αλλάζοντας τη 'Δημοσίευση προφίλ' από 'Κρυφό' σε 'Δημοσιευμένο'.
                                            </small>
                                        </div>
                                    </div>
                                    @endif

                                    <div class="row mb-2">
                                        <div class="col-md-4"><small>Id:</small></div>
                                        <div class="col-md-8">{{ $user->id }}</div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-md-4"><small>Τύπος χρήστη:</small></div>
                                        <div class="col-md-8">{{ $user->userType->name }}</div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-md-4"><small>Όνομα:</small></div>
                                        <div class="col-md-8">{{ $user->name }}</div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-md-4"><small>Φύλο:</small></div>
                                        <div class="col-md-8"><img src="{{ asset('svg/genders/'.$user->gender->id.'.svg') }}" height="24" title="{{ $user->gender->name }} alt="{{ $user->gender->name }}"></div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-md-4"><small>Ηλικία:</small></div>
                                        <div class="col-md-8">{{ $user->ageRange->description }}</div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-md-4"><small>Τελευταίο login:</small></div>
                                        <div class="col-md-8">{{ $user->login_date }}</div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-md-4">
                                            <small>
												{{ $user->userType->id == App\UserType::TEACHER ? 'Εμπειρία:': 'Επιθυμητή εμπειρία miniteacher:'}}
                                            </small>
                                        </div>
                                        <div class="col-md-8">{{ $user->userStat->experience->name }}</div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-md-4">
                                            <small>
												{{ $user->userType->id == App\UserType::TEACHER ? 'Τιμή ανά ώρα:': 'Μέγιστη επιθυμητή τιμή χρέωσης:'}}
                                            </small>
                                        </div>
                                        <div class="col-md-8">{!! $user->userStat->price_per_hour > 0 ? $user->userStat->price_per_hour. ' &euro;': 'Συζητήσιμη' !!}</div>
                                    </div>
                                </div>
                                <div class="dropdown-divider"></div>
                            </div>

                            <div class="tab-pane fade" role='tabpanel' aria-labelledby="pills-extra-tab" id="pills-extra">
                                <div class="card-body" id="extra">
                                    <h5 class="card-title"><img height="24" src="{{ asset('svg/extra.svg') }}" alt=""> Επιπλέον πληροφορίες @if ($canEdit) <a class="small" href="{{ route('profile.extra.index') }}"><img height="16" src="{{ asset('svg/pencil.svg') }}" alt=""></a>@endif</h5>
                                    <hr />
                                    @if (count($user->extras) > 0)
                                    @foreach ($user->extras as $extra)
                                    <div class="card-text">
                                        <div class="row">
                                            <div class="col-md-1">
                                                <small>{{ $loop->iteration }}.</small>
                                            </div>
                                            <div class="col-md-11 mb-2">
                                                <small>{{ $extra->description }}</small><br />
                                                {{ $extra->pivot->content }}
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                    @else
                                    <p class="card-text">-</p>
                                    @endif
                                </div>                
                                <div class="dropdown-divider"></div>
                            </div>

                            <div class="tab-pane fade" role='tabpanel' aria-labelledby="pills-courses-tab" id="pills-courses">
                                <div class="card-body" id="courses">
                                    <h5 class="card-title"><img height="24" src="{{ asset('svg/book.svg') }}" alt=""> Μαθήματα@if ($canEdit) <a class="small" href="{{ route('profile.courses.index') }}"><img height="16" src="{{ asset('svg/pencil.svg') }}" alt=""></a>@endif</h5>
                                    <hr />
                                    @if (count($user->courses) > 0)
                                    @foreach ($user->courses as $course)
                                    <div class="card-text">
                                        <div class="row">
                                            <div class="col-md-1">
                                                <small>{{ $loop->iteration }}.</small>
                                            </div>
                                            <div class="col-md-11 mb-2">
                                                {{ $course->name }}
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                    @else
                                    <p class="card-text">-</p>
                                    @endif
                                </div>
                                <div class="dropdown-divider"></div>
                            </div>

                            <div class="tab-pane fade" role='tabpanel' aria-labelledby="pills-target-groups-tab" id="pills-target-groups">
                                <div class="card-body" id="target-groups">
                                    <h5 class="card-title"><img height="24" src="{{ asset('svg/target-group.svg') }}" alt=""> Κατηγορίες μαθητών@if ($canEdit) <a class="small" href="{{ route('profile.target-groups.index') }}"><img height="16" src="{{ asset('svg/pencil.svg') }}" alt=""></a>@endif</h5>
                                    <hr />                                    
                                    @forelse ($user->targetGroups as $targetGroup)
                                    <div class="card-text">
                                        <div class="row">
                                            <div class="col-md-1">
                                                <small>{{ $loop->iteration }}.</small>
                                            </div>
                                            <div class="col-md-11 mb-2">
                                                {{ $targetGroup->name }}
                                            </div>
                                        </div>
                                    </div>
                                    @empty
                                    Δεν υπάρχουν εγγραφές.
                                    @endforelse
                                </div>
                                <div class="dropdown-divider"></div>
                            </div>

                            <div class="tab-pane fade" role='tabpanel' aria-labelledby="pills-services-tab" id="pills-services">
                                <div class="card-body" id="services">
                                    <h5 class="card-title"><img height="24" src="{{ asset('svg/services.svg') }}" alt=""> Υπηρεσίες@if ($canEdit) <a class="small" href="{{ route('profile.services.index') }}"><img height="16" src="{{ asset('svg/pencil.svg') }}" alt=""></a>@endif</h5>
                                    <hr />

                                    @forelse ($user->services as $service)
                                    <div class="card-text">
                                        <div class="row">
                                            <div class="col-md-1">
                                                <small>{{ $loop->iteration }}.</small>
                                            </div>
                                            <div class="col-md-11 mb-2">
                                                {{ $service->name }}
                                            </div>
                                        </div>
                                    </div>
                                    @empty
                                    <p>Δεν υπάρχουν εγγραφές.</p>
                                    @endforelse
                                </div>
                                <div class="dropdown-divider"></div>
                            </div>

                            <div class="tab-pane fade" role='tabpanel' aria-labelledby="pills-departments-tab" id="pills-departments">
                                <div class="card-body" id="bachelor">
                                    <h5 class="card-title"><img height="24" src="{{ asset('svg/bachelor.svg') }}" alt=""> Προπτυχιακές σπουδές@if ($canEdit) <a class="small" href="{{ route('profile.departments.index') }}"><img height="16" src="{{ asset('svg/pencil.svg') }}" alt=""></a>@endif</h5>
                                    <hr />

                                    @forelse ($user->departments as $department)
                                    <div class="card-text">
                                        <div class="row">
                                            <div class="col-md-1">
                                                <small>{{ $loop->iteration }}.</small>
                                            </div>
                                            <div class="col-md-11 mb-2">
                                                <small>Τμήμα:</small> <a href='{{ $department->url }}' target='_blank'>{{ $department->name }}</a><br />
                                                <small>Σχολή:</small> <a href='{{ $department->url }}' target='_blank'>{{ $department->school->name }}</a><br />
                                                <small>Εκπαιδευτικό Ίδρυμα:</small> <a href='{{ $department->url }}' target='_blank'>{{ $department->school->institution->name }}</a><br />
                                                <small>Έτος αποφοίτησης:</small> -
                                            </div>
                                        </div>
                                    </div>
                                    @empty
                                    <p>Δεν υπάρχουν εγγραφές.</p>
                                    @endforelse
                                </div>
                                <div class="dropdown-divider"></div>
                            </div>

                            <div class="tab-pane fade" role='tabpanel' aria-labelledby="pills-postgraduates-tab" id="pills-postgraduates">
                                <div class="card-body" id="postgraduates">
                                    <h5 class="card-title"><img height="24" src="{{ asset('svg/certificate.svg') }}" alt=""> Μεταπτυχιακές σπουδές@if ($canEdit) <a class="small" href="{{ route('profile.postgraduates.index') }}"><img height="16" src="{{ asset('svg/pencil.svg') }}" alt=""></a>@endif</h5>
                                    <hr />

                                    @forelse ($user->postgraduates as $postgraduate)
                                    <div class="card-text">
                                        <div class="row">
                                            <div class="col-md-1"><small>{{ $loop->iteration }}.</small></div>
                                            <div class="col-md-11 mb-2">
                                                <small>Όνομα μεταπτυχιακού:</small> {{ $postgraduate->name }}<br />
                                                <small>Έτος αποφοίτησης:</small> {{ $postgraduate->endyear != null ? $postgraduate->endyear: '-'}}
                                            </div>
                                        </div>
                                    </div>
                                    @empty
                                    <p>Δεν υπάρχουν εγγραφές.</p>
                                    @endforelse
                                </div>
                                <div class="dropdown-divider"></div>
                            </div>

                            <div class="tab-pane fade" role='tabpanel' aria-labelledby="pills-phds-tab" id="pills-phds">
                                <div class="card-body" id="phd">
                                    <h5 class="card-title"><img height="24" src="{{ asset('svg/philosopher.svg') }}" alt=""> Διδακτορικές σπουδές@if ($canEdit) <a class="small" href="{{ route('profile.phds.index') }}"><img height="16" src="{{ asset('svg/pencil.svg') }}" alt=""></a>@endif</h5>
                                    <hr />

                                    @forelse ($user->phds as $phd)
                                    <div class="card-text">
                                        <div class="row">
                                            <div class="col-md-1">
                                                <small>{{ $loop->iteration }}.</small>
                                            </div>
                                            <div class="col-md-11 mb-2">
                                                <small>Θέμα διδακτορικής διατριβής:</small> {{ $phd->name }}<br />
                                                <small>Έτος αποφοίτησης:</small> {{ $phd->endyear != null ? $phd->endyear: '-'}}
                                            </div>
                                        </div>
                                    </div>
                                    @empty
                                    <p>Δεν υπάρχουν εγγραφές.</p>
                                    @endforelse
                                </div>
                                <div class="dropdown-divider"></div>
                            </div>

                            <div class="tab-pane fade" role='tabpanel' aria-labelledby="pills-municipalities-tab" id="pills-municipalities">
                                <div class="card-body" id="municipalities">
                                    <h5 class="card-title"><img height="24" src="{{ asset('svg/municipality.svg') }}" alt=""> Δήμοι@if ($canEdit) <a class="small" href="{{ route('profile.municipalities.index') }}"><img height="16" src="{{ asset('svg/pencil.svg') }}" alt=""></a>@endif</h5>
                                    <hr />

                                    @forelse ($user->municipalities as $municipality)
                                    <div class="card-text">
                                        <div class="row">
                                            <div class="col-md-1">
                                                <small>{{ $loop->iteration }}.</small>
                                            </div>
                                            <div class="col-md-11 mb-2">
                                                {{ $municipality->name }} ({{ $municipality->regionalUnit->region->name  }})
                                            </div>
                                        </div>
                                    </div>
                                    @empty
                                    <p>Δεν υπάρχουν εγγραφές.</p>
                                    @endforelse
                                </div>
                                <div class="dropdown-divider"></div>
                            </div>

                            <div class="tab-pane fade" role='tabpanel' aria-labelledby="pills-contact-data-tab" id="pills-contact-data">
                                <div class="card-body" id="contact-data">
                                    <h5 class="card-title"><img height="24" src="{{ asset('svg/contact-info.svg') }}" alt=""> Στοιχεία επικοινωνίας@if ($canEdit) <a class="small" href="{{ route('profile.contact-data.index') }}"><img height="16" src="{{ asset('svg/pencil.svg') }}" alt=""></a>@endif</h5>
                                    <hr />

                                    @forelse ($user->contactData as $contactData)
                                    <div class="card-text">
                                        <div class="row">
                                            <div class="col-md-1">
                                                <small>{{ $loop->iteration }}.</small>
                                            </div>
                                            <div class="col-md-11 mb-2">
                                                <small>{{ $contactData->contactDataType->name }}:</small> {{ $contactData->value }}
                                            </div>
                                        </div>
                                    </div>
                                    @empty
                                    <p>Δεν υπάρχουν εγγραφές.</p>
                                    @endforelse
                                </div>
                                <div class="dropdown-divider"></div>
                            </div>

                            <div class="tab-pane fade" role='tabpanel' aria-labelledby="pills-websites-tab" id="pills-websites">
                                <div class="card-body" id="websites">
                                    <h5 class="card-title"><img height="24" src="{{ asset('svg/earth.svg') }}" alt=""> Ιστοσελίδες@if ($canEdit) <a class="small" href="{{ route('profile.websites.index') }}"><img height="16" src="{{ asset('svg/pencil.svg') }}" alt=""></a>@endif</h5>
                                    <hr />

                                    @forelse ($user->websites as $website)
                                    @php($url = str_replace('[value]', $website->pivot->value, $website->url_pattern))
                                    <div class="card-text">
                                        <div class="row">
                                            <div class="col-md-1">
                                                <small>{{ $loop->iteration }}.</small>
                                            </div>
                                            <div class="col-md-11 mb-2">
                                                <small>{{ $website->name }}:</small> <a href='{{ $url }}' target="_blank">{{ $url }}</a>
                                            </div>
                                        </div>
                                    </div>
                                    @empty
                                    <p>Δεν υπάρχουν εγγραφές.</p>
                                    @endforelse
                                </div>
                            </div>

                            <div class="tab-pane fade" role='tabpanel' aria-labelledby="pills-adjectives-tab" id="pills-adjectives">
                                <div class="card-body" id="adjectives">
                                    <h5 class="card-title"><img height="24" src="{{ asset('svg/adjective.svg') }}" alt=""> Στοιχεία χαρακτήρα@if ($canEdit) <a class="small" href="{{ route('profile.adjectives.index') }}"><img height="16" src="{{ asset('svg/pencil.svg') }}" alt=""></a>@endif</h5>
                                    <hr />

                                    @forelse ($user->adjectives as $adjective)
                                    @if ($loop->iteration % 3 == 1)
                                    <div class="card-deck mb-3">
                                        @endif

                                        <div class="card">
                                            <div class="card-header text-center">
                                                <span class="btn btn-sm btn-info">{{ $user->id_gender == \App\Gender::MALE ? $adjective->name_male: $adjective->name_female }}</span>
                                            </div>
                                            <div class="card-body text-center">
                                                <p class="card-text">
                                                    {{ $user->id_gender == \App\Gender::MALE ? $adjective->description_male: $adjective->description_female }}
                                                </p>
                                            </div>
                                            <div class="card-footer">
                                                <small class="text-muted">Προστέθηκε: {{ $adjective->pivot->created_at }}</small>
                                            </div>
                                        </div>

                                        @if ($loop->iteration % 3 == 0 || $loop->last)
                                    </div>
                                    @endif
                                    @empty
                                    <p>Δεν υπάρχουν εγγραφές.</p>
                                    @endforelse
                                </div>
                            </div>

                            <div class="tab-pane fade" role='tabpanel' aria-labelledby="pills-favourites-tab" id="pills-favourites">
                                <div class="card-body" id="favourites">
                                    <h5 class="card-title"><img height="24" src="{{ asset('svg/favourite.svg') }}" alt=""> Λίστα αγαπημένων @if ($canEdit)<a class="small" href="{{ route('profile.favourites.index', ['user'=>$user->id]) }}"><img height="16" src="{{ asset('svg/pencil.svg') }}" alt=""></a>@endif</h5>
                                    <hr />

                                    <p>Αριθμός λιστών στις οποίες έχει προστεθεί ως αγαπημένος: {{ $favouritesInverseCount }}</p>

                                    @if (Auth::user() == $user)
                                    @forelse ($user->favourites as $favourite)
                                    <div class="mb-3">
                                        <small>{{ $loop->iteration }}.</small><br />
                                        <small>Τύπος χρήστη:</small> {{ $favourite->userType->name }}<br />
                                        <small>Όνομα</small>:  <a href='{{ route('profile-show', ['user'=>$favourite->id]) }}'>{{ $favourite->name }}</a><br />
                                        <small>{{ $favourite->userType->id == App\UserType::TEACHER ? 'Διδάσκει τα μαθήματα:': 'Ενδιαφέρεται για τα μαθήματα' }}</small>
                                        @foreach ($favourite->courses as $course)
                                        {{ !$loop->last ? $course->name.', ': $course->name }}
                                        @endforeach
                                        <br />
                                        <small>{{ $favourite->userType->id == App\UserType::TEACHER ? 'Απευθύνεται σε:': 'Κατηγορία μαθητή' }}</small>
                                        @forelse ($favourite->targetGroups as $targetGroup)
                                        {{ !$loop->last ? $targetGroup->name.', ': $targetGroup->name }}
                                        @empty
                                        -
                                        @endforelse            
                                        <br />
                                        <small>{{ $favourite->userType->id == App\UserType::TEACHER ? 'Παρέχει τις εξής υπηρεσίες:': 'Επιθυμεί τις εξής υπηρεσίες:' }}</small>
                                        @forelse ($favourite->services as $service)
                                        {{ !$loop->last ? $service->name.', ': $service->name }}
                                        @empty
                                        -
                                        @endforelse
                                        <br />

                                        @if (count($favourite->postgraduates) > 0)
                                        <small>{{ $favourite->userType->id == App\UserType::TEACHER ? 'Διαθέτει ': 'Επιθυμεί ' }} μεταπτυχιακό τίτλο.</small><br />
                                        @endif
                                        @if (count($favourite->phds) > 0)
                                        <small>{{ $favourite->userType->id == App\UserType::TEACHER ? 'Διαθέτει ': 'Επιθυμεί ' }} διδακτορικό τίτλο.</small><br />
                                        @endif

                                    </div>
                                    @empty
                                    <p>Δεν έχετε προσθέσει κάποιο χρήστη στη λίστα με τους αγαπημένους σας.</p>
                                    <p>Υπενθυμίζεται ότι κάθε χρήστης που προσθέτει έναν άλλο στη λίστα αγαπημένων, τον/την βοηθάει να παίρνει επιπλέον minipoints όταν πραγματοποιούνται <a href="{{ route('points') }}">συγκεκριμένες ενέργειες</a>.</p>
                                    @endforelse
                                    @endif
                                </div>
                                <div class="dropdown-divider"></div>
                            </div>
                        </div>

                        <!-- Contact form -->
                        @guest
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12 text-md-right text-center">
                                    <a class="btn btn-outline-primary btn-sm" data-toggle="collapse" href="#contact-details" role="button" aria-expanded="false" aria-controls="contact-details">
                                        Επικοινωνία με {{ $user->name }}
                                    </a>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <div class="text-justify collapse" id='contact-details'>
                                        <p>Μπορείτε να επικοινωνήσετε με {{ $user->gender->id == 1 ? 'τον': 'την'}} miniteacher '{{ $user->name }}' κάνοντας <a href="{{ route('login') }}">είσοδο/εγγραφή</a> στο σύστημα ως miniteacher (εκπαιδευτικός) ή miniguest (επισκέπτης). Στην περίπτωση αυτή, αν δεν έχετε επικοινωνήσει άλλη φορά με {{ $user->gender->id == 1 ? 'το συγκεκριμένο ': 'τη συγκεκριμένη'}} miniteacher, θα {{ $user->gender->id == 1 ? 'του': 'της'}} προσφέρετε minipoints στην προσπάθειά {{ $user->gender->id == 1 ? 'του': 'της'}} να αναρριχηθεί υψηλότερα στις αναζητήσεις της πλατφόρμας.</p>
                                        <p>Εναλλακτικά, μπορείτε να δείτε στην καρτέλα 'Στοιχεία επικοινωνίας' αν παρέχει άλλο τρόπο επικοινωνίας (χωρίς την προσθήκη minipoints).</p>
                                    </div>
                                </div>
                            </div>       
                        </div>
                        @endguest
                        @auth
                        <div class="card-body">
                            @if(session()->has('message'))
                            <div class="alert alert-success small">
                                {{ session()->get('message') }}
                            </div>
                            @endif
                            @foreach ($errors->all() as $error)
                            <span class="text-danger">- {{ $error }}</span><br />
                            @endforeach
                        </div>
                        @endauth
                    </div>

                    <div class="col-md-4">
                        <div class="card-body">
                            <div>
                                @if ($user->picture)
                                <img class="img-thumbnail" src="{{ asset('uploads/users/'.$user->picture) }}" alt="" title="{{ $user->name }}">
                                @else
                                <img width="100%" class="img-thumbnail" src="{{ route('svg-user', ['user' => $user->id]) }}" alt="" title="{{ $user->name }}">
                                @endif
                            </div>
                            <div class="card bg-light mt-3">
                                <div class="card-header">
                                    <h6 class="card-title mb-0"><img src="{{ asset('svg/info.svg') }}" alt="" height="24"> Πληροφορίες</h6>
                                </div>
                                <div class="card-body">
                                    <div>
                                        <small>Όνομα</small><br />
                                        {{ $user->name }}
                                    </div>
                                    <div class="mt-3" id="progress-bars">
                                        <div class="progress mb-2" style="height:25px;">
                                            <div class="progress-bar bg-primary" role="progressbar" style="width: 100%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">Επίπεδο {{ $user->userStat->level->id }}</div>
                                        </div>
                                        <div class="progress mb-2" style="height:25px;">
                                            <div class="progress-bar bg-success" role="progressbar" style="width: 100%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">{{ $user->gender->id == 1 ? $user->userStat->level->name_male: $user->userStat->level->name_female }}</div>
                                        </div>
                                        <div class="progress mb-2" style="height:25px;">
                                            <div class="progress-bar bg-info text-dark" role="progressbar" style="width: {{ $user->userStat->percent }}%;" aria-valuenow="{{ $user->userStat->percent }}" aria-valuemin="0" aria-valuemax="100">minipoints: {{ $user->userStat->points }} από {{ $nextLevel->points_needed }} ({{ $user->userStat->percent }}%)</div>
                                        </div>
                                    </div>

                                    <div class="text-center">
                                        <small>Συνολικές προβολές προφίλ: <span class="badge badge-info">{{ $user->totalViews }}</span></small><br />
                                        <small class="text-muted">Από επισκέπτες: <span class="badge badge-light">{{ $user->totalViewsByGuests }}</span></small><br />
                                        <small class="text-muted">Από miniusers: <span class="badge badge-light">{{ $user->totalViewsByMiniUsers }}</span></small>
                                    </div>
                                </div>

                                <div class="card-body text-center">
                                    <a target="_blank" class="btn btn-outline-info btn-sm btn-block" href="https://www.facebook.com/sharer/sharer.php?u={{ url()->current() }}&display=popup">
                                        Κοινοποίηση στο Facebook
                                    </a>

                                    @auth
                                    <form class="mt-3" method="post" action="{{ route('update-favourites', ['user'=>$user]) }}">
                                        @csrf
                                        @method('put')
                                        @if (Auth::user()->favourites->contains($user))
                                        <button class="btn btn-sm btn-outline-danger btn-block">Αφαίρεση από τους αγαπημένους</button
                                        @else
                                        <button class="btn btn-sm btn-outline-danger btn-block">Προσθήκη στους αγαπημένους</button>
                                        @endif
                                    </form>

                                    @if (Auth::user()->id != $user->id)
                                    <a class="mt-3 btn btn-sm btn-outline-primary btn-block" href="{{ route('conversations.create', ['recipient'=>$user->id]) }}">Αποστολή μηνύματος</a>
                                    @endif
                                    @endauth

                                    @guest
                                    <a class="mt-3 btn btn-sm btn-outline-primary btn-block" href="{{ route('login') }}">Αποστολή μηνύματος</a>
                                    @endguest
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
</div>
@endsection

