<div class="box box-info padding-1">
    <div class="box-body">
        <div class="form-group">
            {{ Form::label('Matrícula Embarcación') }}
            {{ Form::select('matriculaEmbarcacion', $embarcaciones, $servicio->matriculaEmbarcacion, ['class' => 'form-control' . ($errors->has('matriculaEmbarcacion') ? ' is-invalid' : ''), 'placeholder' => 'Selecciona una matricula']) }}
            {!! $errors->first('matricula', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <br>
        <div class="form-group">
            {{ Form::label('Tipo Servicio') }}
            {{ Form::select('tipoServicio', [
                    'Almacenamiento en seco' => 'Almacenamiento en seco',
                    'Amarre-Desamarre' => 'Amarre-Desamarre',
                    'Lavandería' => 'Lavandería',
                    'Limpieza casco' => 'Limpieza casco',
                    'Limpieza embarcación' => 'Limpieza embarcación',
                    'Mantenimiento preventivo' => 'Mantenimiento preventivo',
                    'Pintura' => 'Pintura',
                    'Practicaje' => 'Practicaje',
                    'Reparaciones eléctricas' => 'Reparaciones eléctricas',
                    'Reparaciones mecánicas' => 'Reparaciones mecánicas',
                    'Servicio vaciado aguas grises' => 'Servicio vaciado aguas grises',
                    'Suministro de agua' => 'Suministro de agua',
                    'Suministro combustible' => 'Suministro combustible',
                    'Suministro electricidad' => 'Suministro electricidad',
                    'Suministro gas' => 'Suministro gas',
                    'Suministro de provisiones' => 'Suministro de provisiones',
                    'Otros' => 'Otros'
                ], $servicio->tipoServicio, ['class' => 'form-control' . ($errors->has('tipoServicio') ? ' is-invalid' : '')]) }}
            {!! $errors->first('tipoServicio', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <br>
        <div class="form-group">
            {{ Form::label('Precio Hora') }}
            {{ Form::text('precioHora', $servicio->precioHora, ['class' => 'form-control' . ($errors->has('precioHora') ? ' is-invalid' : ''), 'placeholder' => 'Precio Hora']) }}
            {!! $errors->first('nombre', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <br>
        <div class="form-group">
            {{ Form::label('Abonado') }}
            {{ Form::select('abonado', [ '0' => 'No', '1' => 'Sí'], $servicio->abonado, ['class' => 'form-control']) }}
            {!! $errors->first('abonado', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <br>
        <div class="form-group">
            {{ Form::label('Finalizado') }}
            {{ Form::select('finalizado', ['0' => 'No', '1' => 'Sí'], $servicio->finalizado, ['class' => 'form-control']) }}
            {!! $errors->first('finalizado', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <br>
        <div class="form-group">
            {{ Form::label('Num. Horas') }}
            {{ Form::text('numHoras', $servicio->numHoras, ['class' => 'form-control' . ($errors->has('numHoras') ? ' is-invalid' : ''), 'placeholder' => 'Num. Horas', 'min' => '1']) }}
            {!! $errors->first('numHoras', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <br>
        <div class="form-group">
            {{ Form::label('Fecha solicitud') }}
            {{ Form::text('fechaSolicitud', $servicio->fechaSolicitud, ['class' => 'form-control' . ($errors->has('fechaSolicitud') ? ' is-invalid' : ''), 'placeholder' => 'Fecha solicitud', 'readonly' => 'readonly']) }}
            {!! $errors->first('fechaSolicitud', '<div class="invalid-feedback">:message</div>') !!}
        </div>
    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary m-2">Actualizar Cambios</button>
        @if ($servicio->finalizado == 1)
        <button type="submit" name="action" value="generaPdf" class="btn btn-primary m-2">Generar PDF</button>
        @endif
    </div>
    <!-- <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary m-2">Submit</button>
    </div> -->
</div>

<!-- <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary m-2">Submit</button>
        @if ($servicio->finalizado == 1)
        <form action="{{ route('servicios.update', $servicio->id) }}" method="POST" style="display: inline-block;">
            @csrf
            @method('PUT')
            <input type="hidden" name="action" value="generaPdf">
            <button type="submit" class="btn btn-primary m-2">Generar PDF</button>
        </form>
        @endif

        <button type="submit" class="btn btn-primary m-2">Submit</button>
        <form action="{{ route('servicios.update', $servicio->id) }}" method="POST" style="display: inline-block;">
            @csrf
            @method('PUT')
            <input type="hidden" name="action" value="generaPdf">
            <button type="submit" class="btn btn-primary m-2">Generar PDF</button>
        </form>

        <form action="{{ route('servicios.update', $servicio->id) }}" method="POST" style="display: inline-block;">
            @csrf
            @method('PUT')
            <input type="hidden" name="action" value="enviaEmail">
            <button type="submit" class="btn btn-primary m-2">Enviar por correo</button>
        </form>
    </div> -->