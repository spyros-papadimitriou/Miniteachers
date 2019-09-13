@extends('layouts.cms')
@section('content')
<h3><img height="32" src="{{ asset('svg/cms/adjective.svg') }}" alt=""  /> Στοιχεία χαρακτήρα</h3>

@if (count($adjectives) > 0)
<table class="table table-striped table-bordered table-hover table-sm">
    <thead>
        <tr>
            <th>Α/Α</th>
            <th>Id</th>
            <th>Ονομασία (άνδρας)</th>
            <th>Ονομασία (γυναίκα)</th>
            <th>Τελευταία τροποποίηση</th>
            <th>Ενέργειες</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($adjectives as $adjective)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $adjective->id }}</td>
            <td>{{ $adjective->name_male }}</td>
            <td>{{ $adjective->name_female }}</td>
            <td>{{ $adjective->updated_at }}</td>
            <td nowrap>
                <form action="{{ route('cms.adjectives.destroy', ['id'=>$adjective->id]) }}" class="pull-right" method="post">
                    @csrf
                    @method('delete')
                    <a class="btn btn-sm btn-info" href="{{ route('cms.adjectives.edit', ['id'=>$adjective->id]) }}">Επεξεργασία</a>                
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
<a href="{{ route('cms.adjectives.create') }}" class="btn btn-primary btn-sm">Προσθήκη</a>
<p>&nbsp;</p>
@if(session()->has('message'))
<div class="alert alert-primary">{{ session()->get('message') }}</div>
@endif
@endsection
