@extends('layouts.app')

@section('template_title')
    {{ $embarcacione->name ?? 'Show Embarcacione' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Detalles de la embarcación {{ $embarcacione->matricula }}</span>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <strong>Matrícula:</strong>
                            {{ $embarcacione->matricula }}
                        </div>
                        <div class="form-group">
                            <strong>Nombre:</strong>
                            {{ $embarcacione->nombre }}
                        </div>
                        <div class="form-group">
                            <strong>Eslora:</strong>
                            {{ $embarcacione->eslora }}
                        </div>
                        <div class="form-group">
                            <strong>Manga:</strong>
                            {{ $embarcacione->manga }}
                        </div>
                        <div class="form-group">
                            <strong>Calado:</strong>
                            {{ $embarcacione->calado }}
                        </div>
                        <div class="form-group">
                            <strong>Propulsion:</strong>
                            {{ $embarcacione->propulsion }}
                        </div>
                        <div class="form-group">
                            <strong>Id Cliente:</strong>
                            {{ $embarcacione->id_cliente }}
                        </div>
                        <div class="form-group">
                            <strong>Id Plaza:</strong>
                            {{ $embarcacione->id_plaza }}
                        </div>
                        {{-- <div class="form-group">
                            <strong>Visto:</strong>
                            {{ $embarcacione->visto }}
                        </div> --}}
                    </div>
                </div>
                <br>
                <div class="float-right">
                    <a class="btn btn-primary" href="{{ route('embarcaciones.index') }}">Volver</a>
                </div>
            </div>
        </div>
    </section>
@endsection
