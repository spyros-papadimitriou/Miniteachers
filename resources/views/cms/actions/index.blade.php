@extends('layouts.cms')
@section('content')
<h3><img height="32" src="{{ asset('svg/cms/action.svg') }}" alt=""  /> Ενέργειες</h3>

@if (count($actions) > 0)
<table class="table table-striped table-bordered table-hover table-sm">
    <thead>
        <tr>
            <th>Α/Α</th>
            <th>Id</th>
            <th>Ονομασία</th>
            <th>Πόντοι</th>
            <th>Τελευταία τροποποίηση</th>
            <th>Ενέργειες</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($actions as $action)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $action->id }}</td>
            <td>{{ $action->name }}</td>
            <td>{{ $action->points }}</td>
            <td>{{ $action->updated_at }}</td>
            <td nowrap>
                <form action="{{ route('cms.actions.destroy', ['id'=>$action->id]) }}" class="pull-right" method="post">
                    @csrf
                    @method('delete')
                    <a class="btn btn-sm btn-info" href="{{ route('cms.actions.edit', ['id'=>$action->id]) }}">Επεξεργασία</a>                
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
<a href="{{ route('cms.actions.create') }}" class="btn btn-primary btn-sm">Προσθήκη</a>
<p>&nbsp;</p>
@if(session()->has('message'))
<div class="alert alert-primary">{{ session()->get('message') }}</div>
@endif

@endsection
