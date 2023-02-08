@extends('layouts.app')

@section('template_title')
    Embarcaciones
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <span id="card_title">
                                {{ __('Embarcaciones') }}
                            </span>
                            <div class="float-right">
                                <a href="{{ route('embarcaciones.create') }}" class="btn btn-primary btn-sm float-right"
                                    data-placement="left">
                                    {{ __('Añadir nueva embarcación') }}
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
                                        <th>Matrícula</th>
                                        <th>Nombre</th>
                                        <th>Eslora</th>
                                        <th>Manga</th>
                                        <th>Calado</th>
                                        <th>Propulsion</th>
                                        <th>Cliente</th>
                                        <th>Plaza</th>
                                        {{-- <th>Visto</th> --}}
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($embarcaciones as $embarcacione)
                                        <tr>
                                            <td>{{ $embarcacione->matricula }}</td>
                                            <td>{{ $embarcacione->nombre }}</td>
                                            <td>{{ $embarcacione->eslora }}</td>
                                            <td>{{ $embarcacione->manga }}</td>
                                            <td>{{ $embarcacione->calado }}</td>
                                            <td>{{ $embarcacione->propulsion }}</td>
                                            <td>{{ $embarcacione->id_cliente }}</td>
                                            <td>{{ $embarcacione->id_plaza }}</td>
                                            {{-- <td>{{ $embarcacione->visto }}</td> --}}
                                            <td>
                                                <form action="{{ route('embarcaciones.destroy', $embarcacione->matricula) }}"
                                                    method="POST">
                                                    <a class="btn btn-sm btn-primary "
                                                        href="{{ route('embarcaciones.show', $embarcacione->matricula) }}"><i
                                                            class="fa fa-fw fa-eye"></i>Detalles</a>
                                                    <a class="btn btn-sm btn-success"
                                                        href="{{ route('embarcaciones.edit', $embarcacione->matricula) }}"><i
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
                {!! $embarcaciones->links() !!}
            </div>
        </div>
    </div>
@endsection