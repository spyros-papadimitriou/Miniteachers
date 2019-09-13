@extends('layouts.cms')
@section('content')
<h3><img height="32" src="{{ asset('svg/cms/university.svg') }}" alt=""  /> Σχολές</h3>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('cms.institutions.index') }}">Εκπαιδευτικά Ιδρύματα</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{ $institution->name }}</li>
    </ol>
</nav>


@if (count($schools) > 0)
<table class="table table-striped table-bordered table-hover table-sm">
    <thead>
        <tr>
            <th>Α/Α</th>
            <th>Id</th>
            <th>Ονομασία</th>
            <th>Τελευταία τροποποίηση</th>
            <th>&nbsp;</th>
            <th>Ενέργειες</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($schools as $school)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $school->id }}</td>
            <td>{{ $school->name }}</td>
            <td>{{ $school->updated_at }}</td>
            <td><a class="btn btn-sm btn-{{ $school->departments_count ? 'success': 'outline-success' }}" href="{{ route('cms.schools.departments.index', ['school'=>$school->id]) }}">Τμήματα ({{ $school->departments_count }})</a></td>
            <td nowrap>
                <form action="{{ route('cms.institutions.schools.destroy', ['institution'=>$institution->id, 'school'=>$school->id]) }}" class="pull-right" method="post">
                    @csrf
                    @method('delete')
                    <a class="btn btn-sm btn-info" href="{{ route('cms.institutions.schools.edit', ['institution'=>$institution->id, 'id'=>$school->id]) }}">Επεξεργασία</a>                
                    <button class="btn btn-sm btn-danger{{ $school->departments_count ? ' disabled': '' }}">Διαγραφή</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@else
<p>Δεν υπάρχουν εγγραφές.</p>
@endif
<a href="{{ route('cms.institutions.schools.create', ['institution'=>$institution->id]) }}" class="btn btn-primary btn-sm">Προσθήκη</a>
<p>&nbsp;</p>
@if(session()->has('message'))
<div class="alert alert-primary">{{ session()->get('message') }}</div>
@endif

@endsection
