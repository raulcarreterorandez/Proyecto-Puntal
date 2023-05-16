{{-- esto muestra todos los errores seguidos --}}
{{-- @if ($errors->any())
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
<br/>
@endif --}}

<div class="box box-info padding-1">
    <div class="box-body">

        <div class="form-group col-lg-7 col-md-10">
            {{ Form::label('Nombre Usuario') }}
            {{ Form::text('nombreUsuario', $usuario->nombreUsuario, ['class' => 'form-control' . ($errors->has('nombreUsuario') ? ' is-invalid' : ''), 'placeholder' => 'Nombre Usuario']) }}
            {!! $errors->first('nombreUsuario', '<div class="invalid-feedback">:message</div>') !!}
        </div>

        @if ($editar == true)
            <div class="form-group col-lg-7 col-md-10">
                <label class="form-label" for="validationCustom03">Password</label>
                <input type="password" class='form-control{{($errors->has('password') ? ' is-invalid' : '')}}' name="password" value="{{$usuario->password}}" id="validationCustom03">
                {!! $errors->first('password', '<div class="invalid-feedback">:message</div>') !!}
                <small style="color: grey">Min:6 caracteres</small>
            </div>
        @endif
        <div class="form-group col-lg-7 col-md-10">
            {{ Form::label('Nombre Completo') }}
            {{ Form::text('nombreCompleto', $usuario->nombreCompleto, ['class' => 'form-control' . ($errors->has('nombreCompleto') ? ' is-invalid' : ''), 'placeholder' => 'Nombre Completo']) }}
            {!! $errors->first('nombreCompleto', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group col-lg-7 col-md-10">
            {{ Form::label('Email') }}
            @if (auth()->user()->email == $usuario->email)
                {{ Form::text('email', $usuario->email, ['class' => 'form-control' . ($errors->has('email') ? ' is-invalid' : ''), 'placeholder' => 'Email', 'disabled']) }}
                <input type="hidden" name="email" value="{{$usuario->email}}">
            @else
                {{ Form::text('email', $usuario->email, ['class' => 'form-control' . ($errors->has('email') ? ' is-invalid' : ''), 'placeholder' => 'Email']) }}
                {!! $errors->first('email', '<div class="invalid-feedback">:message</div>') !!}
            @endif

        </div>

        <div class="row">
            <div class="col-md-5">
                <div class="form-group">
                    <label class="form-label">Perfil de Usuario</label>
                    <select name="perfil" class="form-select" style="width: 300px">
                        @if ($usuario->perfil == "GUARDA-MUELLES" OR $usuario->perfil == 0)
                            <option selected>GUARDA-MUELLES</option>
                        @else
                            <option>GUARDA-MUELLES</option>
                        @endif

                        @if ($usuario->perfil == "GERENCIA-PUERTO")
                            <option selected>GERENCIA-PUERTO</option>
                        @else
                            <option>GERENCIA-PUERTO</option>
                        @endif

                        @if ($usuario->perfil == "XUNTA-GALICIA")
                            <option selected>XUNTA-GALICIA</option>
                        @else
                            <option>XUNTA-GALICIA</option>
                        @endif

                        @if ($usuario->perfil == "CUERPO-SEGURIDAD")
                            <option selected>CUERPO-SEGURIDAD</option>
                        @else
                            <option>CUERPO-SEGURIDAD</option>
                        @endif
                    </select>
                </div>
            </div>
            <div class="col-md-5">
                <div class="form-group">
                    <label class="form-label">Instalaciones</label>
                    <div class="multiselect ">
                        <div class="selectBox" onclick="showCheckboxes()">
                          <select class="form-select">
                            <option>Opciones</option>
                          </select>
                          <div class="overSelect"></div>
                        </div>
                        <div id="checkboxes">
                            @php
                                $salir = false;
                                $limite = count($instalacionesChecked); // Cantidad de puertos que tenemos seleccionados
                                $i = 0; // Contador de comprobaciones por puerto

                                // Todos los puertos que tenemos disponibles
                                foreach ($instalaciones as $instalacion) {

                                    //Mientras $salir sea FALSE y $i sea menos que el limite
                                    while(!$salir && $i<$limite){
                                        $instalacionCheck = $instalacionesChecked[$i]; //id del puerto que tenemos seleccionado

                                        if ($instalacion->id == $instalacionCheck) {
                                            echo" <label><input checked type='checkbox' name='instalaciones[]' value='$instalacion->id' class='form-check-input'/> $instalacion->nombrePuerto</label>";
                                            $salir = true;
                                        }
                                        else{
                                            $i++;
                                        }
                                    }

                                    if ($i == $limite ) {
                                        echo "<label><input type='checkbox' name='instalaciones[]' value='$instalacion->id' class='form-check-input'/> $instalacion->nombrePuerto</label>";
                                    }

                                    $i=0;
                                    $salir=false;
                                }
                            @endphp
                        </div>
                        <small style="color: grey">**Todos** por defecto</small>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label class="form-label">Idioma</label>
            <div class="row justify-content-start">
                <div class="col-lg-1 col-sm-2" >
                    <div class="form-check">
                        @if ($usuario->idioma == "Español" OR $usuario->idioma == 0)
                            <input class="form-check-input" type="radio" name="idioma" value="Español" checked>
                            <label class="form-check-label">Español</label>
                        @else
                            <input class="form-check-input" type="radio" name="idioma" value="Español">
                            <label class="form-check-label">Español</label>
                        @endif
                    </div>
                </div>
                <div class="col-lg-1 col-sm-2">
                    <div class="form-check">
                        @if ($usuario->idioma == "Ingles")
                            <input class="form-check-input" type="radio" name="idioma" value="Ingles" checked>
                            <label class="form-check-label">Ingles</label>
                        @else
                            <input class="form-check-input" type="radio" name="idioma" value="Ingles">
                            <label class="form-check-label">Ingles</label>
                        @endif
                    </div>
                </div>
                <div class="col-lg-1 col-sm-2">
                    <div class="form-check">
                        @if ($usuario->idioma == "Aleman")
                            <input class="form-check-input" type="radio" name="idioma" value="Aleman" checked>
                            <label class="form-check-label">Aleman</label>
                        @else
                            <input class="form-check-input" type="radio" name="idioma" value="Aleman">
                            <label class="form-check-label">Aleman</label>
                        @endif
                    </div>
                </div>
                <div class="col-lg-1 col-sm-2">
                    <div class="form-check">
                        @if ($usuario->idioma == "Frances")
                            <input class="form-check-input" type="radio" name="idioma" value="Frances" checked>
                            <label class="form-check-label">Frances</label>
                        @else
                            <input class="form-check-input" type="radio" name="idioma" value="Frances">
                            <label class="form-check-label">Frances</label>
                        @endif
                    </div>
                </div>
            </div>
        </div>

{{-- INPUTS QUE NO MOSTRAMOS EN EL FORMULARIO --}}
        <input type="hidden" name="visto" value=0>
    </div><br>

    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Submit</button>
        <a class="btn btn-primary btn-danger" href="{{ route('usuarios.index') }}"> Cancel</a>
    </div>
</div>

<script>
    var expanded = false;

    function showCheckboxes() {
        var checkboxes = document.getElementById("checkboxes");
        if (!expanded) {
            checkboxes.style.display = "block";
            expanded = true;
        } else {
            checkboxes.style.display = "none";
            expanded = false;
        }
    }
</script>
<style>
    .multiselect {
    width: 300px;
    }

    .selectBox {
    position: relative;
    }

    .selectBox select {
    width: 100%;
    font-weight: bold;
    }

    .overSelect {
    position: absolute;
    left: 0;
    right: 0;
    top: 0;
    bottom: 0;
    }

    #checkboxes {
    display: none;
    border: 1px #dadada solid;
    }

    #checkboxes label {
    display: block;
    }

    #checkboxes label:hover {
    background-color: #1e90ff;
    }
</style>
