@extends('layouts.app')

@section('template_title')
    {{ $muelle->name ?? 'Show Muelle' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Muelle</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-info btn-sm float-right m-3" href="{{ route('muelles.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                       <div class="form-group">
                            <strong>Nº Muelle:</strong>
                            {{ $muelle->id }}
                        </div>
                        <div class="form-group">
                            <strong>Código Instalación:</strong>
                            {{ $muelle->instalacion->codigo }}
                        </div>
                        <div class="form-group">
                            <strong>Nombre Instalación:</strong>
                            {{ $muelle->instalacion->nombrePuerto }}
                        </div>
                        {{-- <div class="form-group">
                            <strong>Visto:</strong>
                            {{ $muelle->visto }}
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
