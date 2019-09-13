@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h5><img src='{{ asset('svg/envelope.svg') }}' height="32" alt=''>  Μηνύματα</h5>
            <hr />
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-12">
            <div class="btn-group">
            <a class="btn btn-sm btn-{{ $type == 'all' ? '': 'outline-' }}profile.basic-info" href="{{ route('inbox') }}">Όλα ({{ $unreadMessages + $readMessages }})</a>
            <a class="btn btn-sm btn-{{ $type == 'unread' ? '': 'outline-' }}danger" href="{{ url()->current() }}?type=unread">Αδιάβαστα ({{ $unreadMessages }}/{{ $unreadMessages + $readMessages }})</a>
            <a class="btn btn-sm btn-{{ $type == 'read' ? '': 'outline-' }}secondary" href="{{ url()->current() }}?type=read">Διαβασμένα ({{ $readMessages }}/{{ $unreadMessages + $readMessages }})</a>
            <a class="btn btn-sm btn-{{ $type == 'important' ? '': 'outline-' }}primary" href="{{ url()->current() }}?type=important">Σημαντικά ({{ $importantMessages }}/{{ $unreadMessages + $readMessages }})</a>
            </div>
        </div>
    </div>

    @if(session()->has('message'))
    <div class="row">
        <div class="col-md-9">
            <div class="alert alert-danger small">
                {{ session()->get('message') }}
            </div>
        </div>
    </div>
    @endif

    <div class="row">
        <div class="col-md-9">
            @if (count($messages) > 0)
            @foreach ($messages as $message)
            <div class="card mb-3">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6">
                            <span class="small{{ $message->is_read == 0 ? ' font-weight-bold': null }}">{{ ($messages ->currentpage()-1) * $messages ->perpage() + $loop->index + 1 }}. {{ $message->created_at }}</span>
                        </div>
                        <div class="col-md-6 text-right">
                            @if ($message->important)
                            <img src='{{ asset('svg/star.svg') }}' alt="" height="24" title="Σημαντικό">
                            @endif
                            <img src="{{ $message->is_read ? asset('svg/mail-read.svg'): asset('svg/mail-not-read.svg') }}" alt="" title="{{ $message->is_read ? 'Διαβάστηκε': 'Νέο' }}" height="24" >
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    Από: {{ $message->name }}<br />
                    Θέμα: {{ $message->subject }}
                </div>
                <div class="card-footer text-right">
                    @if ($message->is_read)
                    <a class="btn btn-sm btn-outline-primary" href='{{ route('inbox-message-show', ['message'=>$message->id]) }}'>Προβολή μηνύματος</a>
                    @else
                    <a class="btn btn-sm btn-outline-danger" href='{{ route('inbox-message-show', ['message'=>$message->id]) }}'>Προβολή νέου μηνύματος</a>
                    @endif                    
                </div>
            </div>
            @endforeach
            @else
            <p>Δεν υπάρχουν μηνύματα.</p>            
            @endif

            <div class="small">
                {{ $messages->appends(request()->query())->links() }}
            </div>
        </div>

        <div class='col-md-3'>
            <div class="card bg-light">
                <div class="card-header">
                    <img src='{{ asset('svg/info.svg') }}' height="24" alt=''> Tip
                </div>
                <div class="card-body">
                    <blockquote class="mb-0">
                        <p>Στη σελίδα αυτή μπορείτε να δείτε λίστα με τα μηνύματα που σας έχουν στείλει κατά καιρούς μέσω της φόρμας επικοινωνίας.</p>
                        <p>Τα αδιάβαστα μηνύματα έχουν εικονίδιο κλειστού φακέλου και τα κουμπιά προβολής τους έχουν κόκκινο περίγραμμα.</p>
                        <p>Μέσα από τη σελίδα προβολής μηνύματος, μπορείτε να βάλετε την ένδειξη 'Σημαντικό' ώστε να βρίσκετε πιο εύκολα τα μηνύματα που σας ενδιαφέρουν πιο άμεσα.</p>
                        <footer class="blockquote-footer">Έφη</footer>
                    </blockquote>
                </div>
            </div>
            <div class="text-center mt-3">
                <img src='{{ asset('svg/tips/7.svg') }}' height="300" alt=''>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
