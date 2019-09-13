@extends('layouts.cms')
@section('content')
<h3><img height="32" src="{{ asset('svg/cms/users.svg') }}" alt=""  /> Χρήστες</h3>

@if (count($users) > 0)
<table class="table table-striped table-bordered table-hover table-sm">
    <thead>
        <tr>
            <th>Α/Α</th>
            <th>Id</th>
            <th>Εικόνα</th>
            <th nowrap>Τύπος χρήστη</th>
            <th>Όνομα</th>
            <th>E-mail</th>
            <th nowrap>Ημ/νία γέννησης</th>
            <th>Επιβεβαιωμένο</th>
            <th nowrap>Τελευταίο login</th>
            <th>Ενέργειες</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $user->id }}</td>
            <td>
                @if ($user->picture)
                <img src="{{ asset('uploads/users/'.$user->picture) }}" alt="" width="120">
                @else
                -
                @endif
            </td>
            <td class="text-center">{{ $user->userType->name }}</td>
            <td nowrap>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->birthdate }}</td>
            <td class="text-center"><img height="32" src="{{ $user->confirmed == 0 ? asset('svg/cms/no.svg'): asset('svg/cms/yes.svg') }}" alt="" ></td>
            <td>{{ $user->login_date }}</td>
            <td>
                -
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@else
<p>Δεν υπάρχουν εγγραφές.</p>
@endif
@endsection
