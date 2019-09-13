@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h5><a href="{{ route('inbox') }}">Μηνύματα</a> &raquo; Προβολή μηνύματος</h5>
            <hr />
        </div>
    </div>    
    <div class="card">
        @if ($previousMessage || $nextMessage)
        <div class="card-header">
            <div class="row">
                <div class="col-md-6">
                    @if ($previousMessage)
                    <a class="small" href="{{ route('message-show', ['mesasge'=>$previousMessage->id]) }}">Προηγούμενο μήνυμα</a>
                    @endif
                </div>
                <div class="col-md-6 text-right">
                    @if ($nextMessage)
                    <a class="small" href="{{ route('message-show', ['mesasge'=>$nextMessage->id]) }}">Επόμενο μήνυμα</a>
                    @endif
                </div>
            </div>
        </div>
        @endif

        <div class="card-body">
            <div class="row">
                <div class="col-md-10">
                    @if ($message->important)
                    <div class="row mb-2">
                        <div class="col-md-2"><small class="font-weight-bold">Σημαντικό:</small></div>
                        <div class="col-md-10 font-weight-bold">Ναι</div>
                    </div>
                    @endif
                    <div class="row mb-2">
                        <div class="col-md-2"><small>Id:</small></div>
                        <div class="col-md-10">{{ $message->id }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-2"><small>Ημ/νία αποστολής:</small></div>
                        <div class="col-md-10">{{ $message->created_at }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-2"><small>Όνομα αποστολέα:</small></div>
                        <div class="col-md-10">{{ $message->name }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-2"><small>Θέμα:</small></div>
                        <div class="col-md-10">{{ $message->subject }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-2"><small>Περιεχόμενο:</small></div>
                        <div class="col-md-10">{{ $message->content }}</div>
                    </div>
                </div>
                @if ($message->important)
                <div class="col-md-2 text-right">
                    <img src="{{ asset('svg/star.svg') }}" height="32" alt="">
                </div>
                @endif
            </div>
        </div>
    </div>
    <div class="card-footer">
        <div class="row">
            <div class="col-md-4">
                <a class="small" href="{{ url()->previous() }}">Πίσω στην προηγούμενη σελίδα</a>
            </div>
            <div class="col-md-4 text-center">
                <form method="post" action="{{ route('message-update', ['message'=>$message->id]) }}">
                    @csrf
                    @method('put')
                    <button class="btn btn-link btn-sm" type="submit">
                        @if ($message->important)
                        Αφαίρεση ένδειξης 'σημαντικό'
                        @else
                        Προσθήκη ένδειξης 'σημαντικό'
                        @endif
                    </button>
                </form>
            </div>
            <div class="col-md-4 text-right">

                <form method="post" action="{{ route('inbox-message-delete', ['message'=>$message->id]) }}" onclick="return confirm('Επιβεβαίωση διαγραφής του μηνύματος;');">
                    @csrf
                    @method('delete')
                    <button class="btn btn-link btn-sm text-danger" type="submit">Διαγραφή μηνύματος</button>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
