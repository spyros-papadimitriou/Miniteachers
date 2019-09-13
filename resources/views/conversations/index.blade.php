@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h5><img src='{{ asset('svg/envelope.svg') }}' height="32" alt=''>  Συζητήσεις</h5>
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

            @forelse ($conversations as $conversation)
            <div class="row">
                <div class="col-md-1 text-center">
                    <span class="badge badge-primary">{{ ($conversations ->currentpage()-1) * $conversations ->perpage() + $loop->index + 1 }}</span>
                </div>
                <div class="col-md-11">
                    {{ $conversation->created_at }}<br />
                    Συζήτηση με
                    @foreach ($conversation->users as $participant)
                    @if ($participant->id != Auth::user()->id)
                    {{ $participant->name }} <a target="_blank" class="small" href="{{ route('profile-slug-show', ['user'=>$participant->id, 'slug'=>str_slug($participant->name)]) }}">(Προβολή προφίλ)</a>.
                    @endif
                    @endforeach

                    @if ($conversation->totalUnreadMessages)
                    <br /><span class="text-danger">Έχετε νέα μηνύματα: {{ $conversation->totalUnreadMessages }}</span>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-md-5 offset-md-1">
                    <a class="" href="{{ route('conversations.show', ['conversation'=>$conversation->id]) }}">Προβολή συζήτησης</a>
                </div>
                <div class="col-md-6 text-right">
                    <form onsubmit="return confirm('Επιβεβαίωση διαγραφής της συζήτησης;');" id="conversationForm{{ $conversation->id }}" method="post" action="{{ route('conversations.destroy', ['conversation'=>$conversation->id]) }}">
                        @csrf
                        @method('delete')
                        <button class="btn btn-link btn-sm text-danger" type="submit">Διαγραφή συζήτησης</button>
                    </form>
                </div>
            </div>
            <hr />
            @empty
            <p>Δε βρέθηκαν συζητήσεις.</p>
            @endforelse
            <div class="row mt-3">
                <div class="col-md-12">
                    <div class="small">
                        {{ $conversations->appends(request()->query())->links() }}
                    </div>
                </div>
            </div>
        </div>

        <div class='col-md-3'>
            @tip(list-conversations)
        </div>
    </div>
</div>
</div>
@endsection
