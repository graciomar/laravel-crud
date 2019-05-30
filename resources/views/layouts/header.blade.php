<header id="header" class="header">
    <div class="header-menu">
        <div class="col-sm-4">
            <div class="user-area dropdown float-left">
                @if (Route::has('login'))
                    <div class="top-right links">
                        @auth
                            <a href="{{ url('/home') }}"><i class="fa fa-user"></i> {{Auth::user()->name}}</a>
                        @else
                            <a href="{{ route('login') }}"><strong>Login</strong></a>

                            @if (Route::has('register'))
                                <a href="{{ route('register') }}">Register</a>
                            @endif
                        @endauth
                    </div>
                @endif                    
            </div>
        </div>

        <div class="col-sm-8">
            <div class="page-header float-right">
                <a href="logout" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Logout</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
            </div>
        </div>
    </div>

</header>