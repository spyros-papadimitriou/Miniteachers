@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h5><img src="{{ asset('svg/analytics.svg') }}" height="32" alt=''> Analytics</h5>
            <hr />
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 text-sm-center text-md-left mb-3">
            <button type="button" class="btn btn-outline-primary btn-sm" data-toggle="modal" data-target="#searchModal">
                Επιλογή κριτηρίων αναζήτησης
            </button>

            <a type="button" class="btn btn-outline-success btn-sm" href="{{ route('analytics-popular') }}">
                Δημοφιλείς αναζητήσεις
            </a>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-md-12">
            @if (empty($criteria->id))
            <div class="col-md-3 offset-lg-9 mt-3">
                @tip(analytics)
            </div>
            @else

            @if (!empty($criteria->userType))
            <span class="badge badge-info">Τύπος χρήστη: {{ $criteria->userType->name }}</span>
            @endif
            @if (!empty($criteria->name))
            <span class="badge badge-info">Όνομα: {{ $criteria->name }}</span>
            @endif
            @if (!empty($criteria->gender))
            <span class="badge badge-info">{{ $criteria->gender->name }}</span>
            @endif
            @if (!empty($criteria->ageRange))
            <span class="badge badge-info">{{ $criteria->ageRange->description }}</span>
            @endif
            @if (!empty($criteria->municipality))
            <span class="badge badge-info">{{ $criteria->municipality->name }} ({{ $criteria->municipality->regionalUnit->name }})</span>
            @endif
            @if (!empty($criteria->price_from))
            <span class="badge badge-primary">Από {{ $criteria->price_from }}&euro;</span>
            @endif
            @if (!empty($criteria->price_to))
            <span class="badge badge-primary">Έως {{ $criteria->price_to }}&euro;</span>
            @endif
            @if (!empty($criteria->experience))
            <span class="badge badge-primary">Εμπειρία: {{ $criteria->experience->name }}</span>
            @endif
            @if (!empty($criteria->targetGroup))
            <span class="badge badge-primary">{{ $criteria->targetGroup->name }}</span>
            @endif

            @if ($criteria->courses)
            @foreach ($criteria->courses as $course)
            <span class="badge badge-success">{{ $course->name }} ({{ $course->courseCategory->name }})</span>
            @endforeach                
            @endif

            @if ($criteria->services)
            @foreach ($criteria->services as $service)
            <span class="badge badge-success">{{ $service->name }}</span>
            @endforeach                
            @endif

            @if ($criteria->departments)
            @foreach ($criteria->departments as $department)
            <span class="badge badge-secondary">{{ $department->name }} ({{ $department->school->institution->name }})</span>
            @endforeach
            @endif
            @if (!empty($criteria->postgraduate))
            <span class="badge badge-secondary">Μεταπτυχιακός τίτλος: ναι</span>
            @endif
            @if (!empty($criteria->phd))
            <span class="badge badge-secondary">Διδακτορικός τίτλος: ναι</span>
            @endif
            @if ($criteria->websites)
            @foreach ($criteria->websites as $website)
            <span class="badge badge-light">{{ $website->name }}</span>
            @endforeach
            @endif
            @if ($criteria->adjectives)
            @foreach ($criteria->adjectives as $adjective)
            <span class="badge badge-info">{{ $adjective->name_male }} ή {{ $adjective->name_female }}</span>
            @endforeach
            @endif

            <a class="badge badge-danger" href="{{ route('analytics') }}">Καθαρισμός</a>
            @endif
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
                                            <div class="custom-control custom-checkbox">

                                                <input type="radio" class="custom-control-input" id="userType0" name="userType" value="0"{{ $criteria->userType == null? ' checked': null }}>
                                                <label class="custom-control-label small text-muted" for="userType0">Αδιάφορο</label>
                                            </div>
                                            @foreach ($userTypes as $userType)
                                            <div class="custom-control custom-checkbox">
                                                <input type="radio" class="custom-control-input" id="userType{{ $userType->id }}" name="userType" value="{{ $userType->id }}"{{ $criteria->userType == $userType ? ' checked': null }}>
                                                <label class="custom-control-label small" for="userType{{ $userType->id }}">{{ $userType->name }}</label>
                                            </div>
                                            @endforeach
                                            <hr />

                                            <div class="form-group">
                                                <label for="name" class="small">Όνομα χρήστη</label>
                                                <input maxlength="64" type="text" class="form-control form-control-sm" id="name" name="name" value="{{ $criteria->name }}">
                                            </div>
                                            <hr />
                                            <div class="form-group">
                                                <label for="priceFrom" class="small">Τιμή από</label>
                                                <input type="number" class="form-control form-control-sm" id="priceFrom" name="priceFrom" value="{{ $criteria->price_from }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="priceTo" class="small">Τιμή έως</label>
                                                <input type="number" class="form-control form-control-sm" id="priceTo" name="priceTo" value="{{ $criteria->price_to }}">
                                            </div>

                                            <hr />
                                            <div class="small">Φύλο</div>
                                            <div class="custom-control custom-checkbox">
                                                <input type="radio" class="custom-control-input" checked="" id="gender0" name="gender" value="0">
                                                <label class="custom-control-label small text-muted" for="gender0">Αδιάφορο</label>
                                            </div>
                                            @foreach ($genders as $gender)
                                            <div class="custom-control custom-checkbox">
                                                <input type="radio" class="custom-control-input" id="gender{{ $gender->id }}" name="gender" value="{{ $gender->id }}"{{ $criteria->gender == $gender ? ' checked': null }}>
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
                                                <input type="radio" class="custom-control-input" id="ageRange{{ $ageRange->id }}" name="ageRange" value="{{ $ageRange->id }}"{{ $criteria->ageRange == $ageRange ? ' checked': null }}>
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
                                                <input type="radio" class="custom-control-input" id="experience{{ $experience->id }}" name="experience" value="{{ $experience->id }}"{{ $criteria->experience == $experience ? ' checked': null }}>
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
                                                <input type="radio" class="custom-control-input" id="targetGroup{{ $targetGroup->id }}" name="targetGroup" value="{{ $targetGroup->id }}"{{ $criteria->targetGroup == $targetGroup ? ' checked': null }}>
                                                <label class="custom-control-label small" for="targetGroup{{ $targetGroup->id }}">{{ $targetGroup->name }}</label>
                                            </div>
                                            @endforeach

                                            @if (count($services) > 0)
                                            <hr />
                                            <div class="small">Υπηρεσίες</div>
                                            @foreach ($services as $service)
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="service{{ $service->id }}" name="services[]" value="{{ $service->id }}"{{ !empty(old('services')) && in_array($service->id, old('services')) ? ' checked': null }}>
                                                       <label class="custom-control-label small" for="service{{ $service->id }}">{{ $service->name }}</label>
                                            </div>
                                            @endforeach
                                            @endif
                                        </div>

                                        <div class="col-md-6">
                                            <div class="small">Μαθήματα</div>
                                            <select class="custom-select small" size="10" name="courses[]" multiple>
                                                <option value="0" class="text-muted small">Αδιάφορο</option>
                                                @foreach ($courseCategories as $courseCategory)
                                                <optgroup class="small" label="{{ $courseCategory->name }}">
                                                    @foreach ($courseCategory->courses as $course)
                                                    <option value="{{ $course->id }}"{{ !empty(old('courses')) && in_array($course->id, old('courses')) ? ' selected': null }}>{{ $course->name }}</option>
                                                    @endforeach
                                                </optgroup>                     
                                                @endforeach
                                            </select>
                                            <p class="text-muted small">Κρατήστε πατημένο το πλήκτρο CTRL ώστε να επιλέξετε παραπάνω από ένα μαθήματα.</p>

                                            <hr />
                                            <div class="small">Δήμος</div>
                                            <select class="custom-select small" size="10" name="municipality">
                                                <option value="0" class="text-muted small">Αδιάφορο</option>
                                                @foreach ($regions as $region)
                                                @foreach ($region->regionalUnits as $regionalUnit)
                                                <optgroup class="small" label="{{ $regionalUnit->name }}">
                                                    @foreach ($regionalUnit->municipalities as $municipality)
                                                    <option value="{{ $municipality->id }}"{{ !empty(old('municipality')) && old('municipality') == $municipality->id ? ' selected': null }}>{{ $municipality->name }}</option>
                                                    @endforeach
                                                </optgroup>
                                                @endforeach                        
                                                @endforeach
                                            </select>

                                            <hr />
                                            <div class="small">Προπτυχιακές σπουδές</div>
                                            <select class="custom-select small" multiple size="10" name="departments[]">
                                                @foreach ($institutions as $institution)
                                                @foreach ($institution->schools as $school)
                                                <optgroup class="small" label="{{ $institution->name }} - {{ $school->name }}">
                                                    @foreach ($school->departments as $department)
                                                    <option value="{{ $department->id }}"{{ !empty(old('departments')) && in_array($department->id, old('departments')) ? ' selected': null }}>{{ $department->name }}</option>
                                                    @endforeach
                                                </optgroup>
                                                @endforeach                        
                                                @endforeach
                                            </select>
                                            <p class="text-muted small">Κρατήστε πατημένο το πλήκτρο CTRL ώστε να επιλέξετε παραπάνω από ένα Τμήματα.</p>

                                            <hr />
                                            <div class="small">Επιπλέον τίτλοι σπουδών</div>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="postgraduate" name="postgraduate" value="1"{{ $criteria->postgraduate != 0 ? ' checked': null }}>
                                                <label class="custom-control-label small" for="postgraduate">Μεταπτυχιακός τίτλος</label>
                                            </div>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="phd" name="phd" value="1"{{ $criteria->phd != 0 ? ' checked': null }}>
                                                <label class="custom-control-label small" for="phd">Διδακτορικός τίτλος</label>
                                            </div>

                                            @if (count($websites) > 0)
                                            <hr />
                                            <div class="small">Ιστοσελίδες</div>
                                            @foreach ($websites as $website)
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="website{{ $website->id }}" name="websites[]" value="{{ $website->id }}"{{ !empty(old('websites')) && in_array($website->id, old('websites')) ? ' checked': null }}>
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
                                           <input type="checkbox" class="custom-control-input" id="adjective{{ $adjective->id }}" name="adjectives[]" value="{{ $adjective->id }}"{{ !empty(old('adjectives')) && in_array($adjective->id, old('adjectives')) ? ' checked': null }}>
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
                                <div class="col-md-6 text-md-left text-sm-center mb-3">
                                    <button type="submit" class="btn btn-primary btn-sm">Αναζήτηση</button>
                                </div>
                                <div class="col-md-6 text-md-right text-sm-center">
                                    <a href="{{ route('analytics') }}" class="btn btn-outline-danger btn-sm">Καθαρισμός</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>            
            </div>
        </div>
    </div>
