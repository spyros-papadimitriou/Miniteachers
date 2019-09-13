@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h5><img src='{{ asset('svg/megaphone.svg') }}' height="32" alt=''> Ανακοινώσεις</h5>
            <hr />
        </div>
    </div>

    <div class="row">
        <div class="col-md-9">
            @if (count($announcements))
            @foreach ($announcements as $announcement)
            <div class="row mb-3">
                <div class="col-md-1">
                    <span class="badge badge-primary">{{ ($announcements ->currentpage()-1) * $announcements ->perpage() + $loop->index + 1 }}</span>
                </div>

                <div class="col-md-11">
                    {{ $announcement->created_at }}<br />
                    <span class="font-weight-bold">{{ $announcement->title }}</span><br />
                    {{ $announcement->content }}
                </div>
            </div>
            @endforeach
            <div class="row">
                <div class="col-md-12 small">
                    {{ $announcements->links() }}
                </div>
            </div>
            @else
            <p>Δε βρέθηκαν ανακοινώσεις.
            @endif
        </div>

        <div class='col-md-3'>
            @tip(announcements)
        </div>
    </div>
</div>

@endsection
