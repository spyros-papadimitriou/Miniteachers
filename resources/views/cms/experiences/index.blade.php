@extends('layouts.cms')
@section('content')
<h3><img height="32" src="{{ asset('svg/cms/experience.svg') }}" alt=""  /> Εμπειρία</h3>

@if (count($experiences) > 0)
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
        @foreach ($experiences as $experience)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $experience->id }}</td>
            <td>{{ $experience->name }}</td>
            <td>{{ $experience->updated_at }}</td>
            <td>
                <form action="{{ route('cms.experiences.destroy', ['id'=>$experience->id]) }}" class="pull-right" method="post">
                    @csrf
                    @method('delete')
                    <a class="btn btn-sm btn-info" href="{{ route('cms.experiences.edit', ['id'=>$experience->id]) }}">Επεξεργασία</a>                
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
<a href="{{ route('cms.experiences.create') }}" class="btn btn-primary btn-sm">Προσθήκη</a>
<p>&nbsp;</p>
@if(session()->has('message'))
<div class="alert alert-primary">{{ session()->get('message') }}</div>
@endif
@endsection
