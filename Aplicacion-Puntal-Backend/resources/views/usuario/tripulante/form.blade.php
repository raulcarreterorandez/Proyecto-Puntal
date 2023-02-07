<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('numDocumento') }}
            {{ Form::text('numDocumento', $tripulante->numDocumento, ['class' => 'form-control' . ($errors->has('numDocumento') ? ' is-invalid' : ''), 'placeholder' => 'Numdocumento']) }}
            {!! $errors->first('numDocumento', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('nombre') }}
            {{ Form::text('nombre', $tripulante->nombre, ['class' => 'form-control' . ($errors->has('nombre') ? ' is-invalid' : ''), 'placeholder' => 'Nombre']) }}
            {!! $errors->first('nombre', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('apellidos') }}
            {{ Form::text('apellidos', $tripulante->apellidos, ['class' => 'form-control' . ($errors->has('apellidos') ? ' is-invalid' : ''), 'placeholder' => 'Apellidos']) }}
            {!! $errors->first('apellidos', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('nacionalidad') }}
            {{ Form::text('nacionalidad', $tripulante->nacionalidad, ['class' => 'form-control' . ($errors->has('nacionalidad') ? ' is-invalid' : ''), 'placeholder' => 'Nacionalidad']) }}
            {!! $errors->first('nacionalidad', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('fechaNacimiento') }}
            {{ Form::text('fechaNacimiento', $tripulante->fechaNacimiento, ['class' => 'form-control' . ($errors->has('fechaNacimiento') ? ' is-invalid' : ''), 'placeholder' => 'Fechanacimiento']) }}
            {!! $errors->first('fechaNacimiento', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('lugarNacimiento') }}
            {{ Form::text('lugarNacimiento', $tripulante->lugarNacimiento, ['class' => 'form-control' . ($errors->has('lugarNacimiento') ? ' is-invalid' : ''), 'placeholder' => 'Lugarnacimiento']) }}
            {!! $errors->first('lugarNacimiento', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('paisNacimiento') }}
            {{ Form::text('paisNacimiento', $tripulante->paisNacimiento, ['class' => 'form-control' . ($errors->has('paisNacimiento') ? ' is-invalid' : ''), 'placeholder' => 'Paisnacimiento']) }}
            {!! $errors->first('paisNacimiento', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('tipoDocumento') }}
            {{ Form::text('tipoDocumento', $tripulante->tipoDocumento, ['class' => 'form-control' . ($errors->has('tipoDocumento') ? ' is-invalid' : ''), 'placeholder' => 'Tipodocumento']) }}
            {!! $errors->first('tipoDocumento', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('fechaExpedicionDocumento') }}
            {{ Form::text('fechaExpedicionDocumento', $tripulante->fechaExpedicionDocumento, ['class' => 'form-control' . ($errors->has('fechaExpedicionDocumento') ? ' is-invalid' : ''), 'placeholder' => 'Fechaexpediciondocumento']) }}
            {!! $errors->first('fechaExpedicionDocumento', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('fechaCaducidadDocumento') }}
            {{ Form::text('fechaCaducidadDocumento', $tripulante->fechaCaducidadDocumento, ['class' => 'form-control' . ($errors->has('fechaCaducidadDocumento') ? ' is-invalid' : ''), 'placeholder' => 'Fechacaducidaddocumento']) }}
            {!! $errors->first('fechaCaducidadDocumento', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('id_plaza') }}
            {{ Form::text('id_plaza', $tripulante->id_plaza, ['class' => 'form-control' . ($errors->has('id_plaza') ? ' is-invalid' : ''), 'placeholder' => 'Id Plaza']) }}
            {!! $errors->first('id_plaza', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('id_embarcacion') }}
            {{ Form::text('id_embarcacion', $tripulante->id_embarcacion, ['class' => 'form-control' . ($errors->has('id_embarcacion') ? ' is-invalid' : ''), 'placeholder' => 'Id Embarcacion']) }}
            {!! $errors->first('id_embarcacion', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('visto') }}
            {{ Form::text('visto', $tripulante->visto, ['class' => 'form-control' . ($errors->has('visto') ? ' is-invalid' : ''), 'placeholder' => 'Visto']) }}
            {!! $errors->first('visto', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>