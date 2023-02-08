@extends('layouts.app')
@section('template_title')
    Teléfono
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <span id="card_title">
                                {{ __('Teléfono') }}
                            </span>
                            <div class="float-right">
                                <a href="{{ route('telefonos.create') }}" class="btn btn-primary btn-sm float-right"
                                    data-placement="left">
                                    {{ __('Añadir nuevo teléfono') }}
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
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>Número</th>
                                        <th>Cliente</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($telefonos as $telefono)
                                        <tr>
                                            <td>{{ $telefono->numero }}</td>
                                            <td>{{ $telefono->idCliente }}</td>
                                            <td>
                                                <form action="{{ route('telefonos.destroy', $telefono->numero) }}"
                                                    method="POST">
                                                    <a class="btn btn-sm btn-primary "
                                                        href="{{ route('telefonos.show', $telefono->numero) }}"><i
                                                            class="fa fa-fw fa-eye"></i>Detalles</a>
                                                    <a class="btn btn-sm btn-success"
                                                        href="{{ route('telefonos.edit', $telefono->numero) }}"><i
                                                            class="fa fa-fw fa-edit"></i>Editar</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"><i
                                                            class="fa fa-fw fa-trash"></i>Borrar</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $telefonos->links() !!}
            </div>
        </div>
    </div>
@endsection