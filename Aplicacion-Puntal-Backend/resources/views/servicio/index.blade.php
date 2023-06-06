@extends('layouts.app')

@section('template_title')
Servicio
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <div style="display: flex; justify-content: space-between; align-items: center;">

                        <span id="card_title">
                            {{ __('Servicio') }}
                        </span>

                        <div class="float-right">
                            <a href="{{ route('servicios.create') }}" class="btn btn-secondary btn-sm float-right" data-placement="left">
                                {{ __('Create New') }}
                            </a>
                            <a class="btn btn-primary btn-sm float-right" href="{{ route('embarcaciones.index') }}"> Visualiza Embarcaciones</a>

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
                        <table id="example" class="table table-striped table-hover" style="width: 100%">
                            <thead class="thead">
                                <tr>
                                    <th>No</th>
                                    <th>Matrícula Embarcación</th>
                                    <th>Nombre Embarcación</th>
                                    <th>Tipo Servicio</th>
                                    <th>Num. Horas</th>
                                    <th>Precio Hora</th>
                                    <th>fechaSolicitud</th>
                                    <th>Abonado</th>
                                    <th>Finalizado</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($servicios as $servicio)
                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td>{{ $servicio->matriculaEmbarcacion }}</td>
                                    <td>{{ $servicio->embarcacion->nombre }}</td>
                                    <td>{{ $servicio->tipoServicio }}</td>
                                    <td>{{ $servicio->numHoras }}</td>
                                    <td>{{ $servicio->precioHora }}</td>
                                    <td>{{ $servicio->fechaSolicitud }}</td>
                                    <td>{{ $servicio->abonado == 1 ? 'Sí' : 'No' }}</td>
                                    <td>{{ $servicio->finalizado == 1 ? 'Sí' : 'No' }}</td>
                                    <td id="acciones">
                                        <form action="{{ route('servicios.destroy',$servicio->id) }}" method="POST">
                                            <a class="btn btn-sm btn-primary " href="{{ route('servicios.show',$servicio->id) }}"><i class="bi bi-eye"></i></a>
                                            <a class="btn btn-sm btn-success" href="{{ route('servicios.edit',$servicio->id) }}"><i class="bi bi-pencil"></i></a>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"><i class="bi bi-trash3-fill"></i></button>
                                            @if ($servicio->finalizado == 1)
                                            <a id="iconoPDF" class="btn btn-sm btn-info" href="{{ route('servicios.servicioPDF',$servicio) }}"><i class="bi bi-filetype-pdf"></i></a>
                                            @endif
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            {{-- {!! $servicios->links() !!} --}}
        </div>
    </div>
</div>
@endsection
<style>
    #iconoPDF {
        color:white;
    }

</style>