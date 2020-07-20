<aside id="left-panel" class="left-panel">
    <nav class="navbar navbar-expand-sm navbar-default">
        <div class="navbar-header">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fa fa-bars"></i>
            </button>
            <a class="navbar-brand" href="./"><img src="images/school.png" alt="Logo"></a>
            <a class="navbar-brand hidden" href="./">SN</a>
        </div>

        <div id="main-menu" class="main-menu collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="active">
                    <a href="home"> <i class="menu-icon fa fa-dashboard"></i>HOME </a>
                </li>
                @foreach ($menus as $key => $item)
                    @if ($item['parent'] == 0)
                        <h3 class="menu-title">{{ $item['name'] }}</h3>
                        @foreach ($item['submenu'] as $submenu)
                            @if ($submenu['submenu'] == [])
                                <li class="menu-item-has-children dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-laptop"></i>{{ $submenu['name'] }} YYY</a>
                                </li>
                            @endif
                        @endforeach

                    @else
                        <li class="menu-item-has-children dropdown">
                            @if ( count($item['submenu']))
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-laptop"></i>{{ $item['name'] }} XXX</a>
                            <ul class="sub-menu children dropdown-menu">
                                @foreach ($item['submenu'] as $submenu)
                                <li class="active"><i class="fa fa-puzzle-piece"></i><a href="ui-buttons.html">{{ $submenu['name'] }}</a></li>
                                @endforeach
                            </ul>
                            @endif
                        </li>
                    @endif
                @endforeach
            </ul>
        </div>
    </nav>
</aside>
