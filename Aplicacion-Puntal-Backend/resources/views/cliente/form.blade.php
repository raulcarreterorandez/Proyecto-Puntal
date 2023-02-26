-- @if ($errors->any())
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $errors }}</li>
        @endforeach
    </ul>
    <br />
@endif --
<div class="box box-info padding-1">
    <div class="box-body">
        <div class="form-group">
            {{ Form::label('numDocumento') }}
            {{ Form::text('numDocumento', $cliente->numDocumento, ['class' => 'form-control' . ($errors->has('numDocumento') ? ' is-invalid' : ''), 'placeholder' => '00000000X']) }}
            {!! $errors->first('numDocumento', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <br>
        <div class="form-group">
            {{ Form::label('nombre') }}
            {{ Form::text('nombre', $cliente->nombre, ['class' => 'form-control' . ($errors->has('nombre') ? ' is-invalid' : ''), 'placeholder' => 'Nombre']) }}
            {!! $errors->first('nombre', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <br>
        <div class="form-group">
            {{ Form::label('apellidos') }}
            {{ Form::text('apellidos', $cliente->apellidos, ['class' => 'form-control' . ($errors->has('apellidos') ? ' is-invalid' : ''), 'placeholder' => 'Apellidos']) }}
            {!! $errors->first('apellidos', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <br>
        <div class="form-group">
            {{ Form::label('email') }}
            {{ Form::text('email', $cliente->email, ['class' => 'form-control' . ($errors->has('email') ? ' is-invalid' : ''), 'placeholder' => 'email@email.com']) }}
            {!! $errors->first('email', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <br>
        <div class="form-group">
            {{ Form::label('direccion') }}
            {{ Form::text('direccion', $cliente->direccion, ['class' => 'form-control' . ($errors->has('direccion') ? ' is-invalid' : ''), 'placeholder' => 'C/']) }}
            {!! $errors->first('direccion', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <br>
        <label for="tipoDocumento">Tipo de documento</label>
        <select name="tipoDocumento" class="form-select">
            <option value="" disabled>Elige un tipo de documento</option>
            <option value="DNI" selected>DNI</option>
            <option value="NIE">NIE</option>
            <option value="Pasaporte">Pasaporte</option>
        </select>
        <br>
        <div class="form-group">
            {{ Form::label('Teléfono') }}
            {{ Form::text('telefono', $telefono->numero, ['class' => 'form-control' . ($errors->has('telefono') ? ' is-invalid' : ''), 'placeholder' => '+00 000 000 000']) }}
            {!! $errors->first('telefono', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <br>
        <div class="form-group">
            {{ Form::label('observaciones') }}
            {{ Form::text('observaciones', $cliente->observaciones, ['class' => 'form-control' . ($errors->has('observaciones') ? ' is-invalid' : ''), 'placeholder' => 'Observaciones']) }}
            {!! $errors->first('observaciones', '<div class="invalid-feedback">:message</div>') !!}
        </div>
    </div>
    <br>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Enviar</button>
        <a class="btn btn-primary btn-danger" href="{{ route('clientes.index') }}">Cancelar</a>
    </div>
</div>
