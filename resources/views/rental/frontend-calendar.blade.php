@extends('layouts.front-end')

{{-- TODO: Set the rental pictures local --}}

@section('content')
<div class="row">
    <div class="col-sm-12">
        <img class="front-image" src="{{ asset('assets/img/front.jpg') }}" alt="Alternate Text" />
    </div>
</div>
<div class="content-margin row">
    <div class="col-sm-12">
        <div style="border-radius:0px; border: 0px;" class="panel panel-default">
            <div class="panel-body">
                <div class="col-md-8">
                    <h3>Verhuur kalender.</h3>

                    <p>
                        Hier vind u wanner onze lokalen al reeds verhuurd zijn.
                        Vind u hier de datum niet dat u onze lokalen wilt huren leg dan snel je datum vast.
                        Dat doe je door dit <a href="{{ route('rental.frontend.insert') }}">formulier</a> in te vullen.
                    </p>

                    <h4 style="margin-top: 20px;">Bevestigde datums:</h4>

                    @if (count($items) == 0)
                        <div class="alert alert-info">
                            Wij hebben momenteel geen verhuringen. 
                        </div>
                    @else
                        <div class="row">
                            <div class="col-sm-4">
                                <table class="table table-condensed table-hover">
                                    <thead>
                                        <tr>
                                            <th width="200"><span class="text-center">Start datum:</span></th>
                                            <th width="100"></th> {{-- Seperator --}}
                                            <th width="200"><span class="text-center">Eind datum:</span></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($items as $item)
                                        <tr>
                                            <td><span class="text-center">{{ date('d/m/Y', strtotime($item->start_date)) }}</span></td>
                                            <td><span class="text-center">-</span></td>
                                            <td><span class="text-center">{{ date('d/m/Y', strtotime($item->end_date)) }}</span></td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endif

                </div>

                <div class="col-md-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">Menu:</div>

                        <div class="list-group">
                            <a href="{{ route('rental.frontend.index') }}" class="list-group-item">
                                <span class="fa fa-info-circle"></span> Informatie
                            </a>
                             <a href="{{ route('rental.frontend.reachable') }}" class="list-group-item">
                                <span class="fa fa-info-circle"></span> Bereikbaarheid
                            </a>
                            <a href="{{ route('rental.frontend-calendar') }}" class="list-group-item">
                                <span class="fa fa-calendar"></span> Verhuur kalender
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
                <li><a href="https://">Facebook</a></li>
                <li><a href="https://">Twitter</a></li>
                <li><a href="https://">Instagram</a></li>
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
                </div>{{-- /input-group --}}
            </p>
        </div>
    </div>
</footer>
@endsection
