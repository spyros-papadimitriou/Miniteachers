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
            <a class="dropdown-item" href="{{ route('cms.dashboard') }}" target="_blank"><img height="24" src="{{ asset('svg/admin.svg') }}" alt=""> Διαχείριση</a>
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