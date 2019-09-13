@extends('layouts.profile')

@section('profile-content')
<div class="row">
    <div class="col-md-9">
        <h5>Στοιχεία επικοινωνίας</h5>
    </div>
    <div class="col-md-3 text-right">
        @if (count($user->contactData) < 3)
        <a class="btn btn-sm btn-success" href='{{ route('profile.contact-data.create') }}'>Προσθήκη</a>
        @endif
    </div>
</div>
<hr />

<div class="row">
    <div class="col-md-6">
        @if(session()->has('message'))
        <div class="alert alert-success small">{{ session()->get('message') }}</div>
        @endif

        @if (count($user->contactData) > 0)
        @foreach ($user->contactData as $contactData)
        <div>
            <small>{{ $loop->iteration }}.</small><br />
            <small>Τρόπος επικοινωνίας</small>:  {{ $contactData->contactDataType->name }}<br />
            <small>Τιμή</small>:  {{ $contactData->value }}
            <form action="{{ route('profile.contact-data.destroy', ['contact-data'=>$contactData->id]) }}" method="post">
                @csrf
                @method('delete')
                <div class="text-right">
                    <a class="btn btn-sm btn-outline-info" href="{{ route('profile.contact-data.edit', ['contact-data' => $contactData->id]) }}">Επεξεργασία</a>
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
        @tip(profile-edit-contact-data)
    </div>
</div>
@endsection
