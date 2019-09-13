@extends('layouts.cms')
@section('content')
<h3><img height="32" src="{{ asset('svg/cms/service.svg') }}" alt=""  /> Υπηρεσίες</h3>

@if (count($services) > 0)
<table class="table table-striped table-bordered table-hover table-sm">
    <thead>
        <tr>
            <th>Α/Α</th>
            <th>Id</th>
            <th></th>
            <th>Ονομασία</th>
            <th>Τελευταία τροποποίηση</th>
            <th>Ενέργειες</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($services as $service)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $service->id }}</td>
            <td class="text-center"><img src="{{ $service->picture }}" alt="" width="32"></td>
            <td>{{ $service->name }}</td>
            <td>{{ $service->updated_at }}</td>
            <td>
                <form action="{{ route('cms.services.destroy', ['id'=>$service->id]) }}" class="pull-right" method="post">
                    @csrf
                    @method('delete')
                    <a class="btn btn-sm btn-info" href="{{ route('cms.services.edit', ['id'=>$service->id]) }}">Επεξεργασία</a>                
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
<a href="{{ route('cms.services.create') }}" class="btn btn-primary btn-sm">Προσθήκη</a>
<p>&nbsp;</p>
@if(session()->has('message'))
<div class="alert alert-primary">{{ session()->get('message') }}</div>
@endif
@endsection
