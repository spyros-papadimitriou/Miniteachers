@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h5><img src='{{ asset('svg/envelope.svg') }}' height="32" alt=''>  Εξερχόμενα μηνύματα</h5>
            <hr />
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
                            <span class="small">{{ ($messages ->currentpage()-1) * $messages ->perpage() + $loop->index + 1 }}. {{ $message->created_at }}</span>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    Προς: <a target="_blank" href="{{ route('profile-show', ['user'=>$message->userTo->id]) }}">{{ $message->userTo->name }}</a><br />
                    Θέμα: {{ $message->subject }}
                </div>
                <div class="card-footer text-right"> 
                    <a class="btn btn-sm btn-outline-primary" href='{{ route('sent-message-show', ['message'=>$message->id]) }}'>Προβολή μηνύματος</a>   
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
