@extends('layouts.profile')

@section('profile-content')
<div class="row">
    <div class="col-md-9">
        <h5>Μεταπτυχιακές σπουδές</h5>
    </div>
    <div class="col-md-3 text-right">
        @if (count($user->postgraduates) < 3)
        <a class="btn btn-sm btn-success" href='{{ route('profile.postgraduates.create') }}'>Προσθήκη</a>
        @endif
    </div>
</div>
<hr />

<div class="row">
    <div class="col-md-6">
        @if(session()->has('message'))
        <div class="alert alert-success small">{{ session()->get('message') }}</div>
        @endif

        @if (count($user->postgraduates) > 0)
        @foreach ($user->postgraduates as $postgraduate)
        <div>
            <small>{{ $loop->iteration }}.</small><br />
            <small>Τίτλος μεταπτυχιακού</small>:  {{ $postgraduate->name }}<br />
            <small>Έτος αποφοίτησης</small>:  {{ $postgraduate->endyear }}
            <form action="{{ route('profile.postgraduates.destroy', ['postgraduate'=>$postgraduate->id]) }}" method="post">
                @csrf
                @method('delete')
                <div class="text-right">
                    <a class="btn btn-sm btn-outline-info" href="{{ route('profile.postgraduates.edit', ['postgraduate' => $postgraduate->id]) }}">Επεξεργασία</a>
                    <button type="submit" class="btn btn-sm btn-outline-danger">Διαγραφή</button>
                </div>
                <hr />
            </form>
        </div>
        @endforeach
        @else
        <p>Δεν υπάρχουν εγγραφές.</p>
        @endif
    </div>
    <div class='col-md-3 offset-lg-3 mt-3'>
        @miniteacher
        @tip(profile-edit-postgraduates-miniteacher)
        @endminiteacher
        @miniguest
        @tip(profile-edit-postgraduates-miniguest)
        @endminiguest
    </div>
</div>
@endsection
