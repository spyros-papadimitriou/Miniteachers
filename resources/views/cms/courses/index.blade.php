@extends('layouts.cms')
@section('content')
<h3><img height="32" src="{{ asset('svg/cms/course.svg') }}" alt=""  /> Μαθήματα</h3>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('cms.course_categories.index') }}">Κατηγορίες Μαθημάτων</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{ $courseCategory->name }}</li>
    </ol>
</nav>


@if (count($courses) > 0)
<table class="table table-striped table-bordered table-hover table-sm">
    <thead>
        <tr>
            <th>Α/Α</th>
            <th>Id</th>
            <th>&nbsp;</th>
            <th>Ονομασία</th>
            <th>Τελευταία τροποποίηση</th>
            <th>Ενέργειες</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($courses as $course)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $course->id }}</td>
            <td class="text-center"><img src="{{ $course->picture }}" alt="" width="32"></td>
            <td>{{ $course->name }}</td>
            <td>{{ $course->updated_at }}</td>
            <td nowrap>
                <form action="{{ route('cms.course_categories.courses.destroy', ['course_category'=>$courseCategory->id, 'course'=>$course->id]) }}" class="pull-right" method="post">
                    @csrf
                    @method('delete')
                    <a class="btn btn-sm btn-info" href="{{ route('cms.course_categories.courses.edit', ['course_category'=>$courseCategory->id, 'course'=>$course->id]) }}">Επεξεργασία</a>                
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
<a href="{{ route('cms.course_categories.courses.create', ['course_category'=>$courseCategory->id]) }}" class="btn btn-primary btn-sm">Προσθήκη</a>
<p>&nbsp;</p>
@if(session()->has('message'))
<div class="alert alert-primary">{{ session()->get('message') }}</div>
@endif

@endsection
