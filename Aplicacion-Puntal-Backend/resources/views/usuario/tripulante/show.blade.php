@extends('layouts.app')

@section('template_title')
    {{ $tripulante->name ?? 'Show Tripulante' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Tripulante</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('tripulantes.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Numdocumento:</strong>
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
                            <strong>Fechanacimiento:</strong>
                            {{ $tripulante->fechaNacimiento }}
                        </div>
                        <div class="form-group">
                            <strong>Lugarnacimiento:</strong>
                            {{ $tripulante->lugarNacimiento }}
                        </div>
                        <div class="form-group">
                            <strong>Paisnacimiento:</strong>
                            {{ $tripulante->paisNacimiento }}
                        </div>
                        <div class="form-group">
                            <strong>Tipodocumento:</strong>
                            {{ $tripulante->tipoDocumento }}
                        </div>
                        <div class="form-group">
                            <strong>Fechaexpediciondocumento:</strong>
                            {{ $tripulante->fechaExpedicionDocumento }}
                        </div>
                        <div class="form-group">
                            <strong>Fechacaducidaddocumento:</strong>
                            {{ $tripulante->fechaCaducidadDocumento }}
                        </div>
                        <div class="form-group">
                            <strong>Id Plaza:</strong>
                            {{ $tripulante->id_plaza }}
                        </div>
                        <div class="form-group">
                            <strong>Id Embarcacion:</strong>
                            {{ $tripulante->id_embarcacion }}
                        </div>
                        <div class="form-group">
                            <strong>Visto:</strong>
                            {{ $tripulante->visto }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
