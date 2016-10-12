<!DOCTYPE html>
<html lang="nl">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="description" content="Web site van scouts en gidsen Sint-joris | Turnhout">
        <meta name="author" content="Scouts en Gidsen - Sint-Joris">
        
        <title> Scouts en Gidsen Sint-Joris Turnhout </title> 
        
        <link rel="icon" href="{{ asset('favicon.ico') }}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
        <link rel="stylesheet" href="{{ asset('css/app.css')}}">
        
        {{-- IE10 vieuwport hack for Surface/Desktop Windows 8 bug --}}
        <link rel="stylesheet" href="{{ asset('assets/css/ie-10-viewport-bug-workaround.css') }}">

        <script> window.Laravel = <?php echo json_encode(['csrfToken' => csrf_token()]); ?></script>
    </head>
    <body class="background front-end">
        {{-- Navigation bar --}}
        <nav class="navbar navbar-inverse navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    
                    <a class="navbar-brand font-heading" href="{{ route('home') }}">Sint-Joris</a>
                </div>
                
                <div id="navbar" class="collapse navbar-collapse">
                    {{-- Left navbar --}}
                    <ul class="nav navbar-nav">
                        <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="{{ route('frontend.groups') }}">
                                <span class="icon-green fa fa-leaf"></span> Takken
                            </a>
                            
                            <ul class="dropdown-menu">
                                <li><a href=""><span class="fa fa-asterisk"></span> De kapoenen</a></li>
                                <li><a href=""><span class="fa fa-asterisk"></span> De Welpen</a></li>
                                <li><a href=""><span class="fa fa-asterisk"></span> De Jong-Givers</a></li>
                                <li><a href=""><span class="fa fa-asterisk"></span> De Givers</a></li>
                                <li><a href=""><span class="fa fa-asterisk"></span> De Jins</a></li>
                                <li><a href=""><span class="fa fa-asterisk"></span> De Leiding</a></li>
                            </ul>
                        </li>
                        
                        <li>
                            <a href="{{ route('rental.frontend.index') }}">
                                <span class="icon-green fa fa-home"></span> Verhuur
                            </a>
                        </li>
                        
                        <li>
                            <a href="">
                                <span class="icon-green fa fa-picture-o"></span> Foto's
                            </a>
                        </li>
                        
                        <li>
                            <a href="">
                                <span class="icon-green fa fa-file-text-o"></span> Planning
                            </a>
                        </li>
                        
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <span class="icon-green fa fa-info-circle"></span> Info
                            </a>

                            <ul class="dropdown-menu">
                                <li><a href="https://groepsadmin.scoutsengidsenvlaanderen.be/groepsadmin/lidworden?groep=A4102G">Lid worden</a></li>
                                <li><a href="https://www.scoutsengidsenvlaanderen.be/publicatie/individuele-steekkaart">Medische fiche.</a></li>
                            </ul>
                        </li>
                        
                        <li>
                            <a href="mailto:contact@st-joris-turnhout.be">
                                <span class="icon-green fa fa-envelope"></span> Contact
                            </a>
                        </li>
                    </ul>
                    
                    {{-- Right navbar. (authencation) --}}
                    <ul class="nav navbar-nav navbar-right">
                        @if (Auth::check())
                            <li>
                                <a href="">
                                    <span class="icon-green fa fa-chevron-circle-right"></span> Backend
                                </a>
                            </li>
                            <li>
                                <a href="{{ url('/logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    Uitloggen
                                </a>

                                <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        @else
                            <li>
                                <a href="{{ url('login') }}">
                                    <span class="icon-green fa fa-sign-in"></span> Login
                                </a>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>
        
        {{-- Content --}}
        <div class="container">
            {{-- Cookie consent --}}
            <div class="row">
                <div class="col-sm-12">
                    @include('cookieConsent::index')
                </div>
            </div>
            {{-- Cookie consent --}}

            @yield('content')
        </div>
    
        {{-- Javascript --}}
        <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </body>
</html>
