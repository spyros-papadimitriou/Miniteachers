<div class="row">
    <div class="col-md-12">
        @if (count($users) > 0)
        @foreach ($users as $user)
        @if ($loop->iteration % 4 == 1)
        <div class="row mb-3">
            <div class="col-md-{{ $loop->count - $loop->iteration + 1 >= 4 ? 12: ($loop->count - $loop->iteration + 1) * 3 }}">
                <div class="card-deck">
                    @endif

                    <div class="card">
                        @if ($user->picture)
                        <a href="{{ route('profile-slug-show', ['user'=>$user->id, 'slug'=>str_slug($user->name)]) }}"><img class="card-img-top" src="{{ asset('uploads/users/'.$user->picture) }}" alt="" title="{{ $user->name }}"></a>
                        @else
                        <a href="{{ route('profile-slug-show', ['user'=>$user->id, 'slug'=>str_slug($user->name)]) }}"><img style="width: 100%;" class="card-img-top" src="{{ route('svg-user', ['user' => $user->id]) }}" alt="" title="{{ $user->name }}"></a>
                        @endif

                        <div class="card-header">
                            <a href="{{ route('profile-slug-show', ['user'=>$user->id, 'slug'=>str_slug($user->name)]) }}">{{ $user->name }}</a>
                        </div>

                        <div class="card-body">
                            <div class="small">
                                Επίπεδο: <span class="badge badge-primary">{{ $user->gender->id == 1 ? $user->userStat->level->name_male: $user->userStat->level->name_female }}</span><br />
                                Minipoints:  <span class="badge badge-primary">{{ $user->userStat->points }}</span><br />

                                {{ $user->userType->id == App\UserType::TEACHER ? 'Τιμή ανά ώρα:': 'Μέγιστη επιθυμητή τιμή χρέωσης:'}}
                                {!! $user->userStat->price_per_hour > 0 ? $user->userStat->price_per_hour. ' &euro;': 'Συζητήσιμη' !!}<br />

                                {{ $user->userType->id == App\UserType::TEACHER ? 'Εμπειρία:': 'Επιθυμητή εμπειρία miniteacher:'}}
                                {{ $user->userStat->experience->name }}
                                @if (count($user->courses) > 0)
                                <br />Μαθήματα:
                                @foreach ($user->courses as $userCourse)
                                @if (!$loop->last)
                                @if ($userCourse->id == $course->id)
                                <u>{{ $userCourse->name }}</u>,
                                @else
                                {{ $userCourse->name }},
                                @endif                                        
                                @else

                                @if ($userCourse->id == $course->id)
                                <u>{{ $userCourse->name }}</u>
                                @else
                                {{ $userCourse->name }}
                                @endif   

                                @endif
                                @endforeach
                                @endif
                                @if (count($user->websites) > 0)
                                <br />
                                Ιστοσελίδες:
                                @foreach ($user->websites as $website)
                                @php($url = str_replace('[value]', $website->pivot->value, $website->url_pattern))
                                @if (!$loop->last)
                                <a href='{{ $url }}' target="_blank">{{ $website->name }}</a>,
                                @else
                                <a href='{{ $url }}' target="_blank">{{ $website->name }}</a>
                                @endif
                                @endforeach
                                @endif

                                @if (count($user->adjectives) > 0)
                                <hr />
                                @foreach ($user->adjectives as $adjective)
                                <span class="badge badge-light" data-toggle="tooltip" data-placement="top" title="{{ $user->id_gender == \App\Gender::MALE ? $adjective->description_male: $adjective->description_female }}">{{ $user->id_gender == \App\Gender::MALE ? $adjective->name_male: $adjective->name_female }}</span>
                                @endforeach
                                @endif
                            </div>
                        </div>     
                    </div>

                    @if ($loop->iteration % 4 == 0 || $loop->last)
                </div>
            </div>
        </div>
        @endif
        @endforeach
        @else
        <p>Δεν υπάρχουν εγγραφές με τα κριτήρια που θέσατε.</p>
        @endif
    </div>
</div>
<div class="row mt-3">
    <div class="col-md-12">
        <div class="small">
            {{ $users->appends(request()->query())->links() }}
        </div>
    </div>
</div>