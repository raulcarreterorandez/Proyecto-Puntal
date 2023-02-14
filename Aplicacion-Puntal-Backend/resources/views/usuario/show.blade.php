@extends('layouts.app')

@section('template_title')
    {{ $usuario->email ?? 'Show Usuario' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">

                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <span class="card-title h1">Show Usuario</span>
                            <div class="float-right">
                                @if (auth()->user()->email != $usuario->email)
                                    <a class="btn btn-lg btn-success" href="{{ route('usuarios.edit',$usuario->email) }}"><i class="bi bi-pencil"></i> </a>
                                    <a class="btn btn-danger btn-lg" href="{{ route('usuarios.confirm',$usuario->email) }}"><i class="bi bi-trash3-fill"></i> </a>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="card-body">

                        <div class="form-group">
                            <strong>Nombre Usuario:</strong>
                            {{ $usuario->nombreUsuario }}
                        </div>
                        <div class="form-group">
                            <strong>Password:</strong>
                            ********
                        </div>
                        <div class="form-group">
                            <strong>Nombre Completo:</strong>
                            {{ $usuario->nombreCompleto }}
                        </div>
                        <div class="form-group">
                            <strong>Email:</strong>
                            {{ $usuario->email }}
                        </div>
                        <div class="form-group">
                            <strong>Habilitado:</strong>
                            @if ($usuario->habilitado == 0)
                                <i class="bi bi-x-square-fill" style="color: red"></i>
                            @else
                                <i class="bi bi-check-square-fill" style="color: green"></i>
                            @endif
                        </div>
                        <div class="form-group">
                            <strong>Perfil:</strong>
                            {{ $usuario->perfil }}
                        </div>

                        <div class="form-group">
                            <strong>Instalaciones:</strong>
                            @foreach ($instalaciones as $instalacion)
                                /{{$instalacion}}/
                            @endforeach
                        </div>

                        <div class="form-group">
                            <strong>Idioma:</strong>
                            {{ $usuario->idioma }}
                        </div>
                    </div>
                </div><br>
                <div class="float-right">
                    @if (auth()->user()->email == $usuario->email)
                        <a class="btn btn-info" href="{{ route('home') }}"> Back</a>
                    @else
                        <a class="btn btn-info" href="{{ route('usuarios.index') }}"> Back</a>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection

<style>
    strong{
        font-size: 20px;
    }
</style>
