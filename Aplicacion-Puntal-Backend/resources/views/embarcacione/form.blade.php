<div class="box box-info padding-1">
    <div class="box-body">
        <div class="form-group">
            {{ Form::label('matricula') }}
            {{ Form::text('matricula', $embarcacione->matricula, ['class' => 'form-control' . ($errors->has('matricula') ? ' is-invalid' : ''), 'placeholder' => '00000000']) }}
            {!! $errors->first('matricula', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <br>
        <div class="form-group">
            {{ Form::label('nombre') }}
            {{ Form::text('nombre', $embarcacione->nombre, ['class' => 'form-control' . ($errors->has('nombre') ? ' is-invalid' : ''), 'placeholder' => 'Nombre']) }}
            {!! $errors->first('nombre', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <br>
        <div class="form-group">
            {{ Form::label('eslora') }}
            {{ Form::text('eslora', $embarcacione->eslora, ['class' => 'form-control' . ($errors->has('eslora') ? ' is-invalid' : ''), 'placeholder' => '0.0']) }}
            {!! $errors->first('eslora', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <br>
        <div class="form-group">
            {{ Form::label('manga') }}
            {{ Form::text('manga', $embarcacione->manga, ['class' => 'form-control' . ($errors->has('manga') ? ' is-invalid' : ''), 'placeholder' => '0.0']) }}
            {!! $errors->first('manga', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <br>
        <div class="form-group">
            {{ Form::label('calado') }}
            {{ Form::text('calado', $embarcacione->calado, ['class' => 'form-control' . ($errors->has('calado') ? ' is-invalid' : ''), 'placeholder' => '0.0']) }}
            {!! $errors->first('calado', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <br>
        <label for="propulsion">Tipo de propulsión</label>
        <br>
        <select name="propulsion" class="form-select">
            <option value="" disabled selected>Elige un tipo de propulsión</option>
            <option value="Motor">Motor</option>
            <option value="Vela">Vela</option>
        </select>
        <br>
        <div class="form-group">
            {{ Form::label('Documento del cliente') }}
            {{ Form::select('id_cliente', $clientes, $embarcacione->id_cliente, ['class' => 'form-control' . ($errors->has('id_cliente') ? ' is-invalid' : ''), 'placeholder' => '00000000X']) }}
            {!! $errors->first('id_cliente', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <br>
        <div>
            {{ Form::label('Plazas disponibles') }}
            {{ Form::select('id_plaza', $plazas, $embarcacione->id_plaza, ['class' => 'form-select' . ($errors->has('id_plaza') ? ' is-invalid' : ''), 'placeholder' => 'Plazas disponibles']) }}
            {!! $errors->first('id_plaza', '<div class="invalid-feedback">:message</div>') !!}
        </div>
    </div>
    <div class="box-footer mt20">
        <br>
        <button type="submit" class="btn btn-primary">Guardar</button>
    </div>
</div>
