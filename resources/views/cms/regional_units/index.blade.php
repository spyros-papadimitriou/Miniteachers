@extends('layouts.cms')
@section('content')
<h3><img height="32" src="{{ asset('svg/cms/map.svg') }}" alt=""  /> Περιφερειακές Ενότητες</h3>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('cms.regions.index') }}">Περιφέρειες</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{ $region->name }}</li>
    </ol>
</nav>


@if (count($regionalUnits) > 0)
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
        @foreach ($regionalUnits as $regionalUnit)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $regionalUnit->id }}</td>
            <td>{{ $regionalUnit->name }}</td>
            <td>{{ $regionalUnit->updated_at }}</td>
            <td><a class="btn btn-sm btn-{{ $regionalUnit->municipalities_count ? 'success': 'outline-success' }}" href="{{ route('cms.regional_units.municipalities.index', ['regional_unit'=>$regionalUnit->id]) }}">Δήμοι ({{ $regionalUnit->municipalities_count }})</a></td>
            <td nowrap>
                <form action="{{ route('cms.regions.regional_units.destroy', ['region'=>$region->id, 'regional_unit'=>$regionalUnit->id]) }}" class="pull-right" method="post">
                    @csrf
                    @method('delete')
                    <a class="btn btn-sm btn-info" href="{{ route('cms.regions.regional_units.edit', ['region'=>$region->id, 'regional_unit'=>$regionalUnit->id]) }}">Επεξεργασία</a>                
                    <button class="btn btn-sm btn-danger{{ $regionalUnit->municipalities_count ? ' disabled': '' }}">Διαγραφή</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@else
<p>Δεν υπάρχουν εγγραφές.</p>
@endif
<a href="{{ route('cms.regions.regional_units.create', ['region'=>$region->id]) }}" class="btn btn-primary btn-sm">Προσθήκη</a>
<p>&nbsp;</p>
@if(session()->has('message'))
<div class="alert alert-primary">{{ session()->get('message') }}</div>
@endif

@endsection
