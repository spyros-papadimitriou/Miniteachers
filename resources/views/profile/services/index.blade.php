@extends('layouts.profile')

@section('profile-content')
<div class="row">
    <div class="col-md-9">
        <h5>Υπηρεσίες</h5>
    </div>
    <div class="col-md-3 text-right">
        <a class="btn btn-sm btn-success" href='{{ route('profile.services.create') }}'>Προσθήκη - Επεξεργασία</a>
    </div>
</div>
<hr />

<div class="row">
    <div class="col-md-6">
        @if(session()->has('message'))
        <div class="alert alert-success small">{{ session()->get('message') }}</div>
        @endif

        @if (count($user->services) > 0)
        @foreach ($user->services as $service)
        <div>
            <small>{{ $loop->iteration }}.</small><br />
            <small>Υπηρεσία</small>:  {{ $service->name }}
            <form action="{{ route('profile.services.destroy', ['service'=>$service->id]) }}" method="post">
                @csrf
                @method('delete')
                <div class="text-right">
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
        @tip(profile-edit-services-miniteacher)
        @endminiteacher
        @miniguest
        @tip(profile-edit-services-miniguest)
        @endminiguest
    </div>
</div>
@endsection
