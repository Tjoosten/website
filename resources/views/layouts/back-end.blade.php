<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

        <title>Scouts en gidsen Sint-Joris | Backend</title>
   
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
        <link rel="stylesheet" href="{{ asset('assets/css/AdminLTE.css') }}" />
        <link rel="stylesheet" href="{{ asset('assets/css/_all-skins.css') }}">

        {{-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries --}}
        {{-- WARNING: Respond.js doesn't work if you view the page via file:// --}}
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

        <script> window.Laravel = <?php echo json_encode(['csrfToken' => csrf_token()]); ?></script>
    </head>
<body class="hold-transition @if(isset(auth()->user()->theme)) {{ auth()->user()->theme }} @else skin-blue @endif sidebar-mini">
    {{-- Site wrapper --}}
    <div class="wrapper">

        <header class="main-header">
            {{-- Logo --}}
            <a href="../../index2.html" class="logo">
                {{-- mini logo for sidebar mini 50x50 pixels --}}
                <span class="logo-mini"><b>S</b></span>
                {{-- logo for regular state and mobile devices --}}
                <span class="logo-lg"><b>S</b>ijot</span>
            </a>
            {{-- Header Navbar: style can be found in header.less --}}
            <nav class="navbar navbar-static-top">
                {{-- Sidebar toggle button--}}
                <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>

                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        {{-- Notifications: style can be found in dropdown.less --}}
                        @if (count(auth()->user()->unreadNotifications) > 0)
                        <li class="dropdown notifications-menu">
                            <!-- Menu toggle button -->
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-bell-o"></i>
                                <span class="label label-warning">10</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="header">You have 10 notifications</li>
                                <li>
                                    <!-- Inner Menu: contains the notifications -->
                                    <ul class="menu" style="overflow: hidden; width: 100%; height: auto !important;">
                                        <li>
                                            <!-- start notification -->
                                            <a href="#">
                                                <i class="fa fa-users text-aqua"></i>5 new members joined today
                                            </a>
                                        </li><!-- end notification -->
                                    </ul>
                                </li>
                                <li class="footer">
                                    <a href="#">View all</a>
                                </li>
                            </ul>
                        </li>
                        @else
                           <li class="notifications-menu">
                               <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                   <i class="fa fa-bell-o"></i>
                                   <span class="label label-warning">0</span>
                               </a>
                           </li>
                        @endif
                        
                        {{-- User Account: style can be found in dropdown.less --}}
                        <li class="user user-menu">
                            <a href="{{ route('settings.profile') }}">
                                <img src="https://placehold.it/160x160" class="user-image" alt="{{ auth()->user()->name }}">
                                <span class="hidden-xs">{{ auth()->user()->name }}</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('/logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <span class="fa fa-sign-out"></span>
                            </a>

                            <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>

        {{-- =============================================== --}}
        {{-- Left side column. contains the sidebar --}}
        <aside class="main-sidebar">
            {{-- sidebar: style can be found in sidebar.less --}}
            <section class="sidebar">
                {{-- Sidebar user panel --}}
                <div class="user-panel">
                    <div class="pull-left image">
                        <img src="https://placehold.it/160x160" class="img-circle" alt="User Image">
                    </div>
                    <div class="pull-left info">
                        <p>{{ auth()->user()->name }}</p>
                        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                    </div>
                </div>
                {{-- search form --}}
                <form action="#" method="get" class="sidebar-form">
                    <div class="input-group">
                        <input type="text" name="q" class="form-control" placeholder="Search...">
                        <span class="input-group-btn">
                            <button type="submit" name="search" id="search-btn" class="btn btn-flat">
                                <i class="fa fa-search"></i>
                            </button>
                        </span>
                    </div>
                </form>
                {{-- /.search form --}}
                {{-- sidebar menu: : style can be found in sidebar.less --}}
                <ul class="sidebar-menu">
                    <li class="header">MAIN NAVIGATION</li>
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-home"></i> <span>Verhuur</span>
                            <span class="pull-right-container">
                                <small class="label pull-right bg-yellow">{{ $option }}</small>
                                <small class="label pull-right bg-green">{{ $confirmed }}</small>
                                <small class="label pull-right bg-red">{{ $new }}</small>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="#"><i class="fa fa-circle-o"></i> Verhuur overzicht</a></li>
                            <li><a href="#"><i class="fa fa-circle-o"></i> Verhuur toevoegen</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fa fa-leaf"></i>
                            <span>Takken</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('users.index') }}">
                            <i class="fa fa-group"></i>
                            <span>{{ trans('backend-theme.login-management') }}</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('activity.index') }}">
                            <i class="fa fa-file-text-o"></i>
                            <span>{{ trans('backend-theme.activities')}}</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('settings.index') }}">
                            <i class="fa fa-cogs"></i>
                            <span>Website instellingen</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('news.backend.index') }}">
                            <i class="fa fa-asterisk"></i>
                            <span>Nieuws berichten</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('backend.mailing.index') }}">
                            <i class="fa fa-envelope"></i>
                            <span>Mailing</span>
                        </a>
                    </li>
                </ul>
            </section>
            {{-- /.sidebar --}}
        </aside>

        {{-- =============================================== --}}
        {{-- Content Wrapper. Contains page content --}}
        <div class="content-wrapper">
            {{-- Content Header (Page header) --}}
            <section class="content-header">
                @yield('content-header')
            </section>

            {{-- Main content --}}
            <section class="content">

                {{-- Default box --}}
                    @yield('content')
                {{-- /.box --}}

            </section>
            {{-- /.content --}}
        </div>
        {{-- /.content-wrapper --}}

        <footer class="main-footer">
            <div class="pull-right hidden-xs">
                <b>Version</b> 1.0.0-alpha
            </div>
            <strong>Copyright &copy; 2014-{{ date('Y')}} </strong>Tim Joosten.  Alle rechten voorbehouden.
        </footer>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="{{ asset('assets/js/jquery.slimscroll.min.js') }}"></script>
    <script src="{{ asset('assets/js/fastclick.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
