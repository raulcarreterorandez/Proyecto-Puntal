<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('disponible') }}
            {{ Form::text('disponible', $plaza->disponible, ['class' => 'form-control' . ($errors->has('disponible') ? ' is-invalid' : ''), 'placeholder' => 'Disponible']) }}
            {!! $errors->first('disponible', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <input type="hidden" name="visto" value="0"></input>
<!--         <div class="form-group">
            {{ Form::label('visto') }}
            {{ Form::text('visto', $plaza->visto, ['class' => 'form-control' . ($errors->has('visto') ? ' is-invalid' : ''), 'placeholder' => 'Visto']) }}
            {!! $errors->first('visto', '<div class="invalid-feedback">:message</div>') !!}
        </div> -->
        <div class="form-group">
            {{ Form::label('puertoOrigen') }}
            {{ Form::text('puertoOrigen', $plaza->puertoOrigen, ['class' => 'form-control' . ($errors->has('puertoOrigen') ? ' is-invalid' : ''), 'placeholder' => 'Puertoorigen']) }}
            {!! $errors->first('puertoOrigen', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('puertoDestino') }}
            {{ Form::text('puertoDestino', $plaza->puertoDestino, ['class' => 'form-control' . ($errors->has('puertoDestino') ? ' is-invalid' : ''), 'placeholder' => 'Puertodestino']) }}
            {!! $errors->first('puertoDestino', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('anyo') }}
            {{ Form::text('anyo', $plaza->anyo, ['class' => 'form-control' . ($errors->has('anyo') ? ' is-invalid' : ''), 'placeholder' => 'anyo']) }}
            {!! $errors->first('anyo', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Nº Muelle') }}
            {{ Form::select('idMuelle',$muelles, $plaza->idMuelle, ['class' => 'form-control' . ($errors->has('idMuelle') ? ' is-invalid' : ''), 'placeholder' => 'Idmuelle']) }}
            {!! $errors->first('idMuelle', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary m-2">Submit</button>
    </div>
</div>