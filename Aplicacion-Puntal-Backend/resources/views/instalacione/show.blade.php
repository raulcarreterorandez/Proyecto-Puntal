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
                            <span class="card-title">Show Instalacione</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('instalaciones.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Codigo:</strong>
                            {{ $instalacione->codigo }}
                        </div>
                        <div class="form-group">
                            <strong>Nombrepuerto:</strong>
                            {{ $instalacione->nombrePuerto }}
                        </div>
                        <div class="form-group">
                            <strong>Descripcion:</strong>
                            {{ $instalacione->descripcion }}
                        </div>
                        <div class="form-group">
                            <strong>Estado:</strong>
                            {{ $instalacione->estado }}
                        </div>
                        <div class="form-group">
                            <strong>Visto:</strong>
                            {{ $instalacione->visto }}
                        </div>
                        <div class="form-group">
                            <strong>Fechadisposicion:</strong>
                            {{ $instalacione->fechaDisposicion }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
