@extends('layouts.links')
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@if (trim($__env->yieldContent('template_title'))) @yield('template_title') | @endif {{ config('app.name', 'Laravel') }}</title>
</head>
<body>
    <div class="container-fluid">
        <nav class="navbar navbar-expand-lg bg-primary ">
            <div class="container-fluid">
                <a class="navbar-brand text-white" href="{{ route('home') }}"> <strong>HOME</strong> </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-item active nav-link text-white" href="{{ route('usuarios.index') }}">Usuarios</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-item active nav-link text-white" href="{{ route('mensajes.index') }}">Mensajes</a>
                    </li>

                    {{--**************** AÑADIR AQUI LAS RUTAS A LOS INDEX DE LOS CONTROLADORES **********************--}}
                    {{-- <li class="nav-item">
                        <a class="nav-item active nav-link text-white" href="{{ route('mensajes.index') }}">Mensajes</a>
                    </li> --}}

                    </ul>

                    {{--**************** DESCOMENTAR CUANDO ESTE INSTALADO EL LOGIN DE LARAVEL ****************--}}
                    <a class="text-white btn btn-md btn-primary" href="{{ route('info') }}"><strong>{{auth()->user()->email}}</strong></a>

                    <a class="btn btn-md btn-danger" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="bi bi-power"></i> Logout </a>
                </div>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>

            </div>
          </nav>
          <main>
            @yield('content')
        </main>
</body>
</html>
