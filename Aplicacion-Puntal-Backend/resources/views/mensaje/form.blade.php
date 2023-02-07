<div class="box box-info padding-1">
    <div class="box-body">
        <div class="form-group">
            {{ Form::label('Destinatario') }}
            {{ Form::select('idUsuarioDestino',$usuarios, $mensaje->idUsuarioDestino, ['class' => 'form-control' . ($errors->has('idUsuarioDestino') ? ' is-invalid' : ''), 'placeholder' => '**Usuario Destino**']) }}
            {!! $errors->first('idUsuarioDestino', '<div class="invalid-feedback">:message</div>') !!}
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
