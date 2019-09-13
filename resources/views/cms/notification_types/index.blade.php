@extends('layouts.cms')
@section('content')
<h3><img height="32" src="{{ asset('svg/cms/bell.svg') }}" alt=""  /> Τύποι ειδοποιήσεων</h3>

@if (count($notificationTypes) > 0)
<table class="table table-striped table-bordered table-hover table-sm">
    <thead>
        <tr>
            <th>Α/Α</th>
            <th>Id</th>
            <th>Ονομασία</th>
            <th>Τελευταία τροποποίηση</th>
            <th>Αριθμός ειδοποιήσεων</th>
            <th>Ενέργειες</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($notificationTypes as $notificationType)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $notificationType->id }}</td>
            <td>{{ $notificationType->name }}</td>
            <td>{{ $notificationType->updated_at }}</td>
            <td>{{ $notificationType->notifications_count }}</td>
            <td nowrap>
                <form action="{{ route('cms.notification_types.destroy', ['id'=>$notificationType->id]) }}" class="pull-right" method="post">
                    @csrf
                    @method('delete')
                    <a class="btn btn-sm btn-info" href="{{ route('cms.notification_types.edit', ['notification_type'=>$notificationType->id]) }}">Επεξεργασία</a>                
                    <button class="btn btn-sm btn-danger"{{ $notificationType->notifications_count ? 'disabled': '' }}>Διαγραφή</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@else
<p>Δεν υπάρχουν εγγραφές.</p>
@endif
<a href="{{ route('cms.notification_types.create') }}" class="btn btn-primary btn-sm">Προσθήκη</a>
<p>&nbsp;</p>
@if(session()->has('message'))
<div class="alert alert-primary">{{ session()->get('message') }}</div>
@endif

@endsection
