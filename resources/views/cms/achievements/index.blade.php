@extends('layouts.cms')
@section('content')
<h3><img height="32" src="{{ asset('svg/cms/achievement.svg') }}" alt=""  /> Επιτεύγματα</h3>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('cms.achievement_types.index') }}">Κατηγορίες Επιτευγμάτων</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{ $achievementType->name }}</li>
    </ol>
</nav>


@if (count($achievements) > 0)
<table class="table table-striped table-bordered table-hover table-sm">
    <thead>
        <tr>
            <th>Α/Α</th>
            <th>Id</th>
            <th>Τιμή</th>
            <th>Πόντοι</th>
            <th>Τελευταία τροποποίηση</th>
            <th>Ενέργειες</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($achievements as $achievement)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $achievement->id }}</td>
            <td>{{ $achievement->value }}</td>
            <td>{{ $achievement->points }}</td>
            <td>{{ $achievement->updated_at }}</td>
            <td nowrap>
                <form action="{{ route('cms.achievement_types.achievements.destroy', ['achievement_type'=>$achievementType->id, 'achievement'=>$achievement->id]) }}" class="pull-right" method="post">
                    @csrf
                    @method('delete')
                    <a class="btn btn-sm btn-info" href="{{ route('cms.achievement_types.achievements.edit', ['achievement_type'=>$achievementType->id, 'achievement'=>$achievement->id]) }}">Επεξεργασία</a>                
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
<a href="{{ route('cms.achievement_types.achievements.create', ['achievement_type'=>$achievementType->id]) }}" class="btn btn-primary btn-sm">Προσθήκη</a>
<p>&nbsp;</p>
@if(session()->has('message'))
<div class="alert alert-primary">{{ session()->get('message') }}</div>
@endif

@endsection
