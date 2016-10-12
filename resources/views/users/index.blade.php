@extends('layouts.back-end')

@section('content-header')
<h1>
    Login beheer
    <small>wie kan inloggen op het systeem?</small>
</h1>
<ol class="breadcrumb">
    <li><a href="{{ url('/') }}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Login beheer</li>
</ol>
@endsection

@section('content')
<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">Overzicht.</h3>

        <div class="box-tools pull-right">
            <a href="#"><span class="label label-danger">Gebruiker zoeken</span></a>
            <a href="#"><span class="label label-success">Gebruiker toevoegen</span></a>
        </div>
    </div>
    <div class="box-body no-padding">
        <table class="table table-condensed table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Naam:</th>
                    <th>Email:</th>
                    <th>Status:</th>
                    <th>Gebruikers groepen:</th>
                    <th>Gecreerd op:</th>
                    <th></th> {{-- Function(s) --}}
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user) 
                    <tr>
                        <td><code>#U{{ $user->id }}</code></td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        
                        {{-- Status if else --}}
                        {{-- State(s) are stored as permissions. --}}
                        <td>
                            @if ($user->can('active'))
                                <span class="label label-default">Actief</span>
                            @elseif ($user->can('blocked'))
                                <span class="label label-default">Geblokkeerd</span>
                            @else
                                <span class="label label-default">Geen status gevonden.</span>
                            @endif
                        </td>
                        {{-- /Status if else --}}

                        {{-- User groups --}}
                        <td>
                            @if($user->roles()->count() === 0)
                                <span class="label label-primary">Geen gebruikers groepen.</span>
                            @else 
                                @foreach($user->roles() as $group)
                                    <label class="label label-primary">{{ $group->name }} </label>
                                @endforeach
                            @endif
                        </td>
                        {{-- /User groups --}}

                        <td>{{ $user->created_at }}</td>
                        <td>
                            <a class="label label-info" href="mailto:{{ $user->email }}">Email gebruiker</a>
                            <a class="label label-warning" href="#">Reset wachtwoord</a>

                            @if ($user->can('active') && auth()->user()->can('admin'))
                                <a href="{{ route('users.block', $user->id) }}" class="label label-danger">Blokkeer</a>
                            @elseif ($user->can('blocked') && auth()->user()->can('admin'))
                                <a href="{{ route('users.unblock', $user->id) }}" class="label label-danger">Activeer</a>
                            @endif

                            @if (auth()->user()->can('admin'))
                                <a href="{{ route('users.destroy', $user->id) }}" class="label label-danger">Verwijder</a>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    {{-- /.box-body --}}

    <div class="box-footer clearfix">
        <ul class="pagination pagination-sm no-margin">
            <li><a href="#"><span class="fa fa-angle-left"></a></li>
            <li><a href="#">1</a></li>
            <li><a href="#">2</a></li>
            <li><a href="#">3</a></li>
            <li><a href="#"><span class="fa fa-angle-right"></a></li>
        </ul>
    </div>
    {{-- /.box footer --}}

    {{-- Partials --}}
        @include('users.create')
        @include('users.search')
    {{-- /Partials --}}
</div>
@endsection