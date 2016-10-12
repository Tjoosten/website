@extends('layouts.front-end')

@section('content')
<div class="row">
    <div class="col-sm-12">
        <img src="{{ asset('assets/img/front.jpg') }}" style="height:400px; width:100%; border-top-right-radius: 6px; border-top-left-radius: 6px;" alt="Alternate Text" />
    </div>
</div>
<div class="content-margin row">
    <div class="col-sm-12">
        <div class="content-border panel panel-default">
            <div class="panel-body">
                <div class="col-md-8">
                    <h3>Verhuur aanvraag.</h3>

                    <div class="alert alert-danger">
                        <span class="fa fa-info-circle"></span> Het laatste weekend van een maand verhuren we niet.
                    </div>
                    
                    {{-- Request form --}}
                    <form class="form-horizontal" method="POST" action="{{ route('rental.store') }}">
                        {{-- CSRF TOKEN --}}
                        {{ csrf_field() }}

                        <div class="form-group {{ $errors->has('start_date') ? 'has-error' : '' }}">
                            <label class="control-label col-sm-2" id="start">
                                Start datum: <span class="text-danger">*</span>
                            </label>

                            <div class="col-sm-4">
                                <input placeholder="Start datum" type="date" id="start" name="start_date" value="{{ old('start_date') }}" class="form-control" />
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('end_date') ? 'has-error' : '' }}">
                            <label class="control-label col-sm-2" id="eind">
                                Eind datum: <span class="text-danger">*</span> 
                            </label>

                            <div class="col-sm-4">
                                <input placeholder="Eind datum" type="date" id="eind" name="end_date" value="{{ old('end_date') }}" class="form-control" />
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('group') ? 'has-error' : '' }}">
                            <label class="control-label col-sm-2" id="groep">
                                Groep: <span class="text-danger">*</span>
                            </label>

                            <div class="col-sm-4">
                                <input class="form-control" placeholder="Groep naam" value="{{ old('group') }}" name="group" id="groep">
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                            <label id="email" class="control-label col-sm-2">
                                Email adres: <span class="text-danger">*</span>
                            </label>   

                            <div class="col-sm-4">
                                <input class="form-control" placeholder="Email adres" value="{{ old('email') }}" name="email" id="email">
                            </div>
                        </div>

                        <div class="form-group">
                            <label id="tel" class="control-label col-sm-2">
                                Nummer:  {{-- <span class="text-danger">*</span> --}}
                            </label> 

                            <div class="col-sm-4">
                                <input type="text" class="form-control" placeholder="GSM nummer" value="{{ old('phone_number') }}" name="phone_number" id="tel">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-5 col-sm-offset-2">
                                <button type="submit" class="btn btn-sm btn-success">Aanvragen</button> 
                                <button type="reset" class="btn btn-sm btn-danger">Reset</button>
                            </div>
                        </div>

                    </form>
                    {{-- /Request form --}}
                </div>

                <div class="col-md-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">Menu:</div>

                        <div class="list-group">
                            <a href="{{route('rental.frontend.index') }}" class="list-group-item">
                                <span class="fa fa-info-circle"></span> Informatie
                            </a>
                             <a href="{{ route('rental.frontend.reachable') }}" class="list-group-item">
                                <span class="fa fa-asterisk"></span>Bereikbaarheid
                            </a>
                            <a href="{{ route('rental.frontend-calendar') }}" class="list-group-item">
                                <span class="fa fa-calendar"></span>
                                Verhuur kalender
                            </a>
                            <a href="{{ route('rental.frontend.insert') }}" class="list-group-item">
                                <span class="fa fa-asterisk"></span>
                                Verhuur aanvragen
                            </a>
                            <a href="mailto:contact@st-joris-turnhout.be" class="list-group-item">
                                <span class="fa fa-envelope"></span> Contact
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<footer class="footer-bs">
    <div class="row">
        <div class="col-md-7 footer-brand animated fadeInLeft">
            <h2>Over ons</h2>
            <p>
                Wij zijn een gemenge scoutsgroep die elke zondag van de maand, van 2u tot 5u vergaderingen houd.
                Buiten de laatste zondag van de maand dan is het van 101u tot 5u. voor de rest zijn wij geleden te <br>
                Sint-Jorislaan 11, 2300 Turnhout.
            </p>

            <p>&copy; 2015 - {{ date('Y') }} Scouts en Gidsen - Sint Joris, Turnhout</p>
        </div>
        <div class="col-md-2 footer-social animated fadeInDown">
            <h4>Social Media</h4>
            <ul>
                <li><a href="#">Facebook</a></li>
                <li><a href="#">Twitter</a></li>
                <li><a href="#">Instagram</a></li>
            </ul>
        </div>
        <div class="col-md-3 footer-ns animated fadeInRight">
            <h4>Nieuwsbrief</h4>
            <p>Wilt u op de hoogte blijven? Kunt u zich hier inschrijven op de nieuwsbrief. Zodat u op de hoogte blijft.</p>
            <p>
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Email adres">
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="button"><span class="fa fa-envelope"></span></button>
                    </span>
                </div><!-- /input-group -->
            </p>
        </div>
    </div>
</footer>
@endsection