@extends('layouts.cms')
@section('content')
<h3><img height="32" src="{{ asset('svg/cms/achievement.svg') }}" alt=""  /> Κατηγορίες Επιτευγμάτων</h3>

@if (count($achievementTypes) > 0)
<table class="table table-striped table-bordered table-hover table-sm">
    <thead>
        <tr>
            <th>Α/Α</th>
            <th>Id</th>
            <th>&nbsp;</th>
            <th>Ονομασία</th>
            <th>Τελευταία τροποποίηση</th>
            <th>&nbsp;</th>
            <th>Ενέργειες</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($achievementTypes as $achievementType)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $achievementType->id }}</td>
            <td class="text-center"><img src="{{ $achievementType->picture }}" alt="" height="32"></td>
            <td>{{ $achievementType->name }}</td>
            <td>{{ $achievementType->updated_at }}</td>
            <td><a class="btn btn-sm btn-{{ $achievementType->achievements_count ? 'success': 'outline-success' }}" href="{{ route('cms.achievement_types.achievements.index', ['achievement_type'=>$achievementType->id]) }}">Επιτεύγματα ({{ $achievementType->achievements_count  }})</a></td>
            <td nowrap>
                <form action="{{ route('cms.achievement_types.destroy', ['id'=>$achievementType->id]) }}" class="pull-right" method="post">
                    @csrf
                    @method('delete')
                    <a class="btn btn-sm btn-info" href="{{ route('cms.achievement_types.edit', ['achievement_type'=>$achievementType->id]) }}">Επεξεργασία</a>                
                    <button class="btn btn-sm btn-danger"{{ $achievementType->achievements_count ? 'disabled': '' }}>Διαγραφή</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@else
<p>Δεν υπάρχουν εγγραφές.</p>
@endif
<a href="{{ route('cms.achievement_types.create') }}" class="btn btn-primary btn-sm">Προσθήκη</a>
<p>&nbsp;</p>
@if(session()->has('message'))
<div class="alert alert-primary">{{ session()->get('message') }}</div>
@endif

@endsection
