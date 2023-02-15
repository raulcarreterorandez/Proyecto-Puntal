@extends('layouts.app')

@section('template_title')
    Mensaje
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                <h1>{{ __('Buzon de Mensajes') }}</h1>
                            </span>

                             <div class="float-right">
                                <a href="{{ route('mensajes.create') }}" class="btn btn-secondary btn-sm float-right"  data-placement="left">
                                  {{ __('Create New') }}
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
                            <table id="example" class="table table-striped table-hover" style="width: 100%">
                                <thead class="thead">
                                    <tr>
                                        <th>No</th>

										<th>Mensaje</th>
										<th>Fecha</th>
										<th>Remitente</th>

                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($mensajes as $mensaje)
                                        <tr>
                                            @if ($mensaje->leido === 0)
                                                <td>{{ ++$i }}</td>

                                                <td>{{ $mensaje->texto }}</td>
                                                <td>{{ $mensaje->fecha_hora }}</td>
                                                <td>{{ $mensaje->idUsuarioOrigen }}</td>
                                            @else
                                                <td style="color: gray">{{ ++$i }}</td>
                                                <td style="color: gray">  {{ $mensaje->texto }}</td>
                                                <td style="color: gray">{{ $mensaje->fecha_hora }}</td>
                                                <td style="color: gray">{{ $mensaje->idUsuarioOrigen }}</td>
                                            @endif


                                            <td>
                                                {{-- <form action="{{ route('mensajes.destroy',$mensaje->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('mensajes.show',$mensaje->id) }}"><i class="bi bi-eye"></i></a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"><i class="bi bi-trash3-fill"></i></button>
                                                </form> --}}
                                                <a class="btn btn-sm btn-primary " href="{{ route('mensajes.show',$mensaje->id) }}"><i class="bi bi-eye"></i></a>

                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {{-- {!! $mensajes->links() !!} --}}
            </div>
        </div>
    </div>
@endsection
