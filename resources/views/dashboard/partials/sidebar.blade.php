@inject('request', 'Illuminate\Http\Request')

<!--  SIDEBAR -->
<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element">
                    {{-- <span><center>
                        <img alt="image" class="img-circle img-responsive" src="{{ asset('backend-assets/ellipsis-techs-logo.png') }}" />
                    </center></span> --}}
                    <a data-toggle="dropdown" class="dropdown-toggle" href="javascript:void(0)">
                        <span class="clear">
                            <span class="block m-t-xs text-center">
                                <strong class="font-bold">
                                    {{ config('app.name', 'Laravel') }}
                                </strong>
                            </span>
                            {{-- <span class="text-muted text-xs block text-center">Software Solutions</span> --}}
                        </span>
                    </a>
                </div>
                <div class="logo-element">
                    SS
                </div>
            </li>

            <li class="{{ $request->segment(1) == 'home' ? 'active' : '' }}">
                <a href="{{ route('home') }}">
                    <i class="fa fa-th-large fa-fw"></i> <span class="nav-label">
                        {{ trans('lang.dashboard') }}
                    </span>
                </a>
            </li>

            @if(auth()->user()->hasRole('admin'))
            <li class="{{ $request->segment(1) == 'permission_role' ? 'active' : '' }}">
                <a href="{{ route('permission_role') }}">
                    <i class="fa fa-gears fa-fw"></i> <span class="nav-label">
                        {{ trans('lang.permission_role') }}
                    </span>
                </a>
            </li>

            <li class="{{ $request->segment(1) == 'users' ? 'active' : '' }}">
                <a href="{{ route('users') }}">
                    <i class="fa fa-users fa-fw"></i> <span class="nav-label">
                        {{ trans('lang.user.page_title') }}
                    </span>
                </a>
            </li>
            @endif

            <li class="{{ $request->segment(1) == 'transactions' || $request->segment(1) == 'payments' ? 'active' : '' }}">
                <a href="{{ route('transactions') }}">
                    <i class="fa fa-newspaper-o fa-fw"></i> <span class="nav-label">
                        {{ trans('lang.transaction.page_title') }}
                    </span>
                </a>
            </li>

        </ul>
    </div>
</nav>
