@extends('layouts.cms')
@section('content')
<h3><img height="32" src="{{ asset('svg/cms/gender.svg') }}" alt=""  /> Φύλα</h3>

@if (count($genders) > 0)
<table class="table table-striped table-bordered table-hover table-sm">
    <thead>
        <tr>
            <th>Α/Α</th>
            <th>Id</th>
            <th>Ονομασία</th>
            <th>Τελευταία τροποποίηση</th>
            <th>Ενέργειες</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($genders as $gender)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $gender->id }}</td>
            <td>{{ $gender->name }}</td>
            <td>{{ $gender->updated_at }}</td>
            <td>
      <form action="{{ route('cms.genders.destroy', ['id'=>$gender->id]) }}" class="pull-right" method="post">
              @csrf
              @method('delete')
              <a class="btn btn-sm btn-info" href="{{ route('cms.genders.edit', ['id'=>$gender->id]) }}">Επεξεργασία</a>                
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
          <a href="{{ route('cms.genders.create') }}" class="btn btn-primary btn-sm">Προσθήκη</a>
          <p>&nbsp;</p>
          @if(session()->has('message'))
          <div class="alert alert-primary">{{ session()->get('message') }}</div>
          @endif

          <div>Icons made by <a href="https://www.flaticon.com/authors/freepik" title="Freepik">Freepik</a> from <a href="https://www.flaticon.com/" title="Flaticon">www.flaticon.com</a> is licensed by <a href="http://creativecommons.org/licenses/by/3.0/" 		    title="Creative Commons BY 3.0" target="_blank">CC 3.0 BY</a></div>
          @endsection
