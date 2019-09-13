@extends('layouts.cms')
@section('content')
<h3><img height="32" src="{{ asset('svg/cms/agents.svg') }}" alt=""  /> Πράκτορες</h3>

@if (count($agents) > 0)
<table class="table table-striped table-bordered table-hover table-sm">
    <thead>
        <tr>
            <th>Α/Α</th>
            <th>Id</th>
            <th></th>
            <th>Όνομα</th>
            <th>Συμβουλές</th>
            <th>Τελευταία τροποποίηση</th>
            <th>Ενέργειες</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($agents as $agent)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $agent->id }}</td>
            <td class="text-center"><img src="{{ $agent->picture }}" alt="" height="100"></td>
            <td>{{ $agent->name }}</td>
            <td class="text-center">{{ $agent->tips()->count() }}</td>
            <td>{{ $agent->updated_at }}</td>
            <td>
                <form action="{{ route('cms.agents.destroy', ['id'=>$agent->id]) }}" class="pull-right" method="post">
                    @csrf
                    @method('delete')
                    <a class="btn btn-sm btn-info" href="{{ route('cms.agents.edit', ['id'=>$agent->id]) }}">Επεξεργασία</a>                
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
<a href="{{ route('cms.agents.create') }}" class="btn btn-primary btn-sm">Προσθήκη</a>
<p>&nbsp;</p>
@if(session()->has('message'))
<div class="alert alert-primary">{{ session()->get('message') }}</div>
@endif
@endsection
