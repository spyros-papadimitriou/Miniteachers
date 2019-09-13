<ul class="navbar-nav ml-auto">
    <li class="nav-item dropdown">
        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
            @if (Auth::user()->userStat->published == 0)
            <img src='{{ asset('svg/warning.svg') }}' alt='' title="Το προφίλ σας είναι μη δημοσιευμένο" height="24">
            @endif
            @if ($totalUnreadMessages)
            <img src='{{ asset('svg/mail.svg') }}' alt='' title="Έχετε νέα μηνύματα" height="24">
            @endif
            {{ Auth::user()->name }}
            <span class="caret"></span>
        </a>

        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
            @admin
            <a class="dropdown-item small" href="{{ route('cms.dashboard') }}" target="_blank"><img height="24" src="{{ asset('svg/admin.svg') }}" alt=""> Διαχείριση</a>
            <div class="dropdown-divider"></div>
            @endadmin            

            <a class="dropdown-item small" href="{{ route('conversations.index') }}"><img height="24" src="{{ asset('svg/mail.svg') }}" alt=""> 
                Συζητήσεις - Μηνύματα
                @if ($totalUnreadMessages)
                <br /><small class="text-danger">Έχετε νέα μηνύματα: {{ $totalUnreadMessages }}</small>
                @endif
            </a>
            <div class="dropdown-divider"></div>

            <a class="dropdown-item small" href="{{ route('points') }}"><img height="24" src="{{ asset('svg/points.svg') }}" alt=""> Ιστορικό Πόντων</a>
            <a class="dropdown-item small" href="{{ route('achievements') }}"><img height="24" src="{{ asset('svg/trophy.svg') }}" alt=""> Επιτεύγματα</a>
            <a class="dropdown-item small" href="{{ route('leaderboard') }}"><img height="24" src="{{ asset('svg/podium.svg') }}" alt=""> Leaderboard</a>
            <div class="dropdown-divider"></div>

            <a class="dropdown-item small" href="{{ route('profile-show') }}"><img height="24" src="{{ asset('svg/usertypes/avatar-'.Auth::user()->userType->id.'-'.Auth::user()->gender->id.'.svg') }}" alt=""> Προβολή Προφίλ</a>

            <a class="dropdown-item small" href="{{ route('profile.basic-info.edit', ["user"=>Auth::user()->id]) }}"><img height="24" src="{{ asset('svg/usertypes/edit-profile-'.Auth::user()->userType->id.'-'.Auth::user()->gender->id.'.svg') }}" alt=""> Επεξεργασία Προφίλ{!! (Auth::user()->userStat->published == 0 ? ' <small class="text-danger">(μη δημοσιευμένο)</small>': '') !!}</a>

            <div class="dropdown-divider"></div>
            <a class="dropdown-item small" href="{{ route('analytics') }}"><img height="24" src="{{ asset('svg/analytics.svg') }}" alt=""> Analytics αναζητήσεων</a>
            <a class="dropdown-item small" href="{{ route('statistics') }}"><img height="24" src="{{ asset('svg/presentation.svg') }}" alt=""> Στατιστικά</a>
            <div class="dropdown-divider"></div>

            <a class="dropdown-item small" href="{{ route('gdpr-index') }}"><img height="24" src="{{ asset('svg/gdpr.svg') }}" alt=""> GDPR - Δικαιώματα</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item small" href="{{ route('logout') }}"
               onclick="event.preventDefault();
                       document.getElementById('logout-form').submit();">
                <img height="24" src="{{ asset('svg/exit.svg') }}" alt="">  {{ __('Έξοδος') }}
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>
    </li>
</ul>