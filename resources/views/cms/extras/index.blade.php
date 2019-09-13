@extends('layouts.cms')
@section('content')
<h3><img height="32" src="{{ asset('svg/cms/extra.svg') }}" alt=""  /> Επιπλέον Πληροφορίες</h3>

@if (count($extras) > 0)
<table class="table table-striped table-bordered table-hover table-sm">
    <thead>
        <tr>
            <th>Α/Α</th>
            <th>Id</th>
            <th>Τύπος χρήστη</th>
            <th>Περιγραφή</th>
            <th>Τελευταία τροποποίηση</th>
            <th>Ενέργειες</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($extras as $extra)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $extra->id }}</td>
            <td>{{ $extra->userType->name }}</td>
            <td>{{ $extra->description }}</td>
            <td>{{ $extra->updated_at }}</td>
            <td nowrap>
                <form action="{{ route('cms.extras.destroy', ['id'=>$extra->id]) }}" class="pull-right" method="post">
                    @csrf
                    @method('delete')
                    <a class="btn btn-sm btn-info" href="{{ route('cms.extras.edit', ['id'=>$extra->id]) }}">Επεξεργασία</a>                
                    <button class="btn btn-sm btn-danger">Διαγραφή</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@else
<p>Δεν υπάρχουν εγγραφές.</p>
@endif
<a href="{{ route('cms.extras.create') }}" class="btn btn-primary btn-sm">Προσθήκη</a>
<p>&nbsp;</p>
@if(session()->has('message'))
<div class="alert alert-primary">{{ session()->get('message') }}</div>
@endif
@endsection
