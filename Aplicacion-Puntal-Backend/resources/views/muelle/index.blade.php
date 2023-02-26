@extends('layouts.app')

@section('template_title')
Muelle
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <div style="display: flex; justify-content: space-between; align-items: center;">

                        <span id="card_title">
                            {{ __('Muelle') }}
                        </span>

                        <div class="float-right">
                            <a href="{{ route('muelles.create') }}" class="btn btn-secondary btn-sm float-right" data-placement="left">
                                {{ __('Create New') }}
                            </a>
                            {{-- <a class="btn btn-primary btn-sm float-right" href="{{ route('plazas.index') }}"> Visualiza Plazas</a> 
                            {{-- <a class="btn btn-info btn-sm float-right" href="{{ route('instalacionIndex') }}"> Back</a> --}}
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

                                    <th>Nº Muelle</th>
                                    <!-- <th>Visto</th> -->
                                    <th>Código Instalación</th>
                                    <th>Nombre Instalación</th>
                                    <th>Acciones</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($muelles as $muelle)
                                <tr>
                                    <td>{{ ++$i }}</td>

                                    <td>{{ $muelle->id }}</td>
                                    <!-- <td>{{ $muelle->visto }}</td> -->
                                    <td>{{ $muelle->instalacion->codigo }}</td>
                                    <td>{{ $muelle->instalacion->nombrePuerto }}</td>

                                    <td>
                                        <form action="{{ route('muelles.destroy',$muelle->id) }}" method="POST">
                                            <a class="btn btn-sm btn-primary " href="{{ route('muelles.show',$muelle->id) }}"><i class="bi bi-eye"></i></a>
                                            <a class="btn btn-sm btn-success" href="{{ route('muelles.edit',$muelle->id) }}"><i class="bi bi-pencil"></i></a>
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
            {{-- {!! $muelles->links() !!} --}}
        </div>
    </div>
</div>
@endsection
