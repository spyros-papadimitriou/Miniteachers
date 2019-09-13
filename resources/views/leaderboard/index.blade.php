@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h5><img src='{{ asset('svg/podium.svg') }}' height="32" alt=''> Leaderboard</h5>
            <hr />
        </div>
    </div>

    <div class="row">
        <div class="col-md-9">
            @if (count($users) > 0)
            <table class="table small table-striped table-hover table-sm text-center">
                <thead class="thead-light">
                    <tr>
                        <th>Α/Α</th>
                        <th>Όνομα</th>
                        <th>Τύπος χρήστη</th>
                        <th>Μαθήματα</th>
                        <th>Επίπεδο</th>
                        <th>Minipoints</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($users as $user)
                    <tr>
                        <td>{{ ($users ->currentpage()-1) * $users ->perpage() + $loop->index + 1 }}.</td>
                        <td>
                            <a href='{{ route('profile-slug-show', ['user'=>$user->id, 'slug'=>str_slug($user->name)]) }}' target="_blank">{{ $user->name }}</a><br />
                            <small class="text-muted">{{ $user->id_gender == \App\Gender::MALE ? $user->userStat->level->name_male: $user->userStat->level->name_female }}</small>
                        </td>
                        <td>
                            {{ $user->userType->name }}
                        </td>
                        <td>
                            @forelse ($user->courses as $course)
                            @if (!$loop->last)
                            <a href="{{ route('search-by-course', ['course' => $course->id, 'slug'=>str_slug($course->name)]) }}" target="_blank">{{ $course->name }}</a>,
                            @else
                            <a href="{{ route('search-by-course', ['course' => $course->id, 'slug'=>str_slug($course->name)]) }}" target="_blank">{{ $course->name }}</a>
                            @endif
                            @empty
                            -
                            @endforelse
                        </td>
                        <td>Επίπεδο {{ $user->userStat->level->id }}</td>
                        <td>
                            <span class="badge badge-info">{{ $user->userStat->points }}</span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="small">{{ $users->links() }}</div>
            @else
            <p>Ακόμα να μπει κάποιος χρήστης στην πλατφόρμα; Δεν υπάρχουν εγγραφές!!!</p>
            @endif
        </div>

        <div class="col-md-3">
            @tip(leaderboard)
        </div>
    </div>
</div>
@endsection
