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
                                <a href="{{ route('tripulantes.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
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
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>No</th>
                                        
										<th>Numdocumento</th>
										<th>Nombre</th>
										<th>Apellidos</th>
										<th>Nacionalidad</th>
										<th>Fechanacimiento</th>
										<th>Lugarnacimiento</th>
										<th>Paisnacimiento</th>
										<th>Tipodocumento</th>
										<th>Fechaexpediciondocumento</th>
										<th>Fechacaducidaddocumento</th>
										<th>Id Plaza</th>
										<th>Id Embarcacion</th>
										<th>Visto</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($tripulantes as $tripulante)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $tripulante->numDocumento }}</td>
											<td>{{ $tripulante->nombre }}</td>
											<td>{{ $tripulante->apellidos }}</td>
											<td>{{ $tripulante->nacionalidad }}</td>
											<td>{{ $tripulante->fechaNacimiento }}</td>
											<td>{{ $tripulante->lugarNacimiento }}</td>
											<td>{{ $tripulante->paisNacimiento }}</td>
											<td>{{ $tripulante->tipoDocumento }}</td>
											<td>{{ $tripulante->fechaExpedicionDocumento }}</td>
											<td>{{ $tripulante->fechaCaducidadDocumento }}</td>
											<td>{{ $tripulante->id_plaza }}</td>
											<td>{{ $tripulante->id_embarcacion }}</td>
											<td>{{ $tripulante->visto }}</td>

                                            <td>
                                                <form action="{{ route('tripulantes.destroy',$tripulante->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('tripulantes.show',$tripulante->id) }}"><i class="fa fa-fw fa-eye"></i> Show</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('tripulantes.edit',$tripulante->id) }}"><i class="fa fa-fw fa-edit"></i> Edit</a>
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
                {!! $tripulantes->links() !!}
            </div>
        </div>
    </div>
@endsection
