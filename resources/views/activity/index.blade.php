@extends('layouts.back-end')

@section('content-header')
<h1>
    Activiteiten.
    <small>Activiteiten module voor ouders en leden.</small>
</h1>
<ol class="breadcrumb">
    <li><a href="{{ url('/') }}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Activiteiten</li>
</ol>
@endsection

@section('content')
<div class="nav-tabs-custom">
    <ul class="nav nav-tabs">
        <li class="active">
            <a href="#tab_1" data-toggle="tab">
                Opgeslagen activiteiten 
            </a>
        </li>
        <li>
            <a href="#tab_2" data-toggle="tab"
               >Klad evenementen
            </a>
        </li>
        <li>
            <a href="#tab_3" data-toggle="tab">
                Nieuwe activiteit
            </a>
        </li>
    </ul>

    <div class="tab-content">

        {{-- Published activities --}}
        <div class="tab-pane active" id="tab_1">
            @if(count($published) == 0)
                <div class="row">
                    <div class="col-sm-4">
                        <div class="alert alert-info alert-dismissible">
                            
                            <h4>
                                <i class="icon fa fa-info-circle"></i> 
                                Oh snapp!
                            </h4>

                            Er zijn geen gepubliceerde activiteiten gevonden in het systeem. 
                            Je kunt er een creeren of dit gewoon laten. Aan jouw de keuze.
                        </div>
                    </div>
                </div>
            @else 
                <table class="table table-hover table-condensed">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Groep:</th>
                            <th>Datum:</th>
                            <th>Uren:</th>
                            <th>Titel:</th>
                            <th>Aangemaakt door:</th>
                            <th></th> {{-- Functies --}}
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($published as $pub)
                            <tr>
                                <td><code>#A{{ $pub->id }}</code></td>
                                <td>
                                    @if(count($pub->groups) > 0) 
                                        @foreach($pub->groups as $group)
                                            <label class="label label-info"> {{ $group->heading }} </label>
                                        @endforeach 
                                    @else
                                        <label class="label label-info">Geen groepen geselecteerd.</label>
                                    @endif
                                </td>
                                <td>{{ date('d/m/Y', strtotime($pub->date)) }}</td>
                                <td>
                                    Van {{ date('H:i', strtotime($pub->start_time)) }}
                                    tot {{ date('H:i', strtotime($pub->end_time)) }}
                                </td>
                                <td>{{ $pub->heading }}</td>
                                <td>{{ $pub->creator->name }}</td>

                                {{-- Functions --}}
                                <td>
                                    <a href="" class="label label-success">Bekijk</a>
                                    <a href="{{ route('activity.destroy', ['id' => $pub->id]) }}" class="label label-danger">Verwijder</a>
                                </td>
                                {{-- /Functions --}}
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
        {{-- /.tab-pane --}}

        {{-- Draft activities --}}
        <div class="tab-pane" id="tab_2">
            @if(count($drafts) == 0)
                <div class="row">
                    <div class="col-sm-4">
                        <div class="alert alert-info alert-dismissible">

                            <h4>
                                <i class="icon fa fa-info-circle"></i>
                                Oh snapp!
                            </h4>

                            Er zijn geen klad activiteiten gevonden in het systeem.
                            Je kunt er een creeren of dit gewoon laten. Aan jouw de keuze.
                        </div>
                    </div>
                </div>
            @else
                <table class="table table-hover table-condensed">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Groep:</th>
                            <th>Datum:</th>
                            <th>Uren:</th>
                            <th>Titel:</th>
                            <th>Aangemaakt door:</th>
                            <th></th> {{-- Functies --}}
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($drafts as $draft)
                        <tr>
                            <td><code>#A{{ $draft->id }}</code></td>
                            <td>
                                @if(count($draft->groups) > 0)
                                    @foreach($draft->groups as $group1)
                                        <label class="label label-info"> {{ $group1->heading }} </label>
                                    @endforeach
                                @else
                                    <label class="label label-info">Geen groepen geselecteerd.</label>
                                @endif
                            </td>
                            <td>{{ date('d/m/Y', strtotime($draft->date)) }}</td>
                            <td>
                                Van {{ date('H:i', strtotime($draft->start_time)) }}
                                tot {{ date('H:i', strtotime($draft->end_time)) }}
                            </td>
                            <td>{{ $draft->heading }}</td>
                            <td>{{ $draft->creator->name }}</td>

                            {{-- Functions --}}
                            <td>
                                <a href="" class="label label-success">Bekijk</a>
                                <a href="{{ route('activity.destroy', ['id' => $draft->id]) }}" class="label label-danger">Verwijder</a>
                            </td>
                            {{-- /Functions --}}
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @endif
            </div>
            {{-- /.tab-pane --}}
        
            {{-- Create new activity --}}
            <div class="tab-pane" id="tab_3">
            
                <div class="row">
       
                    <form action="{{ route('activity.store') }}" class="form-horizontal" method="POST">
                        {{-- CSRF Field --}}
                        {{ csrf_field() }}

                        {{-- Activity date --}}
                        <div class="form-group {{ $errors->has('date') ? 'has-error' : '' }}">
                            {{-- BUG: style="text-align: left;" --}}
                            {{-- CSS code assign the label out off the container --}}
                            <label class="control-label col-sm-1" id="date">
                                Datum: <span class="text-danger">*</span>
                            </label>

                            <div class="col-sm-2">
                                <input class="form-control" type="date" placeholder="Activiteit datum" name="date" id="date" />
                            </div>
                        </div>

                        {{-- Activity time form-group --}}
                        <div class="form-group {{ $errors->has('start_time') ? 'has-error' : '' }} {{ $errors->has('end_time') ? 'has-error' : '' }}">
                            <label class="control-label col-sm-1" id="time">
                                Uren: <span class="text-danger">*</span>
                            </label>

                            <div class="col-sm-1">
                                <input class="form-control" type="time" placeholder="Start uur" name="start_time" id="time">
                            </div>

                            <div class="col-sm-1">
                                <input class="form-control" type="time" placeholder="Eind uur" name="end_time" id="time">
                            </div>
                        </div>

                        {{-- Group form-group --}}
                        <div class="form-group {{ $errors->has('group') ? 'has-error' : '' }}">
                            <label class="control-label col-sm-1" id="group">
                                Groep: <span class="text-danger">*</span>
                            </label>   

                            <div class="col-sm-2">
                                <select name="group" class="form-control">
                                    <option value="" selected>-- Selecteer groep --</option>

                                    @foreach($groups as $group)
                                        <option value="{{ $group->id }}"> {{ $group->heading }} </option>  
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        {{-- State form-group --}}
                        <div class="form-group {{ $errors->has('state') ? 'has-error' : '' }}">
                            <label class="control-label col-sm-1">
                                 Status: <span class="text-danger">*</span> 
                            </label>

                            <div class="col-sm-1">
                                <input type="radio" name="state" value="1" /> Publiceer.
                            </div>

                            <div class="col-sm-1">
                                <input type="radio" name="state" value="0"/> Klad activiteit
                            </div>
                        </div>

                        {{-- Activity name form-group --}}
                        <div class="form-group {{ $errors->has('heading') ? 'has-error' : '' }}">
                            <label id="name" class="control-label col-sm-1">
                                Naam: <span class="text-danger">*</span>
                            </label>

                            <div class="col-sm-2">
                                <input type="text" placeholder="Activiteit naam" name="heading" class="form-control">
                            </div>
                        </div>

                        {{-- Activity description form-group --}}
                        <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
                            <label class="control-label col-sm-1" id="description">
                                Beschrijving: <span class="text-danger">*</span>
                            </label>

                            <div class="col-md-4">
                                <textarea class="form-control" name="description" rows="7" placeholder="Activiteit beschrijving" id="description" type="test"></textarea>

                                <span class="help-block">
                                    <i>(Beschrijvings veld is <a target="_blank" href="https://guides.github.com/features/mastering-markdown/">Markdown</a> gevoelig).</i>
                                </span>
                            </div>
                        </div>

                        {{-- SUBMIT & RESET form group --}}
                        <div class="form-group">
                            <div class="col-sm-offset-1 col-sm-3">
                                <button type="submit" class="btn btn-success btn-flat">Aanmaken</button>
                                <button type="reset" class="btn btn-danger btn-flat">Reset</button>
                            </div>
                        </div>

                    </form>
                </div>
            
            </div>
        {{-- /.tab-pane --}}

    </div>
    {{-- /.tab-content --}}
</div>
@endsection
