<!--  NAVBAR -->
<div class="row border-bottom" style="border-bottom: 5px solid #e7eaec !important;">
    <nav class="navbar navbar-static-top white-bg" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="javascript:void(0)"><i class="fa fa-bars"></i> </a>
        </div>
        <ul class="nav navbar-top-links navbar-right">
            <li>
                <span class="m-r-sm text-muted welcome-message">
                    {{ config('app.name', 'Laravel') }}
                </span>
            </li>
            @guest
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                </li>
            @else
                <li class="dropdown">
                    <a id="navbarDropdown"
                       class="dropdown-toggle count-info"
                       data-toggle="dropdown"
                       href="javascript:void(0)"
                       role="button"
                       aria-haspopup="true"
                       aria-expanded="false"
                       v-pre
                    >
                        <span style="color: #5eadbf;"><u>{{ Auth::user()->name }} <span class="caret"></span></u></span>
                    </a>
                    <ul class="dropdown-menu dropdown-messages" aria-labelledby="navbarDropdown">
                        <li>
                            <div class="dropdown-messages-box">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                    <i class="fa fa-sign-out"></i> Logout
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    </ul>
                </li>
            @endguest
        </ul>
    </nav>
</div>
