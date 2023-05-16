@extends('layouts.app')

@section('template_title')
{{ $plaza->name ?? 'Show Plaza' }}
@endsection

@section('content')
<section class="content container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="float-left">
                        <span class="card-title">Show Plaza</span>
                    </div>
                    <div class="float-right">
                        <a class="btn btn-info btn-sm float-right m-3" href="{{ route('plazas.index') }}"> Back</a>
                    </div>
                </div>

                <div class="card-body">

                    <div class="form-group">
                        <strong>Disponible:</strong>

                        @if ($plaza->disponible == 1)
                        <button class="bi bi-check-square-fill boton-habilitado" style="color: green"></button>
                        <a style="visibility: hidden">1</a>
                        @else
                        <button class="bi bi-x-square-fill boton-habilitado" style="color: red"></button>
                        <a style="visibility: hidden">0</a>
                        @endif

                    </div>
                        {{-- <div class="form-group">
                        <strong>Visto:</strong>
                        {{ $plaza->visto }}
                    </div>  --}}
                    <div class="form-group">
                        <strong>Puerto Origen:</strong>
                        {{ $plaza->puertoOrigen }}
                    </div>
                    <div class="form-group">
                        <strong>Puerto Destino:</strong>
                        {{ $plaza->puertoDestino }}
                    </div>
                    <div class="form-group">
                        <strong>Año:</strong>
                        {{ $plaza->anyo }}
                    </div>
                    <div class="form-group">
                        <strong>Nº muelle:</strong>
                        {{ $plaza->idMuelle }}
                    </div>
                    <div class="form-group">
                        <strong>Código Instalación:</strong>
                        {{ $plaza->muelle->instalacion->codigo }}
                    </div>
                    <div class="form-group">
                        <strong>Nombre Instalación:</strong>
                        {{ $plaza->muelle->instalacion->nombrePuerto }}
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
@endsection
<style>
    .bi {
        outline: none;
        border: none;
        font-size: 20px;
    }
</style>
