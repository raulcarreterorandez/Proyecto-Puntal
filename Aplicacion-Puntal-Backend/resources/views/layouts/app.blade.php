@extends('layouts.links')
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@if (trim($__env->yieldContent('template_title'))) @yield('template_title') | @endif {{ config('app.name', 'Laravel') }}</title>

<!-- Scripts -->
<script src="{{ asset('js/app.js') }}" defer></script>

<!-- Fonts -->
<link rel="dns-prefetch" href="//fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

<!-- Styles -->
<link href="{{ asset('css/app.css') }}" rel="stylesheet">

{{-- BOOTSTRAP --}}
<link href="{{asset('/bootstrap.min.css')}}" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

{{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous"> --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css" integrity="sha384-b6lVK+yci+bfDmaY1u0zE8YYJt0TZxLEAFyYSLHId4xoVvsrQu3INevFKo+Xir8e" crossorigin="anonymous">

{{-- DATATABLES --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>

<script>
    $(document).ready(function () {
        $('#example').DataTable();
    });
</script>




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
