@extends('layouts.app')

@section('template_title')
    {{ $mensaje->name ?? 'Show Mensaje' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">

                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <span class="card-title h1">Show Mensaje</span>
                            <div class="float-right">
                                <form action="{{ route('mensajes.destroy',$mensaje->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-lg"><i class="bi bi-trash3-fill"></i></button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">


                        <div class="form-group">
                            <strong>Fecha:</strong>
                            {{ $mensaje->fecha_hora }}
                        </div>
                        <div class="form-group">
                            <strong>De:</strong>
                            {{ $mensaje->idUsuarioOrigen }}
                        </div>
                        <div class="form-group">
                            <strong>Para:</strong>
                            {{ $mensaje->idUsuarioDestino }}
                        </div>
                        <div class="form-group">
                            <strong>Mensaje:</strong>
                            {{ $mensaje->texto }}
                        </div> <br>

                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('mensajes.responder',$mensaje->idUsuarioOrigen) }}"> Responder</a>
                        </div>
                    </div>
                </div><br>
                <div class="float-right">
                    <a class="btn btn-primary" href="{{ route('mensajes.index') }}"> Back</a>
                </div>
            </div>
        </div>
    </section>
@endsection
