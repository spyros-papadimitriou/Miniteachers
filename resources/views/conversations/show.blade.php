@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h5><img src='{{ asset('svg/envelope.svg') }}' height="32" alt=''> <a href="{{ route('conversations.index') }}">Συζητήσεις</a> &raquo; {{ $recipient->name }}</h5>
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

    @if ($errors->any())
    <div class="row">
        <div class="col-md-6">                 
            <div class="alert alert-danger small">
                @foreach ($errors->all() as $error)
                - {{ $error }}<br />
                @endforeach
            </div>
        </div>
    </div>
    @endif

    <div class="row">

        <div class="col-md-9">            
            @forelse ($messages->reverse() as $message)
            <div class="row small mb-3">
                <div class="col-md-1 text-center">
                    <img height="24" src="{{ $message->user->id == $sender->id ? asset('svg/arrow-right.svg'): asset('svg/arrow-left.svg') }}" alt="{{ $message->user->id == $sender->id ? 'εξερχόμενο': 'εισερχόμενο' }}" title="{{ $message->user->id == $sender->id ? 'εξερχόμενο': 'εισερχόμενο' }}">
                    @if ($message->pivot->is_read == 0)
                    <br /><small class="text-danger">νέο</small>
                    @endif
                </div>

                <div class="col-md-3">
                    <a target="_blank" href="{{ route('profile-slug-show', ['user' => $message->user->id, 'slug'=>str_slug($message->user->name)]) }}">{{ $message->user->name }}</a><br />
                    {{ $message->created_at }}
                </div>

                <div class="col-md-8">
                    {{ $message->content }}
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 text-right">
                    <form onsubmit="return confirm('Επιβεβαίωση διαγραφής μηνύματος;');" method="post" action="{{ route('messages.destroy', ['message'=>$message->id]) }}">
                        @csrf
                        @method('delete')
                        <button class="btn btn-link btn-sm text-danger" type="submit">Διαγραφή μηνύματος</button>
                    </form>
                </div>
            </div>

            <hr />
            @empty
            <p>Δεν υπάρχουν μηνύματα.</p>
            @endforelse

            <div class="row small mb-3">
                <div class="col-md-1 text-center">
                    <img height="24" src="{{ asset('svg/arrow-new.svg') }}" alt="Νέο μήνυμα" title="Νέο μήνυμα">
                    <small class="text-success">Δημιουργία</small>
                </div>
                <div class="col-md-3">
                    {{ $sender->name }}
                </div>
                <div class="col-md-8">
                    <form method="post" action="{{ route('conversations.store') }}">
                        @csrf
                        @method('post')
                        <div class="form-group">
                            <label for="content">Γράψτε το μήνυμά σας.</label>
                            <textarea class="form-control" id="content" name='content' rows="3"></textarea>
                            <small class="text-muted">Μέχρι 255 χαρακτήρες.</small>
                        </div>

                        <input type="hidden" name="recipient" value="{{ $recipient->id }}">
                        <button type="submit" class="btn btn-sm btn-primary">Αποστολή μηνύματος</button>
                    </form>
                </div>
            </div>

            <div class="row mt-5">
                <div class="col-md-4 offset-md-4">
                    <div class="small">
                        {{ $messages->appends(request()->query())->links() }}
                    </div>
                </div>
            </div>
        </div>

        <div class='col-md-3'>
            @tip(show-conversation)
        </div>
    </div>
</div>

@endsection
