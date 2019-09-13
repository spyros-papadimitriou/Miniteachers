@extends('layouts.cms')
@section('content')
<h3><img height="32" src="{{ asset('svg/cms/megaphone.svg') }}" alt=""  /> Ανακοινώσεις</h3>

@if (count($announcements) > 0)
<table class="table table-striped table-bordered table-hover table-sm">
    <thead>
        <tr>
            <th>Α/Α</th>
            <th>Id</th>
            <th>Τίτλος</th>
            <th>Τελευταία τροποποίηση</th>
            <th>Ενέργειες</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($announcements as $announcement)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $announcement->id }}</td>
            <td>{{ $announcement->title }}</td>
            <td>{{ $announcement->updated_at }}</td>
            <td>
                <form action="{{ route('cms.announcements.destroy', ['id'=>$announcement->id]) }}" class="pull-right" method="post">
                    @csrf
                    @method('delete')
                    <a class="btn btn-sm btn-info" href="{{ route('cms.announcements.edit', ['id'=>$announcement->id]) }}">Επεξεργασία</a>                
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
<a href="{{ route('cms.announcements.create') }}" class="btn btn-primary btn-sm">Προσθήκη</a>
<p>&nbsp;</p>
@if(session()->has('message'))
<div class="alert alert-primary">{{ session()->get('message') }}</div>
@endif
@endsection
