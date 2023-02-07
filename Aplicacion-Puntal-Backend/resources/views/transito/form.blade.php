<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('idPlaza') }}
            {{ Form::select('idPlaza', $plazas, $transito->idPlaza, ['class' => 'form-control' . ($errors->has('idPlaza') ? ' is-invalid' : ''), 'placeholder' => 'Idplaza']) }}
            {!! $errors->first('idPlaza', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('fechaEntrada') }}
            {{ Form::date('fechaEntrada', $transito->fechaEntrada, ['class' => 'form-control' . ($errors->has('fechaEntrada') ? ' is-invalid' : ''), 'placeholder' => 'Fechaentrada']) }}
            {!! $errors->first('fechaEntrada', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('fechaSalida') }}
            {{ Form::date('fechaSalida', $transito->fechaSalida, ['class' => 'form-control' . ($errors->has('fechaSalida') ? ' is-invalid' : ''), 'placeholder' => 'Fechasalida']) }}
            {!! $errors->first('fechaSalida', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary m-2">Submit</button>
    </div>
</div>