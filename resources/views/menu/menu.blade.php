<ul class="navbar-nav ml-auto">
    <li class="nav-item dropdown">
        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
            @if (Auth::user()->userStat->published == 0)
            <img src='{{ asset('svg/warning.svg') }}' alt='' title="Το προφίλ σας είναι μη δημοσιευμένο" height="24">
            @endif
            {{ Auth::user()->name }}
            <span class="caret"></span>
        </a>

        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

            <a class="dropdown-item" href="{{ route('conversations.index') }}"><img height="24" src="{{ asset('svg/mail.svg') }}" alt=""> 
                Συζητήσεις - Μηνύματα
            </a>
            <div class="dropdown-divider"></div>

            <a class="dropdown-item" href="#"><img height="24" src="{{ asset('svg/points.svg') }}" alt=""> Ιστορικό Πόντων</a>
            <a class="dropdown-item" href="#"><img height="24" src="{{ asset('svg/trophy.svg') }}" alt=""> Επιτεύγματα</a>
            <div class="dropdown-divider"></div>

            <a class="dropdown-item" href="{{ route('profile-show') }}"><img height="24" src="{{ asset('svg/avatar'.Auth::user()->gender->id.'.svg') }}" alt=""> Προβολή Προφίλ</a>

            <a class="dropdown-item" href="{{ route('profile.basic-info.edit', ["user"=>Auth::user()->id]) }}"><img height="24" src="{{ asset('svg/edit-profile'.Auth::user()->gender->id.'.svg') }}" alt=""> Επεξεργασία Προφίλ{!! (Auth::user()->userStat->published == 0 ? ' <small class="text-danger">(μη δημοσιευμένο)</small>': '') !!}</a>

            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="{{ route('gdpr-index') }}"><img height="24" src="{{ asset('svg/gdpr.svg') }}" alt=""> GDPR - Δικαιώματα</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="{{ route('logout') }}"
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