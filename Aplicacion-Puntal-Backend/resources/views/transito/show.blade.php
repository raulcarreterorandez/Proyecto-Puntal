@extends('layouts.app')

@section('template_title')
{{ $transito->name ?? 'Show Transito' }}
@endsection

@section('content')
<section class="content container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="float-left">
                        <span class="card-title">Show Transito</span>
                    </div>
                    <div class="float-right">
                        <a class="btn btn-info btn-sm float-right m-3" href="{{ route('transitos.index') }}"> Back</a>
                    </div>
                </div>

                <div class="card-body">

                    <div class="form-group">
                        <strong>Idplaza:</strong>
                        {{ $transito->idPlaza }}
                    </div>
                    <div class="form-group">
                        <strong>Fechaentrada:</strong>
                        {{ $transito->fechaEntrada }}
                    </div>
                    <div class="form-group">
                        <strong>Fechasalida:</strong>
                        {{ $transito->fechaSalida }}
                    </div>
                    <div class="form-group">
                        <strong>Idmuelle:</strong>
                        {{ $transito->plaza->idMuelle }}
                    </div>
                    <div class="form-group">
                        <strong>IdInstalación:</strong>
                        {{ $transito->plaza->muelle->instalacion->id }}
                    </div>
                    <div class="form-group">
                        <strong>Nombre Instalación:</strong>
                        {{ $transito->plaza->muelle->instalacion->nombrePuerto }}
                    </div> 

                </div>
            </div>
        </div>
    </div>
</section>
@endsection
