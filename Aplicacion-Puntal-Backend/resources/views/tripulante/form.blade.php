<div class="box box-info padding-1">
    <div class="box-body">
        <div class="form-group col-lg-7 col-md-10">
            {{ Form::label('Documento') }}
            {{ Form::text('numDocumento', $tripulante->numDocumento, ['class' => 'form-control' . ($errors->has('numDocumento') ? ' is-invalid' : ''), 'placeholder' => '00000000X']) }}
            {!! $errors->first('numDocumento', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <br>
        <div class="form-group col-lg-7 col-md-10">
            {{ Form::label('Nombre') }}
            {{ Form::text('nombre', $tripulante->nombre, ['class' => 'form-control' . ($errors->has('nombre') ? ' is-invalid' : ''), 'placeholder' => 'Nombre']) }}
            {!! $errors->first('nombre', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <br>
        <div class="form-group col-lg-7 col-md-10">
            {{ Form::label('Apellidos') }}
            {{ Form::text('apellidos', $tripulante->apellidos, ['class' => 'form-control' . ($errors->has('apellidos') ? ' is-invalid' : ''), 'placeholder' => 'Apellidos']) }}
            {!! $errors->first('apellidos', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <br>
        <div class="form-group col-lg-7 col-md-10">
            {{ Form::label('Nacionalidad') }}
            {{ Form::text('nacionalidad', $tripulante->nacionalidad, ['class' => 'form-control' . ($errors->has('nacionalidad') ? ' is-invalid' : ''), 'placeholder' => 'Nacionalidad']) }}
            {!! $errors->first('nacionalidad', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <br>
        <div class="form-group col-lg-7 col-md-10">
            {{ Form::label('Fecha De Nacimiento') }}
            {{ Form::date('fechaNacimiento', $tripulante->fechaNacimiento, ['class' => 'form-control' . ($errors->has('fechaNacimiento') ? ' is-invalid' : ''), 'placeholder' => '0000/00/00']) }}
            {!! $errors->first('fechaNacimiento', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <br>
        <div class="form-group col-lg-7 col-md-10">
            {{ Form::label('Lugar De Nacimiento') }}
            {{ Form::text('lugarNacimiento', $tripulante->lugarNacimiento, ['class' => 'form-control' . ($errors->has('lugarNacimiento') ? ' is-invalid' : ''), 'placeholder' => 'Lugar De Nacimiento']) }}
            {!! $errors->first('lugarNacimiento', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <br>
        <div class="form-group col-lg-7 col-md-10">
            {{ Form::label('Pais De Nacimiento') }}
            {{ Form::text('paisNacimiento', $tripulante->paisNacimiento, ['class' => 'form-control' . ($errors->has('paisNacimiento') ? ' is-invalid' : ''), 'placeholder' => 'Pais De Nacimiento']) }}
            {!! $errors->first('paisNacimiento', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <br>
        <div class="col-lg-7 col-md-10">
            <label for="tipoDocumento">Tipo de documento</label>
            <select name="tipoDocumento" class="form-select">
                <option value="" disabled>Elige un tipo de documento</option>
                <option value="DNI" selected>DNI</option>
                <option value="NIE">NIE</option>
                <option value="Pasaporte">Pasaporte</option>
            </select>
        </div>
        <br>
        <div class="form-group col-lg-7 col-md-10">
            {{ Form::label('Fecha De Expedición Del Documento') }}
            {{ Form::date('fechaExpedicionDocumento', $tripulante->fechaExpedicionDocumento, ['class' => 'form-control' . ($errors->has('fechaExpedicionDocumento') ? ' is-invalid' : ''), 'placeholder' => '0000/00/00']) }}
            {!! $errors->first('fechaExpedicionDocumento', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <br>
        <div class="form-group col-lg-7 col-md-10">
            {{ Form::label('Fecha De Caducidad Del Documento') }}
            {{ Form::date('fechaCaducidadDocumento', $tripulante->fechaCaducidadDocumento, ['class' => 'form-control' . ($errors->has('fechaCaducidadDocumento') ? ' is-invalid' : ''), 'placeholder' => '0000/00/00']) }}
            {!! $errors->first('fechaCaducidadDocumento', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <br>
        <input type="hidden" name="id_plaza" value="0">
        <div class="form-group col-lg-7 col-md-10">
            {{ Form::label('Embarcación') }}
            {{ Form::select('id_embarcacion', $embarcaciones, $tripulante->id_embarcacion, ['class' => 'form-control' . ($errors->has('id_embarcacion') ? ' is-invalid' : ''), 'placeholder' => 'Embarcación']) }}
            {!! $errors->first('id_embarcacion', '<div class="invalid-feedback">:message</div>') !!}
        </div>
    </div>
    <br>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Guardar</button>
        <a class="btn btn-primary btn-danger" href="{{ route('tripulantes.index') }}">Cancelar</a>
    </div>
</div>
