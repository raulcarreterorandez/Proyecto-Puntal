@extends('layouts.app')

@section('template_title')
Plaza
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <div style="display: flex; justify-content: space-between; align-items: center;">

                        <span id="card_title">
                            {{ __('Plaza') }}
                        </span>

                        <div class="float-right">
                            <a href="{{ route('plazas.create') }}" class="btn btn-secondary btn-sm float-right" data-placement="left">
                                {{ __('Create New') }}
                            </a>
                            <a class="btn btn-primary btn-sm float-right" href="{{ route('transito.index') }}"> Visualizar Tránsitos</a>
                            <a class="btn btn-primary btn-sm float-right" href="{{ route('base.index') }}"> Visualizar Bases</a>
                            <a class="btn btn-info btn-sm float-right" href="{{ route('muelle.index') }}"> Back</a>
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
                                    <th>No</th>
                                    <th>IdPlaza</th>
                                    <th>Disponible</th>
                                    <th>Visto</th>
                                    <th>PuertoOrigen</th>
                                    <th>PuertoDestino</th>
                                    <th>Año</th>
                                    <th>IdMuelle</th>
                                    <th>Nombre Instalación</th>

                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($plazas as $plaza)
                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td>{{ $plaza->id }}</td>
                                    <td>{{ $plaza->disponible }}</td>
                                    <td>{{ $plaza->visto }}</td>
                                    <td>{{ $plaza->puertoOrigen }}</td>
                                    <td>{{ $plaza->puertoDestino }}</td>
                                    <td>{{ $plaza->año }}</td>
                                    <td>{{ $plaza->idMuelle }}</td>
                                    <td>{{ $plaza->muelle->instalacion->nombrePuerto }}</td>

                                    <td>
                                        <form action="{{ route('plazas.destroy',$plaza->id) }}" method="POST">
                                            <a class="btn btn-sm btn-primary " href="{{ route('plazas.show',$plaza->id) }}"><i class="fa fa-fw fa-eye"></i> Show</a>
                                            <a class="btn btn-sm btn-success" href="{{ route('plazas.edit',$plaza->id) }}"><i class="fa fa-fw fa-edit"></i> Edit</a>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i> Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            {!! $plazas->links() !!}
        </div>
    </div>
</div>
@endsection
