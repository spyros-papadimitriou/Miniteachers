@extends('layouts.cms')
@section('content')
<h3><img height="32" src="{{ asset('svg/cms/university.svg') }}" alt=""  /> Περιφέρειες</h3>

@if (count($regions) > 0)
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
        @foreach ($regions as $region)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $region->id }}</td>
            <td>{{ $region->name }}</td>
            <td>{{ $region->updated_at }}</td>
            <td><a class="btn btn-sm btn-{{ $region->regional_units_count ? 'success': 'outline-success' }}" href="{{ route('cms.regions.regional_units.index', ['region'=>$region->id]) }}">Περιφερειακές ενότητες ({{ $region->regional_units_count }})</a></td>
            <td>
                <form action="{{ route('cms.regions.destroy', ['id'=>$region->id]) }}" class="pull-right" method="post">
                    @csrf
                    @method('delete')
                    <a class="btn btn-sm btn-info" href="{{ route('cms.regions.edit', ['id'=>$region->id]) }}">Επεξεργασία</a>                
                    <button class="btn btn-sm btn-danger{{ $region->regional_units_count ? ' disabled': '' }}">Διαγραφή</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@else
<p>Δεν υπάρχουν εγγραφές.</p>
@endif
<a href="{{ route('cms.regions.create') }}" class="btn btn-primary btn-sm">Προσθήκη</a>
<p>&nbsp;</p>
@if(session()->has('message'))
<div class="alert alert-primary">{{ session()->get('message') }}</div>
@endif

@endsection
