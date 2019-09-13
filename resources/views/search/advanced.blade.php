@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h5><img src="{{ asset('svg/search.svg') }}" height="32" alt=''> Σύνθετη αναζήτηση</h5>
            <hr />
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-md-12 text-sm-center text-md-left">
            <button type="button" class="btn btn-outline-primary btn-sm" data-toggle="modal" data-target="#searchModal">
                Επιλογή κριτηρίων αναζήτησης
            </button>
            <div class="mt-3">
                @if (empty($search->id))
                <div class="col-md-3 offset-lg-9 mt-3">
                    @tip(search-advanced)
                </div>
                @else

                @if (!empty($search->userType))
                <span class="badge badge-info">Τύπος χρήστη: {{ $search->userType->name }}</span>
                @endif
                @if (!empty($search->name))
                <span class="badge badge-info">Όνομα: {{ $search->name }}</span>
                @endif
                @if (!empty($search->gender))
                <span class="badge badge-info">{{ $search->gender->name }}</span>
                @endif
                @if (!empty($search->ageRange))
                <span class="badge badge-info">{{ $search->ageRange->description }}</span>
                @endif
                @if (!empty($search->municipality))
                <span class="badge badge-info">{{ $search->municipality->name }} ({{ $search->municipality->regionalUnit->name }})</span>
                @endif
                @if (!empty($search->price_from))
                <span class="badge badge-primary">Από {{ $search->price_from }}&euro;</span>
                @endif
                @if (!empty($search->price_to))
                <span class="badge badge-primary">Έως {{ $search->price_to }}&euro;</span>
                @endif
                @if (!empty($search->experience))
                <span class="badge badge-primary">Εμπειρία: {{ $search->experience->name }}</span>
                @endif
                @if (!empty($search->targetGroup))
                <span class="badge badge-primary">{{ $search->targetGroup->name }}</span>
                @endif
                @if ($search->courses->count())
                @foreach ($search->courses as $course)
                <span class="badge badge-success">{{ $course->name }} ({{ $course->courseCategory->name }})</span>
                @endforeach                
                @endif
                @if ($search->services->count())
                @foreach ($search->services as $service)
                <span class="badge badge-success">{{ $service->name }}</span>
                @endforeach                
                @endif
                @if ($search->departments->count())
                @foreach ($search->departments as $department)
                <span class="badge badge-secondary">{{ $department->name }} ({{ $department->school->institution->name }})</span>
                @endforeach
                @endif
                @if (!empty($search->postgraduate))
                <span class="badge badge-secondary">Μεταπτυχιακός τίτλος: ναι</span>
                @endif
                @if (!empty($search->phd))
                <span class="badge badge-secondary">Διδακτορικός τίτλος: ναι</span>
                @endif
                @if ($search->websites->count())
                @foreach ($search->websites as $website)
                <span class="badge badge-light">{{ $website->name }}</span>
                @endforeach
                @endif
                @if ($search->adjectives->count())
                @foreach ($search->adjectives as $adjective)
                <span class="badge badge-primary">{{ $adjective->name_male }} ή {{ $adjective->name_female }} </span>
                @endforeach
                @endif

                <a class="badge badge-danger" href="{{ route('search') }}">Καθαρισμός</a>
                @endif
            </div>
        </div>

        <div class="modal fade" id="searchModal" tabindex="-1" role="dialog" aria-labelledby="searchModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <form method="get" id="searchForm">
                        <div class="modal-header">
                            <h5 class="modal-title">Κριτήρια Αναζήτησης</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">                    
                            <input type="hidden" name="submitted" value="1">
                            <div class="row">  
                                <div class="col-md-12">

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="small">Τύπος χρήστη</div>
                                            @foreach ($userTypes as $userType)
                                            <div class="custom-control custom-checkbox">
                                                <input type="radio" class="custom-control-input" id="userType{{ $userType->id }}" name="userType" value="{{ $userType->id }}"{{ $search->userType == $userType ? ' checked': null }}>
                                                <label class="custom-control-label small" for="userType{{ $userType->id }}">{{ $userType->name }}</label>
                                            </div>
                                            @endforeach
                                            <hr />

                                            <div class="form-group">
                                                <label for="name" class="small">Όνομα χρήστη</label>
                                                <input maxlength="64" type="text" class="form-control form-control-sm" id="name" name="name" value="{{ $search->name }}">
                                            </div>
                                            <hr />
                                            <div class="form-group">
                                                <label for="priceFrom" class="small">Τιμή από</label>
                                                <input type="number" class="form-control form-control-sm" id="priceFrom" name="priceFrom" value="{{ $search->price_from }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="priceTo" class="small">Τιμή έως</label>
                                                <input type="number" class="form-control form-control-sm" id="priceTo" name="priceTo" value="{{ $search->price_to }}">
                                            </div>

                                            <hr />
                                            <div class="small">Φύλο</div>
                                            <div class="custom-control custom-checkbox">
                                                <input type="radio" class="custom-control-input" checked="" id="gender0" name="gender" value="0">
                                                <label class="custom-control-label small text-muted" for="gender0">Αδιάφορο</label>
                                            </div>
                                            @foreach ($genders as $gender)
                                            <div class="custom-control custom-checkbox">
                                                <input type="radio" class="custom-control-input" id="gender{{ $gender->id }}" name="gender" value="{{ $gender->id }}"{{ $search->gender == $gender ? ' checked': null }}>
                                                <label class="custom-control-label small" for="gender{{ $gender->id }}">{{ $gender->name }}</label>
                                            </div>
                                            @endforeach

                                            <hr />
                                            <div class="small">Ηλικία</div>
                                            <div class="custom-control custom-checkbox">
                                                <input type="radio" class="custom-control-input" checked="" id="ageRange0" name="ageRange" value="0">
                                                <label class="custom-control-label small text-muted" for="ageRange0">Αδιάφορο</label>
                                            </div>
                                            @foreach ($ageRanges as $ageRange)
                                            <div class="custom-control custom-checkbox">
                                                <input type="radio" class="custom-control-input" id="ageRange{{ $ageRange->id }}" name="ageRange" value="{{ $ageRange->id }}"{{ $search->ageRange == $ageRange ? ' checked': null }}>
                                                <label class="custom-control-label small" for="ageRange{{ $ageRange->id }}">{{ $ageRange->description }}</label>
                                            </div>
                                            @endforeach

                                            <hr />
                                            <div class="small">Εμπειρία</div>
                                            <div class="custom-control custom-checkbox">
                                                <input type="radio" class="custom-control-input" checked="" id="experience0" name="experience" value="0">
                                                <label class="custom-control-label small text-muted" for="experience0">Αδιάφορο</label>
                                            </div>
                                            @foreach ($experiences as $experience)
                                            <div class="custom-control custom-checkbox">
                                                <input type="radio" class="custom-control-input" id="experience{{ $experience->id }}" name="experience" value="{{ $experience->id }}"{{ $search->experience == $experience ? ' checked': null }}>
                                                <label class="custom-control-label small" for="experience{{ $experience->id }}">{{ $experience->name }}</label>
                                            </div>
                                            @endforeach

                                            <hr />
                                            <div class="small">Απευθύνομαι σε</div>
                                            <div class="custom-control custom-checkbox">
                                                <input type="radio" class="custom-control-input" checked="" id="targetGroup0" name="targetGroup" value="0">
                                                <label class="custom-control-label small text-muted" for="targetGroup0">Αδιάφορο</label>
                                            </div>
                                            @foreach ($targetGroups as $targetGroup)
                                            <div class="custom-control custom-checkbox">
                                                <input type="radio" class="custom-control-input" id="targetGroup{{ $targetGroup->id }}" name="targetGroup" value="{{ $targetGroup->id }}"{{ $search->targetGroup == $targetGroup ? ' checked': null }}>
                                                <label class="custom-control-label small" for="targetGroup{{ $targetGroup->id }}">{{ $targetGroup->name }}</label>
                                            </div>
                                            @endforeach

                                            @if (count($services) > 0)
                                            <hr />
                                            <div class="small">Υπηρεσίες</div>
                                            @foreach ($services as $service)
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="service{{ $service->id }}" name="services[]" value="{{ $service->id }}"{{ $search->services->contains($service) ? ' checked': null }}>
                                                <label class="custom-control-label small" for="service{{ $service->id }}">{{ $service->name }}</label>
                                            </div>
                                            @endforeach
                                            @endif
                                        </div>

                                        <div class="col-md-6">
                                            <div class="small">Μαθήματα</div>
                                            <select class="custom-select" size="10" name="courses[]" multiple>
                                                <option value="0" class="text-muted small">Αδιάφορο</option>
                                                @foreach ($courseCategories as $courseCategory)
                                                <optgroup class="small" label="{{ $courseCategory->name }}">
                                                    @foreach ($courseCategory->courses as $course)
                                                    <option value="{{ $course->id }}"{{ $search->courses->contains($course) ? ' selected': null }}>{{ $course->name }}</option>
                                                    @endforeach
                                                </optgroup>                     
                                                @endforeach
                                            </select>
                                            <p class="text-muted small">Κρατήστε πατημένο το πλήκτρο CTRL ώστε να επιλέξετε παραπάνω από ένα μαθήματα.</p>

                                            <hr />
                                            <div class="small">Δήμος</div>
                                            <select class="custom-select" size="10" name="municipality">
                                                <option value="0" class="text-muted small">Αδιάφορο</option>
                                                @foreach ($regions as $region)
                                                @foreach ($region->regionalUnits as $regionalUnit)
                                                <optgroup class="small" label="{{ $regionalUnit->name }}">
                                                    @foreach ($regionalUnit->municipalities as $municipality)
                                                    <option value="{{ $municipality->id }}"{{ $search->id_municipality == $municipality->id ? ' selected': null }}>{{ $municipality->name }}</option>
                                                    @endforeach
                                                </optgroup>
                                                @endforeach                        
                                                @endforeach
                                            </select>

                                            <hr />
                                            <div class="small">Προπτυχιακές σπουδές</div>
                                            <select class="custom-select" multiple size="10" name="departments[]">
                                                @foreach ($institutions as $institution)
                                                @foreach ($institution->schools as $school)
                                                <optgroup class="small" label="{{ $institution->name }} - {{ $school->name }}">
                                                    @foreach ($school->departments as $department)
                                                    <option value="{{ $department->id }}"{{ $search->departments->contains($department) ? ' selected': null }}>{{ $department->name }}</option>
                                                    @endforeach
                                                </optgroup>
                                                @endforeach                        
                                                @endforeach
                                            </select>
                                            <p class="text-muted small">Κρατήστε πατημένο το πλήκτρο CTRL ώστε να επιλέξετε παραπάνω από ένα Τμήματα.</p>

                                            <hr />
                                            <div class="small">Επιπλέον τίτλοι σπουδών</div>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="postgraduate" name="postgraduate" value="1"{{ $search->postgraduate != 0 ? ' checked': null }}>
                                                <label class="custom-control-label small" for="postgraduate">Μεταπτυχιακός τίτλος</label>
                                            </div>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="phd" name="phd" value="1"{{ $search->phd != 0 ? ' checked': null }}>
                                                <label class="custom-control-label small" for="phd">Διδακτορικός τίτλος</label>
                                            </div>

                                            @if (count($websites) > 0)
                                            <hr />
                                            <div class="small">Ιστοσελίδες</div>
                                            @foreach ($websites as $website)
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="website{{ $website->id }}" name="websites[]" value="{{ $website->id }}"{{ $search->websites->contains($website) ? ' checked': null }}>
                                                <label class="custom-control-label small" for="website{{ $website->id }}">{{ $website->name }}</label>
                                            </div>
                                            @endforeach
                                            @endif

                                            @if (count($adjectives) > 0)
                                            <hr />
                                            <div class="small">Στοιχεία χαρακτήρα</div>
                                            <div class="overflow-auto" style="max-height: 200px;">
                                            @foreach ($adjectives as $adjective)
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="adjective{{ $adjective->id }}" name="adjectives[]" value="{{ $adjective->id }}"{{ $search->adjectives->contains($adjective) ? ' checked': null }}>
                                                <label class="custom-control-label small" for="adjective{{ $adjective->id }}">{{ $adjective->name_male }} ή {{ $adjective->name_female }}</label>
                                            </div>
                                            @endforeach
                                            </div>
                                            @endif

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-6 text-sm-center text-md-left mb-3">
                                    <button type="submit" class="btn btn-primary btn-sm">Αναζήτηση</button>
                                </div>
                                <div class="col-md-6 text-md-right text-sm-center">
                                    <a href="{{ route('search') }}" class="btn btn-outline-danger btn-sm">Καθαρισμός</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>            
            </div>
        </div>
    </div>

    @includeWhen($users, 'search.users', ['valid' => 1])
</div>
@endsection