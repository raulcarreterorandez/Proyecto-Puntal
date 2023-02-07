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
                        {{ $plaza->disponible }}
                    </div>
                    <div class="form-group">
                        <strong>Visto:</strong>
                        {{ $plaza->visto }}
                    </div>
                    <div class="form-group">
                        <strong>Puertoorigen:</strong>
                        {{ $plaza->puertoOrigen }}
                    </div>
                    <div class="form-group">
                        <strong>Puertodestino:</strong>
                        {{ $plaza->puertoDestino }}
                    </div>
                    <div class="form-group">
                        <strong>Año:</strong>
                        {{ $plaza->año }}
                    </div>
                    <div class="form-group">
                        <strong>Idmuelle:</strong>
                        {{ $plaza->idMuelle }}
                    </div>
                    <div class="form-group">
                        <strong>IdInstalación:</strong>
                        {{ $plaza->muelle->instalacion->id }}
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
