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
                                <a href="{{ route('muelles.create') }}" class="btn btn-secondary btn-sm float-right"  data-placement="left">
                                  {{ __('Create New') }}
                                </a>
                                <a class="btn btn-primary btn-sm float-right" href="{{ route('plaza.index') }}"> Visualiza Plazas</a>
                                <a class="btn btn-info btn-sm float-right" href="{{ route('instalacionIndex') }}"> Back</a>
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
                                        
										<th>Idinstalacion</th>
										<th>Visto</th>
                                        <th>Id Instalación</th>
										<th>Nombre Instalación</th>  

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($muelles as $muelle)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $muelle->idInstalacion }}</td>
											<td>{{ $muelle->visto }}</td>
                                            <td>{{ $muelle->instalacion->id }}</td>
                                            <td>{{ $muelle->instalacion->nombrePuerto }}</td>  

                                            <td>
                                                <form action="{{ route('muelles.destroy',$muelle->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('muelles.show',$muelle->id) }}"><i class="fa fa-fw fa-eye"></i> Show</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('muelles.edit',$muelle->id) }}"><i class="fa fa-fw fa-edit"></i> Edit</a>
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
                {!! $muelles->links() !!}
            </div>
        </div>
    </div>
@endsection
