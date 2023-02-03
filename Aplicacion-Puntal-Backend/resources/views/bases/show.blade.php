@extends('layouts.app')

@section('template_title')
{{ $base->name ?? 'Show Base' }}
@endsection

@section('content')
<section class="content container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="float-left">
                        <span class="card-title">Show Base</span>
                    </div>
                    <div class="float-right">
                        <a class="btn btn-info btn-sm float-right m-3" href="{{ route('bases.index') }}"> Back</a>
                    </div>
                </div>

                <div class="card-body">

                    <div class="form-group">
                        <strong>Idplaza:</strong>
                        {{ $base->idPlaza }}
                    </div>
                    <div class="form-group">
                        <strong>Fechaentrada:</strong>
                        {{ $base->fechaEntrada }}
                    </div>
                    <div class="form-group">
                        <strong>Fechasalida:</strong>
                        {{ $base->fechaSalida }}
                    </div>
                    <div class="form-group">
                        <strong>Idmuelle:</strong>
                        {{ $base->plaza->idMuelle }}
                    </div>
                    <div class="form-group">
                        <strong>IdInstalación:</strong>
                        {{ $base->plaza->muelle->instalacion->id }}
                    </div>
                    <div class="form-group">
                        <strong>Nombre Instalación:</strong>
                        {{ $base->plaza->muelle->instalacion->nombrePuerto }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
