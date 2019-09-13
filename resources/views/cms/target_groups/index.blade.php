@extends('layouts.cms')
@section('content')
<h3><img height="32" src="{{ asset('svg/cms/target-group.svg') }}" alt=""  /> Ομάδες - Στόχοι</h3>

@if (count($targetGroups) > 0)
<table class="table table-striped table-bordered table-hover table-sm">
    <thead>
        <tr>
            <th>Α/Α</th>
            <th>Id</th>
            <th>&nbsp;</th>
            <th>Ονομασία</th>
            <th>Τελευταία τροποποίηση</th>
            <th>Ενέργειες</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($targetGroups as $targetGroup)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $targetGroup->id }}</td>
            <td class="text-center"><img src="{{ $targetGroup->picture }}" alt="" width="32"></td>
            <td>{{ $targetGroup->name }}</td>
            <td>{{ $targetGroup->updated_at }}</td>
            <td>
                <form action="{{ route('cms.target_groups.destroy', ['id'=>$targetGroup->id]) }}" class="pull-right" method="post">
                    @csrf
                    @method('delete')
                    <a class="btn btn-sm btn-info" href="{{ route('cms.target_groups.edit', ['id'=>$targetGroup->id]) }}">Επεξεργασία</a>                
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
<a href="{{ route('cms.target_groups.create') }}" class="btn btn-primary btn-sm">Προσθήκη</a>
<p>&nbsp;</p>
@if(session()->has('message'))
<div class="alert alert-primary">{{ session()->get('message') }}</div>
@endif
@endsection
