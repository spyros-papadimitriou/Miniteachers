@extends('layouts.cms')
@section('content')
<h3><img height="32" src="{{ asset('svg/cms/lightbulb.svg') }}" alt=""  /> Συμβουλές</h3>

@if (count($tips) > 0)
<table class="table table-striped table-bordered table-hover table-sm">
    <thead>
        <tr>
            <th>Α/Α</th>
            <th>Id</th>
            <th>Πράκτορας</th>
            <th>Alias</th>
            <th>Τίτλος</th>
            <th>Τελευταία τροποποίηση</th>
            <th>Ενέργειες</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($tips as $tip)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $tip->id }}</td>
            <td>
                @isset($tip->agent)
                {{ $tip->agent->name }}
                @else
                -
                @endisset
            </td>
            <td>{{ $tip->alias }}</td>
            <td>{{ $tip->title }}</td>
            <td>{{ $tip->updated_at }}</td>
            <td nowrap>
                <form action="{{ route('cms.tips.destroy', ['id'=>$tip->id]) }}" class="pull-right" method="post">
                    @csrf
                    @method('delete')
                    <a class="btn btn-sm btn-info" href="{{ route('cms.tips.edit', ['id'=>$tip->id]) }}">Επεξεργασία</a>                
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
<a href="{{ route('cms.tips.create') }}" class="btn btn-primary btn-sm">Προσθήκη</a>
<p>&nbsp;</p>
@if(session()->has('message'))
<div class="alert alert-primary">{{ session()->get('message') }}</div>
@endif
@endsection
