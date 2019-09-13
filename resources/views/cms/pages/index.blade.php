@extends('layouts.cms')
@section('content')
<h3><img height="32" src="{{ asset('svg/cms/page.svg') }}" alt=""  /> Σελίδες</h3>

@if (count($pages) > 0)
<table class="table table-striped table-bordered table-hover table-sm">
    <thead>
        <tr>
            <th>Α/Α</th>
            <th>Id</th>
            <th>Όνομα</th>
            <th>Τελευταία τροποποίηση</th>
            <th>Ενέργειες</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($pages as $page)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $page->id }}</td>
            <td>{{ $page->name }}</td>
            <td>{{ $page->updated_at }}</td>
            <td>
                <form action="{{ route('cms.pages.destroy', ['id'=>$page->id]) }}" class="pull-right" method="post">
                    @csrf
                    @method('delete')
                    <a class="btn btn-sm btn-info" href="{{ route('cms.pages.edit', ['id'=>$page->id]) }}">Επεξεργασία</a>                
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
<a href="{{ route('cms.pages.create') }}" class="btn btn-primary btn-sm">Προσθήκη</a>
<p>&nbsp;</p>
@if(session()->has('message'))
<div class="alert alert-primary">{{ session()->get('message') }}</div>
@endif
@endsection
