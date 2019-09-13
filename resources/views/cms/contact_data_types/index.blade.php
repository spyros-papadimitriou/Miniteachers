@extends('layouts.cms')
@section('content')
<h3><img height="32" src="{{ asset('svg/cms/phone.svg') }}" alt=""  /> Είδη Στοιχείων Επικονωνίας</h3>

@if (count($contact_data_types) > 0)
<table class="table table-striped table-bordered table-hover table-sm">
    <thead>
        <tr>
            <th>A/A</th>
            <th>Id</th>
            <th>Ονομασία</th>
            <th>Τελευταία τροποποίηση</th>
            <th>Ενέργειες</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($contact_data_types as $contact_data_type)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $contact_data_type->id }}</td>
            <td>{{ $contact_data_type->name }}</td>
            <td>{{ $contact_data_type->updated_at }}</td>
            <td>
                <form action="{{ route('cms.contact_data_types.destroy', ['id'=>$contact_data_type->id]) }}" class="pull-right" method="post">
                    @csrf
                    @method('delete')
                    <a class="btn btn-sm btn-info" href="{{ route('cms.contact_data_types.edit', ['id'=>$contact_data_type->id]) }}">Επεξεργασία</a>                
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
<a href="{{ route('cms.contact_data_types.create') }}" class="btn btn-primary btn-sm">Προσθήκη</a>
<p>&nbsp;</p>
@if(session()->has('message'))
<div class="alert alert-primary">{{ session()->get('message') }}</div>
@endif
@endsection
