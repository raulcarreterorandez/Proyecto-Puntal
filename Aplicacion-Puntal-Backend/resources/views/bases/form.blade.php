<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group col-lg-7 col-md-10">
            {{ Form::label('Nº Plaza') }}
            {{ Form::select('idPlaza',$plazas, $bases->idPlaza, ['class' => 'form-control' . ($errors->has('idPlaza') ? ' is-invalid' : ''), 'placeholder' => 'Nº Plaza']) }}
            {!! $errors->first('idPlaza', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group col-lg-7 col-md-10">
            {{ Form::label('fechaEntrada') }}
            {{ Form::date('fechaEntrada', $bases->fechaEntrada, ['class' => 'form-control' . ($errors->has('fechaEntrada') ? ' is-invalid' : ''), 'placeholder' => 'Fechaentrada']) }}
            {!! $errors->first('fechaEntrada', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group col-lg-7 col-md-10">
            {{ Form::label('fechaSalida') }}
            {{ Form::date('fechaSalida', $bases->fechaSalida, ['class' => 'form-control' . ($errors->has('fechaSalida') ? ' is-invalid' : ''), 'placeholder' => 'Fechasalida']) }}
            {!! $errors->first('fechaSalida', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary m-2">Submit</button>
    </div>
</div>