@extends('layouts.app')

@section('template_title')
    {{ $instalacione->name ?? 'Show Instalacione' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Instalaciones</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-info btn-sm float-right m-3" href="{{ route('instalaciones.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Codigo:</strong>
                            {{ $instalacion->codigo }}
                        </div>
                        <div class="form-group">
                            <strong>Nombrepuerto:</strong>
                            {{ $instalacion->nombrePuerto }}
                        </div>
                        <div class="form-group">
                            <strong>Descripcion:</strong>
                            {{ $instalacion->descripcion }}
                        </div>
                        <div class="form-group">
                            <strong>Estado:</strong>
                            {{ $instalacion->estado }}
                        </div>
                        <div class="form-group">
                            <strong>Visto:</strong>
                            {{ $instalacion->visto }}
                        </div>
                        <div class="form-group">
                            <strong>Fechadisposicion:</strong>
                            {{ $instalacion->fechaDisposicion }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
