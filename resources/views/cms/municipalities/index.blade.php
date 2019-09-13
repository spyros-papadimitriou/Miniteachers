@extends('layouts.cms')
@section('content')
<h3><img height="32" src="{{ asset('svg/cms/map.svg') }}" alt=""  /> Δήμοι</h3>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('cms.regions.index') }}">Περιφέρειες</a></li>
        <li class="breadcrumb-item"><a href="{{ route('cms.regions.regional_units.index', ['region'=>$region->id]) }}">{{ $region->name }}</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{ $regionalUnit->name }}</li>
    </ol>
</nav>


@if (count($municipalities) > 0)
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
        @foreach ($municipalities as $municipality)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $municipality->id }}</td>
            <td>{{ $municipality->name }}</td>
            <td>{{ $municipality->updated_at }}</td>
            <td nowrap>
                <form action="{{ route('cms.regional_units.municipalities.destroy', ['regional_unit'=>$regionalUnit->id, 'municipality'=>$municipality->id]) }}" class="pull-right" method="post">
                    @csrf
                    @method('delete')
                    <a class="btn btn-sm btn-info" href="{{ route('cms.regional_units.municipalities.edit', ['regional_unit'=>$regionalUnit->id, 'municipality'=>$municipality->id]) }}">Επεξεργασία</a>                
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
<a href="{{ route('cms.regional_units.municipalities.create', ['regional_unit'=>$regionalUnit->id]) }}" class="btn btn-primary btn-sm">Προσθήκη</a>
<p>&nbsp;</p>
@if(session()->has('message'))
<div class="alert alert-primary">{{ session()->get('message') }}</div>
@endif

@endsection
