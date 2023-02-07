@extends('layouts.app')

@section('template_title')
    Instalacion
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Instalacion') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('instalaciones.create') }}" class="btn btn-secondary btn-sm float-right"  data-placement="left">
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
                                        <th>Id</th>
										<th>Codigo</th>
										<th>Nombrepuerto</th>
										<th>Descripcion</th>
										<th>Estado</th>
										<th>Visto</th>
										<th>Fechadisposicion</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($instalaciones as $instalacione)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            <td>{{ $instalacione->id }}</td>
											<td>{{ $instalacione->codigo }}</td>
											<td>{{ $instalacione->nombrePuerto }}</td>
											<td>{{ $instalacione->descripcion }}</td>
											<td>{{ $instalacione->estado }}</td>
											<td>{{ $instalacione->visto }}</td>
											<td>{{ $instalacione->fechaDisposicion }}</td>

                                            <td>
                                                <form action="{{ route('instalaciones.destroy',$instalacione->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('instalaciones.show',$instalacione->id) }}"><i class="fa fa-fw fa-eye"></i> Show</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('instalaciones.edit',$instalacione->id) }}"><i class="fa fa-fw fa-edit"></i> Edit</a>
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
                {{-- {!! $instalaciones->links() !!} --}}
            </div>
        </div>
    </div>
@endsection
