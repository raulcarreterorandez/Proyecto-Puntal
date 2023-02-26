<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('Nombre Instalacion') }}
            {{ Form::select('idInstalacion',$instalaciones, $muelle->idInstalacion, ['class' => 'form-control' . ($errors->has('idInstalacion') ? ' is-invalid' : ''), 'placeholder' => 'Idinstalacion']) }}
            {!! $errors->first('idInstalacion', '<div class="invalid-feedback">:message</div>') !!}
        </div>
 <!--        <div class="form-group">
            {{ Form::label('visto') }}
            {{ Form::text('visto', $muelle->visto, ['class' => 'form-control' . ($errors->has('visto') ? ' is-invalid' : ''), 'placeholder' => 'Visto']) }}
            {!! $errors->first('visto', '<div class="invalid-feedback">:message</div>') !!}
        </div> -->
        <input type="hidden" name="visto" value="0"></input>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary m-2">Submit</button>
    </div>
</div>