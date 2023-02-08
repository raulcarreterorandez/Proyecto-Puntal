@extends('layouts.app')

@section('template_title')
    {{ $tripulante->nombre ?? 'Show Tripulante' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Detalles del tripulante {{ $tripulante->numDocumento }}</span>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <strong>Documento:</strong>
                            {{ $tripulante->numDocumento }}
                        </div>
                        <div class="form-group">
                            <strong>Nombre:</strong>
                            {{ $tripulante->nombre }}
                        </div>
                        <div class="form-group">
                            <strong>Apellidos:</strong>
                            {{ $tripulante->apellidos }}
                        </div>
                        <div class="form-group">
                            <strong>Nacionalidad:</strong>
                            {{ $tripulante->nacionalidad }}
                        </div>
                        <div class="form-group">
                            <strong>Fecha de nacimiento:</strong>
                            {{ $tripulante->fechaNacimiento }}
                        </div>
                        <div class="form-group">
                            <strong>Lugar de nacimiento:</strong>
                            {{ $tripulante->lugarNacimiento }}
                        </div>
                        <div class="form-group">
                            <strong>Pais de nacimiento:</strong>
                            {{ $tripulante->paisNacimiento }}
                        </div>
                        <div class="form-group">
                            <strong>Tipo de documento:</strong>
                            {{ $tripulante->tipoDocumento }}
                        </div>
                        <div class="form-group">
                            <strong>Fecha de expedición de documento:</strong>
                            {{ $tripulante->fechaExpedicionDocumento }}
                        </div>
                        <div class="form-group">
                            <strong>Fecha de caducidad de documento:</strong>
                            {{ $tripulante->fechaCaducidadDocumento }}
                        </div>
                        <div class="form-group">
                            <strong>Plaza:</strong>
                            {{ $tripulante->id_plaza }}
                        </div>
                        <div class="form-group">
                            <strong>Embarcacion:</strong>
                            {{ $tripulante->id_embarcacion }}
                        </div>
                    </div>
                </div>
                <br>
                <div class="float-right">
                    <a class="btn btn-primary" href="{{ route('tripulantes.index') }}">Volver</a>
                </div>
            </div>
        </div>
    </section>
@endsection
