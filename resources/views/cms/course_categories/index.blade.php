@extends('layouts.cms')
@section('content')
<h3><img height="32" src="{{ asset('svg/cms/university.svg') }}" alt=""  /> Κατηγορίες Μαθημάτων</h3>

@if (count($courseCategories) > 0)
<table class="table table-striped table-bordered table-hover table-sm">
    <thead>
        <tr>
            <th>Α/Α</th>
            <th>Id</th>
            <th></th>
            <th>Ονομασία</th>
            <th>Τελευταία τροποποίηση</th>
            <th>&nbsp;</th>
            <th>Ενέργειες</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($courseCategories as $courseCategory)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $courseCategory->id }}</td>
            <td class="text-center"><img src="{{ $courseCategory->picture }}" alt="" width="32"></td>
            <td>{{ $courseCategory->name }}</td>
            <td>{{ $courseCategory->updated_at }}</td>
            <td><a class="btn btn-sm btn-{{ $courseCategory->courses_count ? 'success': 'outline-success' }}" href="{{ route('cms.course_categories.courses.index', ['course_category'=>$courseCategory->id]) }}">Μαθήματα ({{ $courseCategory->courses_count }})</a></td>
            <td>
                <form action="{{ route('cms.course_categories.destroy', ['id'=>$courseCategory->id]) }}" class="pull-right" method="post">
                    @csrf
                    @method('delete')
                    <a class="btn btn-sm btn-info" href="{{ route('cms.course_categories.edit', ['id'=>$courseCategory->id]) }}">Επεξεργασία</a>                
                    <button class="btn btn-sm btn-danger{{ $courseCategory->courses_count ? ' disabled': '' }}">Διαγραφή</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@else
<p>Δεν υπάρχουν εγγραφές.</p>
@endif
<a href="{{ route('cms.course_categories.create') }}" class="btn btn-primary btn-sm">Προσθήκη</a>
<p>&nbsp;</p>
@if(session()->has('message'))
<div class="alert alert-primary">{{ session()->get('message') }}</div>
@endif

@endsection
