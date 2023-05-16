<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('Matrícula Embarcación') }}
            {{ Form::select('matricula',$embarcaciones, $servicio->matriculaEmbarcacion, ['class' => 'form-control' . ($errors->has('matriculaEmbarcacion') ? ' is-invalid' : ''), 'placeholder' => 'Matricula']) }}
            {!! $errors->first('matricula', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <br>
        <div class="form-group">
            {{ Form::label('Tipo Servicio') }}
            {{ Form::text('tipoServicio', $servicio->tipoServicio, ['class' => 'form-control' . ($errors->has('tipoServicio') ? ' is-invalid' : ''), 'placeholder' => 'Tipo Servicio']) }}
            {!! $errors->first('tipoServicio', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <br>
        <div class="form-group">
            {{ Form::label('Precio Hora') }}
            {{ Form::text('precioHora', $servicio->precioHora, ['class' => 'form-control' . ($errors->has('precioHora') ? ' is-invalid' : ''), 'placeholder' => 'Precio Hora']) }}
            {!! $errors->first('nombre', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <br>
        <div class="form-group">
            {{ Form::label('Fecha/Hora Inicio') }}
            {{ Form::text('timeStampInicio', $servicio->timeStampInicio, ['class' => 'form-control' . ($errors->has('timeStampInicio') ? ' is-invalid' : ''), 'placeholder' => 'Fecha/Hora Inicio']) }}
            {!! $errors->first('timeStampInicio', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <br>
        <div class="form-group">
            {{ Form::label('Fecha/Hora Final') }}
            {{ Form::text('timeStampFinal', $servicio->timeStampFinal, ['class' => 'form-control' . ($errors->has('timeStampFinal') ? ' is-invalid' : ''), 'placeholder' => 'Fecha/Hora Final']) }}
            {!! $errors->first('timeStampFinal', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <br>
        <div class="form-group">
            {{ Form::label('Abonado') }}
            {{ Form::text('abonado', $servicio->abonado, ['class' => 'form-control' . ($errors->has('abonado') ? ' is-invalid' : ''), 'placeholder' => 'Abonado']) }}
            {!! $errors->first('abonado', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <input type="hidden" name="visto" value="0"></input>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary m-2">Submit</button>
    </div>
</div>