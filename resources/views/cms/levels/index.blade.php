@extends('layouts.cms')
@section('content')
<h3><img height="32" src="{{ asset('svg/cms/levels.svg') }}" alt=""  /> Επίπεδα</h3>

@if (count($levels) > 0)
<table class="table table-striped table-bordered table-hover table-sm">
    <thead>
        <tr>
            <th>Α/Α</th>
            <th>Id</th>
            <th>Όνομα (άνδρας)</th>
            <th>Όνομα (γυναίκα)</th>
            <th>Πόντοι που απαιτούνται</th>
            <th>Τελευταία τροποποίηση</th>
            <th>Ενέργειες</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($levels as $level)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $level->id }}</td>
            <td>{{ $level->name_male }}</td>
            <td>{{ $level->name_female }}</td>
            <td>{{ $level->points_needed }}</td>
            <td>{{ $level->updated_at }}</td>
            <td nowrap>
                <form action="{{ route('cms.levels.destroy', ['id'=>$level->id]) }}" class="pull-right" method="post">
                    @csrf
                    @method('delete')
                    <a class="btn btn-sm btn-info" href="{{ route('cms.levels.edit', ['id'=>$level->id]) }}">Επεξεργασία</a>                
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
<a href="{{ route('cms.levels.create') }}" class="btn btn-primary btn-sm">Προσθήκη</a>
<p>&nbsp;</p>
@if(session()->has('message'))
<div class="alert alert-primary">{{ session()->get('message') }}</div>
@endif
@endsection
