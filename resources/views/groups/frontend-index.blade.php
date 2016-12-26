@extends('layouts.front-end')

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
                        <h2>Takken:</h2>

                        @foreach($kapoenen as $kapoen)
                            <div style="border-radius: 8px;" class="well well-sm color-kapoenen">
                                <div class="media">
                                    <div class="media-left">
                                        <a href="#">
                                            <img class="media-object color-white" style="height: 75px; width: 75px;" src="{{ asset('assets/img/kapoenen_zeehondjes.svg') }}" alt="...">
                                        </a>
                                    </div>
                                    <div class="media-body color-white">
                                        <h4 class="media-heading">Media heading</h4>
                                        ...
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        @foreach($welpen as $welp)
                            <div style="border-radius: 8px;" class="well well-sm color-welpen">
                                <div class="media">
                                    <div class="media-left">
                                        <a href="#">
                                            <img class="media-object color-white" style="height: 75px; width: 75px;" src="{{ asset('assets/img/zeekabouters_welpen.svg') }}" alt="...">
                                        </a>
                                    </div>
                                    <div class="media-body color-white">
                                        <h4 class="media-heading">Media heading</h4>
                                        ...
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        @foreach($jongGivers as $jonggiver)
                            <div style="border-radius: 8px;" class="well well-sm color-jonggivers">
                                <div class="media">
                                    <div class="media-left">
                                        <a href="#">
                                            <img class="media-object color-white" style="height: 75px; width: 75px;" src="{{ asset('assets/img/jonggidsen_jongverkenners_scheepsmakkers.svg') }}">
                                        </a>
                                    </div>
                                    <div class="media-body color-white">
                                        <h4 class="media-heading">
                                            {{ $jonggiver->heading }}
                                            <small>{{ $jonggiver->sub_heading }}</small>
                                        </h4>
                                        ....
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        @foreach($givers as $giver)
                            <div style="border-radius: 8px;" class="well well-sm color-givers">
                                <div class="media">
                                    <div class="media-left">
                                        <a href="#">
                                            <img class="media-object color-white" style="height: 75px; width: 75px;" src="{{ asset('assets/img/zee_gidsen_verkenners.svg') }}">
                                        </a>
                                    </div>
                                    <div class="media-body color-white">
                                        <h4 class="media-heading">Media heading</h4>
                                        ....
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        @foreach($jins as $jin)
                            <div style="border-radius: 8px;" class="well well-sm color-jins">
                                <div class="media">
                                    <div class="media-left">
                                        <a href="#">
                                            <img class="media-object color-white" style="height: 75px; width: 75px;" src="{{ asset('assets/img/jins_loodsen.svg') }}">
                                        </a>
                                    </div>
                                    <div class="media-body color-white">
                                        <h4 class="media-heading">Media heading</h4>
                                        ....
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        @foreach($leiding as $leiders)
                            <div style="border-radius: 8px;" class="well well-sm color-leiding">
                                <div class="media">
                                    <div class="media-left">
                                        <a href="#">
                                            <img class="media-object color-white" style="height: 75px; width: 75px;" src="{{ asset('assets/img/leiding.svg') }}">
                                        </a>
                                    </div>
                                    <div class="media-body color-white">
                                        <h4 class="media-heading">Media heading</h4>
                                        ....
                                    </div>
                                </div>
                            </div>
                        @endforeach

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
                <form action="" method="POST">
                    <div class="input-group">
                        <input type="text" name="" class="form-control" placeholder="Email adres">
                        <span class="input-group-btn">
                            <button type="submit" class="btn btn-default" type="button">
                                <span class="fa fa-envelope"></span>
                            </button>
                        </span>
                    </div>{{-- /input-group --}}
                </form>
            </p>
        </div>
    </div>
</footer>
@endsection
