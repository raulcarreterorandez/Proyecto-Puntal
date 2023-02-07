@extends('layouts.app')

@section('template_title')
    Update Usuario
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title h1">Update Usuario</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('usuarios.update', $usuario->email) }}"  role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            @if ($usuario->habilitado == 0)
                                {{-- En caso de que no lo pulse, sigue deshabilitado --}}
                                 <input type="hidden" name="habilitado" value="0">

                                {{-- Si pulsa, habilitamos el usuario --}}
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" name="habilitado" value="1">
                                    <label class="form-check-label">HABILITAR USUARIO</label>
                                  </div>

                            @else
                                <input type="hidden" name="habilitado" value="1">
                            @endif

                            @include('usuario.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
