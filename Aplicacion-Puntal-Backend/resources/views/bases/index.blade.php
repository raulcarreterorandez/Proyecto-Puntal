@extends('layouts.app')

@section('template_title')
    Base
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Bases') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('bases.create') }}" class="btn btn-secondary btn-sm float-right"  data-placement="left">
                                  {{ __('Create New') }}
                                </a>
                                <a class="btn btn-info btn-sm float-right" href="{{ route('plaza.index') }}"> Back</a>
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
                                        
										<th>Idplaza</th>
										<th>Fechaentrada</th>
										<th>Fechasalida</th>
                                        <th>IdMuelle</th>
                                        <th>Nombre Instalación</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($bases as $base)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $base->idPlaza }}</td>
											<td>{{ $base->fechaEntrada }}</td>
											<td>{{ $base->fechaSalida }}</td>
                                            <td>{{ $base->plaza->idMuelle }}</td>
                                            <td>{{ $base->plaza->muelle->instalacion->nombrePuerto }}</td>

                                            <td>
                                                <form action="{{ route('bases.destroy',$base->idPlaza) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('bases.show',$base->idPlaza) }}"><i class="fa fa-fw fa-eye"></i> Show</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('bases.edit',$base->idPlaza) }}"><i class="fa fa-fw fa-edit"></i> Edit</a>
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
                {!! $bases->links() !!}
            </div>
        </div>
    </div>
@endsection
