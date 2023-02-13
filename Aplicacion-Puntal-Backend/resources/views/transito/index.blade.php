@extends('layouts.app')

@section('template_title')
Transito
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <div style="display: flex; justify-content: space-between; align-items: center;">

                        <span id="card_title">
                            {{ __('Transito') }}
                        </span>

                        <div class="float-right">
                            <a href="{{ route('transitos.create') }}" class="btn btn-secondary btn-sm float-right" data-placement="left">
                                {{ __('Create New') }}
                            </a>
                            {{-- <a class="btn btn-info btn-sm float-right" href="{{ route('plaza.index') }}"> Back</a>
                        </div> --}}
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

                                    <th>Idplaza</th>
                                    <th>Fechaentrada</th>
                                    <th>Fechasalida</th>
                                    <th>IdMuelle</th>
                                    <th>Nombre Instalación</th>

                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($transitos as $transito)
                                <tr>
                                    <td>{{ ++$i }}</td>

                                    <td>{{ $transito->idPlaza }}</td>
                                    <td>{{ $transito->fechaEntrada }}</td>
                                    <td>{{ $transito->fechaSalida }}</td>
                                    <td>{{ $transito->plaza->idMuelle }}</td>
                                    <td>{{ $transito->plaza->muelle->instalacion->nombrePuerto }}</td>

                                    <td>
                                        <form action="{{ route('transitos.destroy',$transito->idPlaza) }}" method="POST">
                                            <a class="btn btn-sm btn-primary " href="{{ route('transitos.show',$transito->idPlaza) }}"><i class="bi bi-eye"></i></a>
                                            <a class="btn btn-sm btn-success" href="{{ route('transitos.edit',$transito->idPlaza) }}"><i class="bi bi-pencil"></i></a>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"><i class="bi bi-trash3-fill"></i></button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            {{-- {!! $transitos->links() !!} --}}
        </div>
    </div>
</div>
@endsection