</div>


<div class="container-fluid">
    @if (isset($searches))
    <div class="row">
        <div class="col-md-12">
                                                         <p>Συνολικά αποτελέσματα: {{ $searches->total() }}</p>
                                               @if (count($searches) > 0)
                                               <table class="table small table-striped table-hover table-sm">
                                                   <thead class="thead-light">
                                                       <tr>
                                                           <th>&nbsp;</th>
                                                           <th>Ημ/νία αναζήτησης</th>
                                                           <th>Αναζήτηση από</th>
							   @admin
							   <th>IP</th>
							   <th>User Agent</th>
							   @endadmin
                                                           <th>Τύπος χρήστη</th>
                                                           <th>Φύλο</th>
                                                           <th>Ηλικιακό φάσμα</th>
                                                           <th>Εμπειρία</th>
                                                           <th>Δήμος</th>
                                                           <th>Περιφερειακή ενότητα</th>
                                                           <th>Κατηγορία μαθητών</th>
                                                           <th>Μαθήματα</th>
                                                           <th>Όνομα</th>
                                                           <th>Τιμή από</th>
                                                           <th>Τιμή έως</th>
                                                           <th>Προπτυχιακές σπουδές</th>
                                                           <th>Μεταπτυχιακό</th>
                                                           <th>Διδακτορικό</th>
                                                           <th>Υπηρεσίες</th>
                                                           <th>Ιστοσελίδες</th>
                                                           <th>Στοιχεία χαρακτήρα</th>
                                                       </tr>
                                                   </thead>
                                                   @foreach ($searches as $search)
                                                   <tr>
                                                       <td><span class="badge badge-primary">{{ ($searches ->currentpage()-1) * $searches ->perpage() + $loop->index + 1 }}</span></td>
                                                       <td>{{ $search->created_at }}</td>
                                                       <td>{{ $search->user != null ? $search->user->userType->name: 'επισκέπτης'}}</td>
							@admin
							<td>{{ $search->ip }}</td>
							<td>{{ $search->user_agent }}</td>
							@endadmin
                                                       <td>{{ $search->userType->name ?? '-' }}</td>
                                                       <td>{{ $search->gender->name ?? '-' }}</td>
                                                       <td>{{ $search->ageRange->description ?? '-' }}</td>
                                                       <td>{{ $search->experience->name ?? '-' }}</td>
                                                       <td>{{ $search->municipality->name ?? '-' }}</td>
                                                       <td>{{ $search->regionalUnit->name ?? '-' }}</td>
                                                       <td>{{ $search->targetGroup->name ?? '-' }}</td>
                                                       <td>
                                                           @forelse ($search->courses as $course)
                                                           @if (!$loop->last)
                                                           - {{ $course->name }}<br />
                                                           @else
                                                           - {{ $course->name }}
                                                           @endif
                                                           @empty
                                                           -
                                                           @endforelse
                                                       </td>
                                                       <td>{{ $search->name }}</td>
                                                       <td>{{ $search->price_from }}</td>
                                                       <td>{{ $search->price_to }}</td>
                                                       <td>
                                                           @forelse ($search->departments as $department)
                                                           @if (!$loop->last)
                                                           - {{ $department->name }} ({{ $department->school->institution->name }})<br />
                                                           @else
                                                           - {{ $department->name }} ({{ $department->school->institution->name }})
                                                           @endif
                                                           @empty
                                                           -
                                                           @endforelse
                                                       </td>
                                                       <td class="text-center">{!! $search->postgraduate == 1 ? '<img height="16" src="'.asset('svg/yes.svg').'" alt="">': '-' !!}</td>
                                                       <td class="text-center">{!! $search->phd == 1 ? '<img height="16" src="'.asset('svg/yes.svg').'" alt="">': '-' !!}</td>
                                                       <td>
                                                           @forelse ($search->services as $service)
                                                           @if (!$loop->last)
                                                           - {{ $service->name }}<br />
                                                           @else
                                                           - {{ $service->name }}
                                                           @endif
                                                           @empty
                                                           -
                                                           @endforelse
                                                       </td>
                                                       <td>
                                                           @forelse ($search->websites as $website)
                                                           @if (!$loop->last)
                                                           - {{ $website->name }}<br />
                                                           @else
                                                           - {{ $website->name }}
                                                           @endif
                                                           @empty
                                                           -
                                                           @endforelse
                                                       </td>
                                                       <td>
                                                           @forelse ($search->adjectives as $adjective)
                                                           @if (!$loop->last)
                                                           - {{ $adjective->name_male }} ή {{ $adjective->name_female }}<br />
                                                           @else
                                                           - {{ $adjective->name_male }} ή {{ $adjective->name_female }}
                                                           @endif
                                                           @empty
                                                           -
                                                           @endforelse
                                                       </td>
                                                   </tr>
                                                   @endforeach
                                               </table>
                                               @else
                                               <p>Δε βρέθηκαν εγγραφές.</p>
                                               @endif
                                               <div class="small">{{ $searches->appends(request()->query())->links() }}</div>

                                       </div>
                                            </div>
                                            @endif
                                    </div>
                                    @endsection
