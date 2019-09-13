@extends('layouts.cms')
@section('content')
<h3><img height="32" src="{{ asset('svg/cms/university.svg') }}" alt=""  /> Εκπαιδευτικά Ιδρύματα</h3>

@if (count($institutions) > 0)
<table class="table table-striped table-bordered table-hover table-sm">
    <thead>
        <tr>
            <th>Α/Α</th>
            <th>Id</th>
            <th>&nbsp;</th>
            <th>Ονομασία</th>
            <th>Τελευταία τροποποίηση</th>
            <th>&nbsp;</th>
            <th>Ενέργειες</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($institutions as $institution)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $institution->id }}</td>
            <td class="text-center"><img src="{{ $institution->picture }}" alt="" height="64"></td>
            <td>{{ $institution->name }}</td>
            <td>{{ $institution->updated_at }}</td>
            <td><a class="btn btn-{{ $institution->schools_count ? 'success': 'outline-success' }} btn-sm" href="{{ route('cms.institutions.schools.index', ['institution' => $institution->id]) }}">Σχολές ({{ $institution->schools_count }})</a></td>
            <td nowrap>
                <form action="{{ route('cms.institutions.destroy', ['id'=>$institution->id]) }}" class="pull-right" method="post">
                    @csrf
                    @method('delete')
                    <a class="btn btn-sm btn-info" href="{{ route('cms.institutions.edit', ['id'=>$institution->id]) }}">Επεξεργασία</a>                
                    <button class="btn btn-sm btn-danger"{{ $institution->schools_count ? 'disabled': '' }}>Διαγραφή</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@else
<p>Δεν υπάρχουν εγγραφές.</p>
@endif
<a href="{{ route('cms.institutions.create') }}" class="btn btn-primary btn-sm">Προσθήκη</a>
<p>&nbsp;</p>
@if(session()->has('message'))
<div class="alert alert-primary">{{ session()->get('message') }}</div>
@endif

@endsection
