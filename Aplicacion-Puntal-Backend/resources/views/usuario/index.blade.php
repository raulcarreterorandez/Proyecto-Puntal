@extends('layouts.app')

@section('template_title')
    Usuario
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                <h1>{{ __('Listado de Usuarios') }}</h1>
                            </span>

                            <div class="float-right">
                                <a href="{{ route('usuarios.create') }}" class="btn btn-secondary btn-sm float-right"
                                    data-placement="left">
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

                                        <th>Nombreusuario</th>
                                        <th>Nombrecompleto</th>
                                        <th>Email</th>
                                        <th>Habilitado</th>
                                        <th>Perfil</th>
                                        <th>Idioma</th>
                                        <th>Instalaciones</th>

                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($usuarios as $usuario)
                                        <tr>
                                            <td>{{ ++$i }}</td>

                                            <td>{{ $usuario->nombreUsuario }}</td>
                                            {{-- <td>{{ $usuario->password }}</td> --}}
                                            <td>{{ $usuario->nombreCompleto }}</td>
                                            <td>{{ $usuario->email }}</td>
                                            @if ($usuario->habilitado === 1)
                                                <td><i class="bi bi-check-square-fill" style="color: green"><a
                                                            style="visibility: hidden">0</a></td>
                                            @else
                                                <td><i class="bi bi-x-square-fill" style="color: red"> <a
                                                            style="visibility: hidden">1</a> </td>
                                            @endif
                                            <td>{{ $usuario->perfil }}</td>
                                            <td>{{ $usuario->idioma }}</td>

                                            <td>
                                                @foreach ($usuario->instalacionesUsuario as $instalacion_usuario)
                                                    /{{ $instalacion_usuario->nombrePuerto }}/
                                                @endforeach
                                            </td>

                                            <td>
                                                    <a class="btn btn-sm btn-primary " href="{{ route('usuarios.show',$usuario->email) }}" data-bs-toggle="tooltip"> <i class="bi bi-eye"></i> </a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('usuarios.edit',$usuario->email) }}"><i class="bi bi-pencil"></i> </a>

                                                    @if ($usuario->habilitado === 1)
                                                        <a class="btn btn-sm btn-danger " href="{{ route('usuarios.confirm',$usuario->email) }}"><i class="bi bi-trash3-fill"></i> </a>
                                                    @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>No</th>
                                        <th>Nombreusuario</th>
                                        {{-- <th>Password</th> --}}
                                        <th>Nombrecompleto</th>
                                        <th>Email</th>
                                        <th>Habilitado</th>
                                        <th>Perfil</th>
                                        <th>Idioma</th>
                                        {{-- <th>Visto</th> --}}
                                        <th>Instalacion</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
                {{-- {!! $usuarios->links() !!} --}}

            </div>
        </div>
    </div>
@endsection
