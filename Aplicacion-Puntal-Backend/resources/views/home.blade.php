@extends('layouts.app')

@section('content')

    @auth    <!--sirve para mostrar en caso de estar autentificado, estar logeado-->
        {{auth()->user()->email}}
        <br>
        {{auth()->user()->perfil}}
    @endauth

    <br> esta es la vista del /home
    te has logeado

    @guest
        <a href="{{route('login')}}">Login</a>
    @endguest

    @if ($message = Session::get('access'))
        <div class="alert alert-danger">
            <p>{{ $message }}</p>
        </div>
    @endif


@endsection
