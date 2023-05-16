@extends('layouts.app')

@section('template_title')
{{ $servicio->name ?? 'Show Servicio' }}
@endsection

@section('content')
<section class="content container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="float-left">
                        <span class="card-title">Show Servicio</span>
                    </div>
                    <div class="float-right">
                        <a class="btn btn-info btn-sm float-right m-3" href="{{ route('servicios.index') }}"> Back</a>
                    </div>
                </div>

                <div class="card-body">
                    <div class="form-group">
                        <strong>Nº Servicio:</strong>
                        {{ $servicio->id }}
                    </div>
                    <div class="form-group">
                        <strong>Matrícula Embarcación:</strong>
                        {{ $servicio->matriculaEmbarcacion }}
                    </div>
                    <div class="form-group">
                        <strong>Nombre Embarcación:</strong>
                        {{ $servicio->embarcacion->nombre }}
                    </div>
                  <!--   <div class="form-group">
                        <strong>Visto:</strong>
                        {{ $servicio->visto }}
                    </div> -->
                </div>
            </div>
        </div>
    </div>
</section>
@endsection