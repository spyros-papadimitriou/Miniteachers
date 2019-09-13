@extends('layouts.cms')
@section('content')
<h3><img height="32" src="{{ asset('svg/cms/university.svg') }}" alt=""  /> Τμήματα</h3>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('cms.institutions.index') }}">Εκπαιδευτικά Ιδρύματα</a></li>
        <li class="breadcrumb-item"><a href="{{ route('cms.institutions.schools.index', ['institution'=>$institution->id]) }}">{{ $institution->name }}</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{ $school->name }}</li>
    </ol>
</nav>


@if (count($departments) > 0)
<table class="table table-striped table-bordered table-hover table-sm">
    <thead>
        <tr>
            <th>Α/Α</th>
            <th>Id</th>
            <th>Ονομασία</th>
            <th>Τελευταία τροποποίηση</th>
            <th>Ενέργειες</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($departments as $department)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $department->id }}</td>
            <td>{{ $department->name }}</td>
            <td>{{ $department->updated_at }}</td>
            <td nowrap>
                <form action="{{ route('cms.schools.departments.destroy', ['school'=>$school->id, 'department'=>$department->id]) }}" class="pull-right" method="post">
                    @csrf
                    @method('delete')
                    <a class="btn btn-sm btn-info" href="{{ route('cms.schools.departments.edit', ['school'=>$school->id, 'id'=>$department->id]) }}">Επεξεργασία</a>                
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
<a href="{{ route('cms.schools.departments.create', ['school'=>$school->id]) }}" class="btn btn-primary btn-sm">Προσθήκη</a>
<p>&nbsp;</p>
@if(session()->has('message'))
<div class="alert alert-primary">{{ session()->get('message') }}</div>
@endif

@endsection
