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
                                    @foreach ($clientesOrdenado as $cliente)
                                        <tr>
                                            <td>{{ $cliente['numDocumento'] }}</td>
                                            <td>{{ $cliente['nombre'] }}</td>
                                            <td>{{ $cliente['apellidos'] }}</td>
                                            <td>{{ $cliente['email'] }}</td>
                                            <td>{{ $cliente['direccion'] }}</td>
                                            <td>{{ $cliente['tipoDocumento'] }}</td>
                                            <td>{{ $cliente['observaciones'] }}</td>
                                            <td>
                                                <form
                                                    action="{{ route('clientes.destroy', $cliente['numDocumento']) }}"
                                                    method="POST">
                                                    <a class="btn btn-sm btn-primary "
                                                        href="{{ route('clientes.show', $cliente['numDocumento']) }}"><i
                                                            class="bi bi-eye"></i></a>
                                                    <a class="btn btn-sm btn-success"
                                                        href="{{ route('clientes.edit', $cliente['numDocumento']) }}"><i
                                                            class="bi bi-pencil"></i></a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"><i
                                                            class="bi bi-trash3-fill"></i></button>
                                                </form>
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
