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
                        <strong>Nº Plaza:</strong>
                        {{ $bases->idPlaza }}
                    </div>
                    <div class="form-group">
                        <strong>Fechaentrada:</strong>
                        {{ $bases->fechaEntrada }}
                    </div>
                    <div class="form-group">
                        <strong>Fechasalida:</strong>
                        {{ $bases->fechaSalida }}
                    </div>
                    <div class="form-group">
                        <strong> Nº Muelle:</strong>
                        {{ $bases->plaza->idMuelle }}
                    </div>
                    <div class="form-group">
                        <strong>Código Instalación:</strong>
                        {{ $bases->plaza->muelle->instalacion->codigo }}
                    </div>
                    <div class="form-group">
                        <strong>Nombre Instalación:</strong>
                        {{ $bases->plaza->muelle->instalacion->nombrePuerto }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
