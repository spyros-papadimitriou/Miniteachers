@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 text-md-left text-sm-center">
            <h5>
                @if (isset($municipality))
                {{ $municipality->name }}<br /><small>({{ $municipality->regionalUnit->name }}, {{ $municipality->regionalUnit->region->name }})</small>
                @elseif (isset($regionalUnit))
                {{ $regionalUnit->name }}<br />
                <small>{{ $regionalUnit->region->name }}</small>
                @else
                <small>Μπορείτε να επιλέξτε Δήμο ή Περιφερειακή Ενότητα ώστε να περιορίσετε τα αποτελέσματα αναζήτησης στην περιοχή που σας ενδιαφέρει.</small>
                @endif
            </h5>
        </div>
        <div class="col-md-6 text-md-right text-sm-center">
            <h2 class="mb-0">{{ $course->name }}</h2>
            <span class="text-muted small">Αναζήτηση {{ $search->userType->name }}</span>
        </div>
    </div>
    <hr />
    <div class="row mb-3">
        <div class="col-md-12 text-sm-center text-md-left">
            @foreach ($regions as $region)
            <button type="button" class="btn btn-outline-info btn-sm mb-3" data-toggle="modal" data-target="#region{{ $region->id }}">
                {{ $region->name }}
            </button>

            <!-- Modal -->
            <div class="modal fade" id="region{{ $region->id }}" tabindex="-1" role="dialog" aria-labelledby="modalLabel{{ $region->id }}" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalLabel{{ $region->id }}">{{ $region->name }}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            @foreach ($region->regionalUnits as $regionalUnit)
                            @if ($loop->iteration % 4 == 1)
                            <div class="card-group mb-3">
                                @endif
                                <div class="card small">
                                    <div class="card-header">
                                        <a href="{{ route('search-by-course-and-regional-unit', ['course'=>$course->id, 'slug_course'=>str_slug($course->name), 'regional_unit'=>$regionalUnit->id, 'slug_regional_unit' => str_slug($regionalUnit->name)]) }}">{{ $regionalUnit->name }}</a>
                                    </div>
                                    <div class="card-body">
                                        @foreach ($regionalUnit->municipalities as $municipality)
                                        <a href="{{ route('search-by-course-and-municipality', ['course'=>$course->id, 'slug_course'=>str_slug($course->name), 'municipality'=>$municipality->id, 'slug_municipality' => str_slug($municipality->name)]) }}">{{ $municipality->name }}</a><br />
                                        @endforeach
                                    </div>
                                </div>
                                @if ($loop->iteration % 4 == 0 || $loop->last)
                            </div>
                            @endif
                            @endforeach
                        </div>
                        <div class="modal-footer">
                            <div class="col-md-9">
                                <span class="text-muted small">Επιλέξτε συγκεκριμένο Δήμο ή ολόκληρη Περιφερειακή Ενότητα που σας ενδιαφέρει.</span>
                            </div>
                            <div class="col-md-3 text-right">
                                <button type="button" class="btn btn-outline-danger btn-sm" data-dismiss="modal">Άκυρο</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    @includeWhen($users, 'search.users')
</div>
@endsection