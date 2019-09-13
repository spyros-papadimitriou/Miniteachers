@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h5><img src='{{ asset('svg/gdpr2.svg') }}' height="32" alt=''> <a href="{{ route('gdpr-index') }}">GDPR - Δικαιώματα</a> &raquo; Άσκηση Δικαιώματος Πρόσβασης  <small>(Right of access)</small></h5>
            <hr />
        </div>
        <div class="col-md-4 text-md-right text-sm-center">
            <a target="_blank" href="{{ route('gdpr-export-data') }}" class="btn btn-sm btn-outline-success">
                Εξαγωγή δεδομένων
            </a>
        </div>

        <div class="col-md-9">
            <div class="row mb-3">
                <div class="col-md-6">
                    <h6 class="font-weight-bold">Βασικά στοιχεία</h6>
                    <small>Τύπος χρήστη:</small> {{ $user->userType->name }}<br />
                    <small>Φύλο:</small> {{ $user->gender->name }}<br />
                    <small>E-mail:</small> {{ $user->email }}<br />
                    <small>Επιβεβαιωμένο προφίλ:</small> {{ $user->confirmed == 1 ? 'Ναι': 'Όχι' }}<br />
                    <small>Ημ/νία γέννησης:</small> {{ $user->birthdate }}<br />
                    <small>Τελευταία είσοδος:</small> {{ $user->login_date }}<br />
                    <small>Εικόνα:</small> {{ $user->picture }}<br />
                    <small>Ημ/νία δημιουργίας:</small> {{ $user->created_at }}<br />
                    <small>Ημ/νία τελευταίας τροποποίησης:</small> {{ $user->updated_at }}<br />
                    <hr />

                    <h6 class="font-weight-bold">Επιπλέον πληροφορίες (ελεύθερο κείμενο)</h6>
                    @foreach ($user->extras as $extra)
                    <small>{{ $loop->iteration }}.</small><br />
                    <small>{{ $extra->description }}</small><br />
                    {{ $extra->pivot->content }}<br />
                    <small>Ημ/νία δημιουργίας:</small> {{ $extra->pivot->created_at }}<br />
                    <small>Ημ/νία τελευταίας τροποποίησης:</small> {{ $extra->pivot->updated_at }}<br />
                    <hr />
                    @endforeach

                    <h6 class="font-weight-bold">Προπτυχιακές σπουδές</h6>
                    @foreach ($user->departments as $department)
                    <small>{{ $loop->iteration }}.</small><br />
                    <small>Τμήμα:</small> {{ $department->name }}<br />
                    <small>Σχολή:</small> {{ $department->school->name }}<br />
                    <small>Εκπαιδευτικό Ίδρυμα:</small>{{ $department->school->institution->name }}<br >
                    <small>Έτος αποφοίτησης:</small>{{ $department->pivot->endyear }}<br />
                    <small>Ημ/νία δημιουργίας:</small> {{ $department->pivot->created_at }}<br />
                    <small>Ημ/νία τελευταίας τροποποίησης:</small> {{ $department->pivot->updated_at }}<br />
                    <hr />
                    @endforeach

                    <h6 class="font-weight-bold">Μεταπτυχιακές σπουδές</h6>
                    @foreach ($user->postgraduates as $postgraduate)
                    <small>{{ $loop->iteration }}.</small><br />
                    <small>Τίτλος μεταπτυχιακού:</small> {{ $postgraduate->name }}<br />
                    <small>Έτος αποφοίτησης:</small> {{ $postgraduate->endyear }}<br />
                    <small>Ημ/νία δημιουργίας:</small> {{ $postgraduate->created_at }}<br />
                    <small>Ημ/νία τελευταίας τροποποίησης:</small> {{ $postgraduate->updated_at }}<br />
                    <hr />
                    @endforeach            

                    <h6 class="font-weight-bold">Διδακτορικές σπουδές</h6>
                    @foreach ($user->phds as $phd)
                    <small>{{ $loop->iteration }}.</small><br />
                    <small>Τίτλος διατριβής:</small> {{ $phd->name }}<br />
                    <small>Έτος αποφοίτησης:</small> {{ $phd->endyear }}<br />
                    <small>Ημ/νία δημιουργίας:</small> {{ $phd->created_at }}<br />
                    <small>Ημ/νία τελευταίας τροποποίησης:</small> {{ $phd->updated_at }}<br />
                    <hr />
                    @endforeach

                    <h6 class="font-weight-bold">Ιστοσελίδες</h6>
                    @foreach ($user->websites as $website)
                    @php($url = str_replace('[value]', $website->pivot->value, $website->url_pattern))
                    <small>{{ $loop->iteration }}.</small><br />
                    <small>{{ $website->name }}:</small> <a target="_blank" href="{{ $url }}">{{ $url }}</a><br />
                    <small>Ημ/νία δημιουργίας:</small> {{ $website->pivot->created_at }}<br />
                    <small>Ημ/νία τελευταίας τροποποίησης:</small> {{ $website->pivot->updated_at }}<br />
                    <hr />
                    @endforeach
                    
                    <h6 class="font-weight-bold">Στοιχεία χαρακτήρα</h6>
                    @foreach ($user->adjectives as $adjective)
                    <small>{{ $loop->iteration }}.</small><br />
                    <small>{{ $user->id_gender == \App\Gender::MALE ? $adjective->name_male: $adjective->name_female }}</small><br />
                    <small>{{ $user->id_gender == \App\Gender::MALE ? $adjective->description_male: $adjective->description_female }}</small><br />
                    <small>Ημ/νία δημιουργίας:</small> {{ $adjective->pivot->created_at }}<br />
                    <small>Ημ/νία τελευταίας τροποποίησης:</small> {{ $adjective->pivot->updated_at }}<br />
                    <hr />
                    @endforeach
                </div>

                <div class="col-md-6">
                    <h6 class="font-weight-bold">Επιπλέον στοιχεία</h6>
                    <small>Εμπειρία:</small> {{ $user->userStat->experience->name }}<br />
                    <small>Επίπεδο:</small> {{ $user->gender->id == 1 ? $user->userStat->level->name_male: $user->userStat->level->name_female }}<br />
                    <small>Τιμή ανά ώρα:</small> {{ $user->userStat->price_per_hour }}<br />
                    <small>Σημερινές προβολές προφίλ:</small> {{ $user->userStat->todays_views }}<br />
                    <small>Συνολικές προβολές προφίλ:</small> {{ $user->userStat->total_views }}<br />
                    <small>Πόντοι:</small> {{ $user->userStat->points }}<br />
                    <small>Δημοσίευση προφίλ:</small> {{ $user->userStat->published == 1 ? 'Ναι': 'Όχι' }}<br />
                    <small>Ημ/νία δημιουργίας:</small> {{ $user->userStat->created_at }}<br />
                    <small>Ημ/νία τελευταίας τροποποίησης:</small> {{ $user->userStat->updated_at }}<br />

                    <hr />
                    <h6 class="font-weight-bold">Μαθήματα</h6>
                    @foreach ($user->courses as $course)
                    <small>{{ $loop->iteration }}.</small><br />
                    <small>Μάθημα:</small> {{ $course->name }}<br />
                    <small>Ημ/νία δημιουργίας:</small> {{ $course->pivot->created_at }}<br />
                    <small>Ημ/νία τελευταίας τροποποίησης:</small> {{ $course->pivot->updated_at }}<br />
                    <hr />
                    @endforeach

                    <h6 class="font-weight-bold">Κατηγορίες μαθητών</h6>
                    @foreach ($user->targetGroups as $targetGroup)
                    <small>{{ $loop->iteration }}.</small><br />
                    <small>Στόχος - Ομάδα:</small> {{ $targetGroup->name }}
                    <small>Ημ/νία δημιουργίας:</small> {{ $targetGroup->pivot->created_at }}<br />
                    <small>Ημ/νία τελευταίας τροποποίησης:</small> {{ $targetGroup->pivot->updated_at }}<br />
                    <hr />
                    @endforeach

                    <h6 class="font-weight-bold">Δήμοι</h6>
                    @foreach ($user->municipalities as $municipality)
                    <small>{{ $loop->iteration }}.</small><br />
                    <small>Δήμος:</small> {{ $municipality->name }}<br />
                    <small>Περιφερειακή Ενότητα:</small> {{ $municipality->regionalUnit->name }}<br />
                    <small>Περιφέρεια:</small> {{ $municipality->regionalUnit->region->name}}<br />
                    <small>Ημ/νία δημιουργίας:</small> {{ $municipality->pivot->created_at }}<br />
                    <small>Ημ/νία τελευταίας τροποποίησης:</small> {{ $municipality->pivot->updated_at }}<br />
                    <hr />
                    @endforeach

                    <h6 class="font-weight-bold">Υπηρεσίες</h6>
                    @foreach ($user->services as $service)
                    <small>{{ $loop->iteration }}.</small><br />
                    <small>Υπηρεσία:</small> {{ $service->name }}<br />
                    <small>Ημ/νία δημιουργίας:</small> {{ $service->pivot->created_at }}<br />
                    <small>Ημ/νία τελευταίας τροποποίησης:</small> {{ $service->pivot->updated_at }}<br />
                    <hr />
                    @endforeach
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-12">
                    <hr />
                    <h6 class="font-weight-bold">Συζητήσεις</h6>
                    @foreach ($user->conversations as $conversation)
                    @if ($loop->iteration % 2 == 1)
                    <div class="row">
                        @endif
                        <div class="col-md-6">
                            <small>{{ $loop->iteration }}.</small><br />
                            <small>Χρήστης που άνοιξε τη συζήτηση: {{ $conversation->user->name }}</small>
                            <small>
                                Συμμετέχοντες στη συζήτηση:
                                @foreach ($conversation->users as $participant)
                                {{ !$loop->last ? $participant->name.',': $participant->name }}
                                @endforeach
                            </small><br />
                            <small>Ημ/νία δημιουργίας:</small> {{ $conversation->created_at }}<br />
                            <small>Ημ/νία τελευταίας τροποποίησης:</small> {{ $conversation->updated_at }}<br />
                            <hr />
                            @foreach ($conversation->messages as $message)
                            <small>Μήνυμα {{ $loop->iteration }}.</small><br />
                            <small>Από: {{ $message->user->name }}</small><br />
                            <small>Περιεχόμενο: {{ $message->content}}</small><br />
                            <small>Ημ/νία δημιουργίας:</small> {{ $message->created_at }}<br />
                            <small>Ημ/νία τελευταίας τροποποίησης:</small> {{ $message->updated_at }}<br />
                            <hr />
                            @endforeach
                        </div>
                        @if ($loop->iteration % 2 == 0 || $loop->last)
                    </div>
                    @endif        
                    @endforeach
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-12">
                    <h6 class="font-weight-bold">Ιστορικό ενεργειών που δίνουν minipoints</h6>
                    @foreach ($user->userActions as $userAction)
                    @if ($loop->iteration % 2 == 1)
                    <div class="row">
                        @endif
                        <div class="col-md-6">
                            Ενέργεια {{ $loop->iteration }}.<br />
                            <small>Περιγραφή ενέργειας:</small> {{ $userAction->action->name }}<br />
                            <small>Εμπλεκόμενος χρήστης:</small> {{ !empty($userAction->otherUser) ? $userAction->otherUser->name: '-'  }}<br />
                            <small>minipoints:</small> {{ $userAction->points }}<br />
                            <small>Ημ/νία δημιουργίας:</small> {{ $userAction->created_at }}<br />
                            <small>Ημ/νία τελευταίας τροποποίησης:</small> {{ $userAction->updated_at }}
                            <hr />
                        </div>
                        @if ($loop->iteration % 2 == 0 || $loop->last)
                    </div>
                    @endif
                    @endforeach
                </div>
            </div>
        </div>

        <div class='col-md-3'>
            @tip(gdpr-view-export-data)
        </div>
    </div>
</div>
@endsection
