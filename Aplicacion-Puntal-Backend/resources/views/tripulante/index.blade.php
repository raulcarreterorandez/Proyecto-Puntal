@extends('layouts.app')
@section('template_title')
    Tripulante
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <span id="card_title">
                                {{ __('Tripulante') }}
                            </span>
                            <div class="float-right">
                                <a href="{{ route('tripulantes.create') }}" class="btn btn-primary btn-sm float-right"
                                    data-placement="left">
                                    {{ __('Añadir nuevo tripulante') }}
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
                                        <th>Documento</th>
                                        <th>Nombre y Apellidos</th>
                                        <th>Nacionalidad</th>
                                        <th>Fecha De Nacimiento</th>
                                        <th>Lugar De Nacimiento</th>
                                        <th>Pais De Nacimiento</th>
                                        <th>Tipo De Documento</th>
                                        <th>Fecha De Expedición Del Documento</th>
                                        <th>Fecha De Caducidad Del Documento</th>
                                        <th>Plaza</th>
                                        <th>Embarcacion</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($tripulantes as $tripulante)
                                        <tr>
                                            <td>{{ $tripulante->numDocumento }}</td>
                                            <td>{{ $tripulante->nombre." ".$tripulante->apellidos }}</td>
                                            <td>{{ $tripulante->nacionalidad }}</td>
                                            <td>{{ $tripulante->fechaNacimiento }}</td>
                                            <td>{{ $tripulante->lugarNacimiento }}</td>
                                            <td>{{ $tripulante->paisNacimiento }}</td>
                                            <td>{{ $tripulante->tipoDocumento }}</td>
                                            <td>{{ $tripulante->fechaExpedicionDocumento }}</td>
                                            <td>{{ $tripulante->fechaCaducidadDocumento }}</td>
                                            <td>{{ $tripulante->id_plaza }}</td>
                                            <td>{{ $tripulante->id_embarcacion }}</td>
                                            <td>
                                                <form action="{{ route('tripulantes.destroy', $tripulante->numDocumento) }}"
                                                    method="POST">
                                                    <a class="btn btn-sm btn-primary "
                                                        href="{{ route('tripulantes.show', $tripulante->numDocumento) }}"><i
                                                            class="fa fa-fw fa-eye"></i>Detalles</a>
                                                    <a class="btn btn-sm btn-success"
                                                        href="{{ route('tripulantes.edit', $tripulante->numDocumento) }}"><i
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
                {!! $tripulantes->links() !!}
            </div>
        </div>
    </div>
@endsection
