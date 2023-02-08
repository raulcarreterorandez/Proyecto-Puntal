<div class="box box-info padding-1">
    <div class="box-body">
        <div class="form-group">
            {{ Form::label('Número') }}
            {{ Form::text('numero', $telefono->numero, ['class' => 'form-control' . ($errors->has('numero') ? ' is-invalid' : ''), 'placeholder' => '+00 000 000 000']) }}
            {!! $errors->first('numero', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <br>
        <div class="form-group">
            {{ Form::label('Cliente') }}
            {{ Form::select('idCliente', $clientes, $telefono->idCliente, ['class' => 'form-control' . ($errors->has('idCliente') ? ' is-invalid' : ''), 'placeholder' => 'Selecciona un cliente']) }}
            {!! $errors->first('idCliente', '<div class="invalid-feedback">:message</div>') !!}
        </div>
    </div>
    <br>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Enviar</button>
    </div>
</div>
