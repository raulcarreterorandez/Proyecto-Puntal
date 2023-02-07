@extends('layouts.app')

@section('template_title')
    Responder Mensaje
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title h1">Responder Mensaje de "<strong>{{$usuario}}</strong>"</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('mensajes.store') }}"  role="form" enctype="multipart/form-data">
                            @csrf
                            <div class="box box-info padding-1">
                                <div class="box-body">

                                    <div class="form-group">
                                        <label class="form-label">Destinatario</label>
                                        <input type="text" class='form-control' value="{{$usuario}}" disabled>
                                        <input type="hidden" name="idUsuarioDestino" value="{{$usuario}}">

                                    </div>

                                    <div class="form-group">
                                        {{ Form::label('texto') }}
                                        {{ Form::text('texto', $mensaje->texto, ['class' => 'form-control' . ($errors->has('texto') ? ' is-invalid' : ''), 'placeholder' => 'Texto']) }}
                                        {!! $errors->first('texto', '<div class="invalid-feedback">:message</div>') !!}
                                    </div>

                                    <input type="hidden" name="fecha_hora" value="0">
                                    <input type="hidden" name="leido" value=0>
                                    <input type="hidden" name="idUsuarioOrigen" value={{$user}}>

                                </div><br>
                                <div class="box-footer mt20">
                                    <button type="submit" class="btn btn-primary">Send</button>
                                    <a class="btn btn-primary btn-danger" href="{{ route('mensajes.index') }}"> Cancel</a>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
