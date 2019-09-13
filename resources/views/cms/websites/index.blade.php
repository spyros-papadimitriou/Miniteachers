@extends('layouts.cms')
@section('content')
<h3><img height="32" src="{{ asset('svg/cms/website.svg') }}" alt=""  /> Ιστοσελίδες</h3>

@if (count($websites) > 0)
<table class="table table-striped table-bordered table-hover table-sm">
    <thead>
        <tr>
            <th>Α/Α</th>
            <th>Id</th>
            <th>&nbsp;</th>
            <th>Ονομασία</th>
            <th>Μορφή URL</th>
            <th>Τελευταία τροποποίηση</th>
            <th>Ενέργειες</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($websites as $website)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $website->id }}</td>
            <td class="text-center"><img src="{{ $website->picture }}" alt="" width="32"></td>
            <td>{{ $website->name }}</td>
            <td>{{ $website->url_pattern }}</td>
            <td>{{ $website->updated_at }}</td>
            <td nowrap>
                <form action="{{ route('cms.websites.destroy', ['id'=>$website->id]) }}" class="pull-right" method="post">
                    @csrf
                    @method('delete')
                    <a class="btn btn-sm btn-info" href="{{ route('cms.websites.edit', ['id'=>$website->id]) }}">Επεξεργασία</a>                
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
<a href="{{ route('cms.websites.create') }}" class="btn btn-primary btn-sm">Προσθήκη</a>
<p>&nbsp;</p>
@if(session()->has('message'))
<div class="alert alert-primary">{{ session()->get('message') }}</div>
@endif
@endsection
