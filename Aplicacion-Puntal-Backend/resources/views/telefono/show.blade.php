@extends('layouts.app')
@section('template_title')
    {{ $telefono->name ?? 'Show Telefono' }}
@endsection
@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Detalles del Teléfono {{ $telefono->numero }}</span>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <strong>Numero:</strong>
                            {{ $telefono->numero }}
                        </div>
                        <div class="form-group">
                            <strong>Cliente:</strong>
                            {{ $telefono->idCliente }}
                        </div>
                    </div>
                </div>
                <br>
                <div class="float-right">
                    <a class="btn btn-primary" href="{{ route('telefonos.index') }}">Voler</a>
                </div>
            </div>
        </div>
    </section>
@endsection
