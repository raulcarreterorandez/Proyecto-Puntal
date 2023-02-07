@extends('layouts.app')
@section('template_title')
    {{ $cliente->name ?? 'Detalles cliente' }}
@endsection
@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Detalles del cliente con documento {{ $cliente->numDocumento }}</span>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <strong>Documento:</strong>
                            {{ $cliente->numDocumento }}
                        </div>
                        <div class="form-group">
                            <strong>Nombre:</strong>
                            {{ $cliente->nombre }}
                        </div>
                        <div class="form-group">
                            <strong>Apellidos:</strong>
                            {{ $cliente->apellidos }}
                        </div>
                        <div class="form-group">
                            <strong>Email:</strong>
                            {{ $cliente->email }}
                        </div>
                        <div class="form-group">
                            <strong>Dirección:</strong>
                            {{ $cliente->direccion }}
                        </div>
                        <div class="form-group">
                            <strong>Tipo de documento:</strong>
                            {{ $cliente->tipoDocumento }}
                        </div>
                        <div class="form-group">
                            <strong>Teléfono:</strong>
                            {{ $telefonos->numero }}
                        </div>
                        <div class="form-group">
                            <strong>Observaciones:</strong>
                            {{ $cliente->observaciones }}
                        </div>
                    </div>
                </div>
                <br>
                <div class="float-right">
                    <a class="btn btn-primary" href="{{ route('clientes.index') }}">Volver</a>
                </div>
            </div>
        </div>
    </section>
@endsection
