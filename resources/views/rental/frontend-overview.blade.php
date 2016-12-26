@extends('layouts.front-end')

{{-- TODO: Set the rental pictures local --}}

@section('content')
<div class="row">
    <div class="col-sm-12">
        <img src="{{ asset('assets/img/front.jpg') }}" style="height:400px; width:100%; border-top-right-radius: 6px; border-top-left-radius: 6px;" alt="Alternate Text" />
    </div>
</div>
<div style="margin-bottom: -22px;" class="row">
    <div class="col-sm-12">
        <div style="border-radius:0px; border: 0px;" class="panel panel-default">
            <div class="panel-body">
                <div class="col-md-8">
                    <h3>Verhuur info.</h3>
                    
                    <p>
                        Onze Lokalen zijn het hele jaar te huur voor verenigingen.<br>
                        Of je een kampplaats in een mooie, avontuurlijke omgeving met speelterrein voor kinderen.<br>
                        een overnachtings plaats zoekt, of ...! We zijn rustig gelegen nabij het stadspark van Turnhout.<br>
                    </p>

                    <div class="row">
                        <div class="col-sm-6">
                            <img style="width: 100%; height: 200px;" src="http://st-joris-turnhout.be/assets/files/1.jpg" class="img-rounded img-thumbnail" alt="Verhuur foto 1" />
                        </div>

                        <div class="col-sm-6">
                            <img style="width: 100%; height: 200px;" src="http://st-joris-turnhout.be/assets/files/2.jpg" class="img-rounded img-thumbnail" alt="Verhuur foto 2" />
                        </div>
                    </div>

                    <p style="margin-top: 7px;">
                        Onze lokalen Bestaan uit 2 Blokken. Waarin 1 grote zaal en 5 lokalen en sanitaire blok gevestigd zijn. De grote zaal is polyvalent. 
                        Verder is er ook nog een keuken. Deze keuken is voorzien 2 gasfornuizen, friet ketel ,keuken eiland, enz...
                    </p>

                    <div class="row">
                        <div class="col-sm-6">
                            <img style="width: 100%; height: 200px;" src="http://st-joris-turnhout.be/assets/files/3.jpg" class="img-rounded img-thumbnail" alt="Verhuur foto 3" />
                        </div>

                        <div class="col-sm-6">
                            <img style="width: 100%; height: 200px;" src="http://st-joris-turnhout.be/assets/files/4.jpg" class="img-rounded img-thumbnail" alt="Verhuur foto 4" />
                        </div>
                    </div>

                    <p style="margin-top: 7px;">
                        In alle gebouwen is er verwarming aanwezig. Aan de gebouwen grenst er zich een groot grasveld, bos, vuurplaats
                        + u bevindt zich op wandel afstand van het stadspark. U hoeft ook echter 2 km te rijden voor zich u aan een
                        supermarkt bevind.
                    </p>

                </div>

                <div class="col-md-4">
                    <div class="panel panel-default" style="margin-top: 15px;">
                        <div class="panel-heading">Menu:</div>

                        <div class="list-group">
                            <a href="{{route('rental.frontend.index') }}" class="list-group-item">
                                <span class="fa fa-info-circle"></span> Informatie
                            </a>
                            <a href="{{ route('rental.frontend.reachable') }}" class="list-group-item">
                                <span class="fa fa-info-circle"></span> Bereikbaarheid
                            </a>
                            <a href="{{ route('rental.frontend-calendar') }}" class="list-group-item">
                                <span class="fa fa-calendar"></span> 
                                Verhuur kalender
                            </a>
                            <a href="{{ route('rental.frontend.insert') }}" class="list-group-item">
                                <span class="fa fa-asterisk"></span>
                                Verhuur aanvragen
                            </a>
                            <a href="mailto:contact@sjoris-turnhout.be" class="list-group-item">
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
