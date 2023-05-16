<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    @extends('layouts.links')

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

                    <li class="nav-item">
                        <a class="nav-item active nav-link text-white" href="{{ route('instalaciones.index') }}">Instalaciones</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-item active nav-link text-white" href="{{ route('muelles.index') }}">Muelles</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-item active nav-link text-white" href="{{ route('plazas.index') }}">Plazas</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-item active nav-link text-white" href="{{ route('bases.index') }}">Bases</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-item active nav-link text-white" href="{{ route('transitos.index') }}">Tránsitos</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-item active nav-link text-white" href="{{ route('clientes.index') }}">Clientes</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-item active nav-link text-white" href="{{ route('embarcaciones.index') }}">Embarcaciones</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-item active nav-link text-white" href="{{ route('tripulantes.index') }}">Tripulantes</a>
                    </li>


                    <li class="nav-item">
                        <a class="nav-item active nav-link text-white" href="{{ route('servicios.index') }}">Servicios</a>
                    </li>

                    </ul>

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

{{-- MENU CON TODAS LAS OPCIONES VISIBLES --}}
{{--
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
            <a class="nav-item active nav-link text-white" href="{{ route('usuarios.index') }}">Usuarios</a>
        </li>
        <li class="nav-item">
            <a class="nav-item active nav-link text-white" href="{{ route('mensajes.index') }}">Mensajes</a>
        </li>

        <li class="nav-item">
            <a class="nav-item active nav-link text-white" href="{{ route('instalaciones.index') }}">Instalaciones</a>
        </li>

        <li class="nav-item">
            <a class="nav-item active nav-link text-white" href="{{ route('muelles.index') }}">Muelles</a>
        </li>

        <li class="nav-item">
            <a class="nav-item active nav-link text-white" href="{{ route('plazas.index') }}">Plazas</a>
        </li>

        <li class="nav-item">
            <a class="nav-item active nav-link text-white" href="{{ route('bases.index') }}">Bases</a>
        </li>

        <li class="nav-item">
            <a class="nav-item active nav-link text-white" href="{{ route('transitos.index') }}">Tránsitos</a>
        </li>

        <li class="nav-item">
            <a class="nav-item active nav-link text-white" href="{{ route('clientes.index') }}">Clientes</a>
        </li>

        <li class="nav-item">
            <a class="nav-item active nav-link text-white" href="{{ route('embarcaciones.index') }}">Embarcaciones</a>
        </li>

        <li class="nav-item">
            <a class="nav-item active nav-link text-white" href="{{ route('tripulantes.index') }}">Tripulantes</a>
        </li>

        </ul>

        <a class="text-white btn btn-md btn-primary" href="{{ route('info') }}"><strong>{{auth()->user()->email}}</strong></a>

        <a class="btn btn-md btn-danger" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="bi bi-power"></i> Logout </a>
    </div>
    --}}




    {{-- MENU CON LAS OPCIONES RESTRINGIDAS --}}
{{--
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                    @if (auth()->user()->perfil != "GUARDA-MUELLES")

                        <li class="nav-item">
                            <a class="nav-item active nav-link text-white" href="{{ route('usuarios.index') }}">Usuarios</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-item active nav-link text-white" href="{{ route('instalaciones.index') }}">Instalaciones</a>
                        </li>

                    @endif


                    <li class="nav-item">
                        <a class="nav-item active nav-link text-white" href="{{ route('mensajes.index') }}">Mensajes</a>
                    </li>


                    <li class="nav-item">
                        <a class="nav-item active nav-link text-white" href="{{ route('muelles.index') }}">Muelles</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-item active nav-link text-white" href="{{ route('plazas.index') }}">Plazas</a>
                    </li>

                      <li class="nav-item">
                        <a class="nav-item active nav-link text-white" href="{{ route('bases.index') }}">Bases</a>
                    </li>

                      <li class="nav-item">
                        <a class="nav-item active nav-link text-white" href="{{ route('transitos.index') }}">Tránsitos</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-item active nav-link text-white" href="{{ route('clientes.index') }}">Clientes</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-item active nav-link text-white" href="{{ route('embarcaciones.index') }}">Embarcaciones</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-item active nav-link text-white" href="{{ route('tripulantes.index') }}">Tripulantes</a>
                    </li>

                </ul>

                <a class="text-white btn btn-md btn-primary" href="{{ route('info') }}"><strong>{{auth()->user()->email}}</strong></a>

                <a class="btn btn-md btn-danger" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="bi bi-power"></i> Logout </a>
            </div>
    --}}
