@extends('layouts.cms')
@section('content')
<h3><img height="32" src="{{ asset('svg/cms/age-range.svg') }}" alt=""  /> Ηλικιακά φάσματα</h3>

@if (count($ageRanges) > 0)
<table class="table table-striped table-bordered table-hover table-sm">
    <thead>
        <tr>
            <th>Α/Α</th>
            <th>Id</th>
            <th>Περιγραφή</th>
            <th>Ηλικία από</th>
            <th>Ηλικία έως</th>
            <th>Τελευταία τροποποίηση</th>
            <th>Ενέργειες</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($ageRanges as $ageRange)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $ageRange->id }}</td>
            <td>{{ $ageRange->description }}</td>
            <td>{{ $ageRange->age_from }}</td>
            <td>{{ $ageRange->age_to }}</td>
            <td>{{ $ageRange->updated_at }}</td>
            <td>
      <form action="{{ route('cms.age_ranges.destroy', ['id'=>$ageRange->id]) }}" class="pull-right" method="post">
              @csrf
              @method('delete')
              <a class="btn btn-sm btn-info" href="{{ route('cms.age_ranges.edit', ['id'=>$ageRange->id]) }}">Επεξεργασία</a>                
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
          <a href="{{ route('cms.age_ranges.create') }}" class="btn btn-primary btn-sm">Προσθήκη</a>
          <p>&nbsp;</p>
          @if(session()->has('message'))
          <div class="alert alert-primary">{{ session()->get('message') }}</div>
          @endif
          @endsection
