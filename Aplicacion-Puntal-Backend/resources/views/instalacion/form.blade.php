<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('codigo') }}
            {{ Form::text('codigo', $instalacion->codigo, ['class' => 'form-control' . ($errors->has('codigo') ? ' is-invalid' : ''), 'placeholder' => 'Codigo']) }}
            {!! $errors->first('codigo', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('nombrePuerto') }}
            {{ Form::text('nombrePuerto', $instalacion->nombrePuerto, ['class' => 'form-control' . ($errors->has('nombrePuerto') ? ' is-invalid' : ''), 'placeholder' => 'Nombrepuerto']) }}
            {!! $errors->first('nombrePuerto', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('descripcion') }}
            {{ Form::text('descripcion', $instalacion->descripcion, ['class' => 'form-control' . ($errors->has('descripcion') ? ' is-invalid' : ''), 'placeholder' => 'Descripcion']) }}
            {!! $errors->first('descripcion', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('estado') }}
            {{ Form::text('estado', $instalacion->estado, ['class' => 'form-control' . ($errors->has('estado') ? ' is-invalid' : ''), 'placeholder' => 'Estado']) }}
            {!! $errors->first('estado', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('visto') }}
            {{ Form::text('visto', $instalacion->visto, ['class' => 'form-control' . ($errors->has('visto') ? ' is-invalid' : ''), 'placeholder' => 'Visto']) }}
            {!! $errors->first('visto', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('fechaDisposicion') }}
            {{ Form::date('fechaDisposicion', $instalacion->fechaDisposicion, ['class' => 'form-control' . ($errors->has('fechaDisposicion') ? ' is-invalid' : ''), 'placeholder' => 'Fechadisposicion']) }}
            {!! $errors->first('fechaDisposicion', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary m-3">Submit</button>
    </div>
</div>