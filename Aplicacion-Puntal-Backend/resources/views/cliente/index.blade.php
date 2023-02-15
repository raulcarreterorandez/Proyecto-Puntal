@extends('layouts.app')
@section('template_title')
    Clientes
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Clientes') }}
                            </span>

                            <div class="float-right">
                                <a href="{{ route('clientes.create') }}" class="btn btn-primary btn-sm float-right"
                                    data-placement="left">
                                    {{ __('Añadir nuevo cliente') }}
                                </a>
                            </div>
                        </div>
                    </div>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif

                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example" class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>Documento</th>
                                        <th>Nombre</th>
                                        <th>Apellidos</th>
                                        <th>Email</th>
                                        <th>Dirección</th>
                                        <th>Tipo de documento</th>
                                        <th>Observaciones</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($clientes as $cliente)
                                        <tr>
                                            <td>{{ $cliente[0]['numDocumento'] }}</td>
                                            <td>{{ $cliente[0]['nombre'] }}</td>
                                            <td>{{ $cliente[0]['apellidos'] }}</td>
                                            <td>{{ $cliente[0]['email'] }}</td>
                                            <td>{{ $cliente[0]['direccion'] }}</td>
                                            <td>{{ $cliente[0]['tipoDocumento'] }}</td>
                                            <td>{{ $cliente[0]['observaciones'] }}</td>
                                            <td>
                                                <a class="btn btn-sm btn-primary "
                                                    href="{{ route('clientes.show', $cliente[0]["numDocumento"]) }}"
                                                    data-bs-toggle="tooltip"> <i class="bi bi-eye"></i>
                                                </a>
                                                <a class="btn btn-sm btn-success"
                                                    href="{{ route('clientes.edit', $cliente[0]["numDocumento"]) }}"><i
                                                        class="bi bi-pencil"></i>
                                                </a>
                                                <a class="btn btn-sm btn-danger "
                                                    href="{{ route('clientes.destroy', $cliente[0]["numDocumento"]) }}"><i
                                                        class="bi bi-trash3-fill"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
