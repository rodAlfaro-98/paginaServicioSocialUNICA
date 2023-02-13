<!doctype html>
<html lang = "es">
    <head>
        <meta charset = "UTF-8">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
        <title>Registro Alumno</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="preload" href="{{URL::asset('css/normalize.css')}}" as="style">
        <link rel="stylesheet" href="{{URL::asset('css/normalize.css')}}">
        <link rel="preload" href="{{URL::asset('css/style.css')}}" as="style">
        <link rel="stylesheet" href="{{URL::asset('css/style.css')}}">
        <link rel="preload" href="{{URL::asset('css/alumno_register.css')}}" as="style">
        <link rel="stylesheet" href="{{URL::asset('css/alumno_register.css')}}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    </head>
    <body>
    <div class="container">
        <div class="info-container-register">
            <h4 class="title-register">Registro</h4>
            <hr>
            <form class="inputs-container-register" action="{{route('alumno.register.usuario')}}" method="post">
                <!-- Sesion -->
                @if(Session::has('success'))
                <div class="alert alert-success">{{Session::get('success')}}</div>
                @endif
                @if(Session::has('fail'))
                <div class="alert alert-danger">{{Session::get('fail')}}</div>
                @endif
                @csrf


                <!-- NOMBRES -->
                <input class="input" type="name" placeholder="Nombre(s) " name="nombres" value="{{old('nombres')}}">
                <span class="text-danger">@error('nombres') {{$message}} @enderror</span>

                <input class="input" type="text" placeholder="Apellido Paterno" name="apellido_paterno" value="{{old('apellido_paterno')}}">
                <span class="text-danger">@error('apellido_paterno') {{$message}} @enderror</span>

                <input class="input" type="text" placeholder="Apellido Materno" name="apellido_materno" value="{{old('apellido_materno')}}">
                <span class="text-danger">@error('apellido_materno') {{$message}} @enderror</span>


                <!-- DATOS -->
                <input class="input" type="text" placeholder="Curp" name="curp" value="{{old('curp')}}">
                <span class="text-danger">@error('curp') {{$message}} @enderror</span>

                <input class="input" type="number" placeholder="Número de cuenta" name="numero_cuenta" value="{{old('numero_cuenta')}}">
                <span class="text-danger">@error('numero_cuenta') {{$message}} @enderror</span>

                <div class="register-fac input-selec">
                    <h5 class="register-date-fac">Fecha de Nacimiento:</h5>
                    <input class="input date-birthday" type="date" value="fecha_nacimiento" name="fecha_nacimiento" value="{{old('fecha_nacimiento')}}">
                    <span class="text-danger">@error('fecha_nacimiento') {{$message}} @enderror</span>
                </div>


                <div class="register-fac">
                    <h6 class="register-date-fac">Género:</h6>
                    <select class="input input-select" onchange="vistaEspecificacion()" name="genero" id="genero_selector" required>
                        <option value="" disabled selected>Género</option>
                        <option id="genero_mujer" name="genero" value="Hombre">Femenino</option>
                        <option id="genero_hombre" name="genero" value="Mujer">Masculino</option>
                        <option id="genero_otro" name="genero" value="Otro">Otro</option>
                    </select>
                    <div id="especificacion" style="display: none;">
                        <input type="text" class="input" id="especificacion_genero" name="genero_especifico" placeholder="Especifique" value="{{old('genero')}}">
                    </div>
                </div>

                
                

                <!-- DATOS DE CONTACTO -->

                <input class="input" type="email" placeholder="Correo" name="correo" value="{{old('correo')}}">
                <span class="text-danger">@error('correo') {{$message}} @enderror</span>

                <input class="input" type="number" placeholder="Teléfono de casa" name="telefono_casa" value="{{old('telefono_casa')}}">
                <span class="text-danger">@error('telefono_casa') {{$message}} @enderror</span>

                <input class="input" type="number" placeholder="Teléfono celular" name="telefono_celular" value="{{old('telefono_celular')}}">
                <span class="text-danger">@error('telefono_celular') {{$message}} @enderror</span>

                


                <!-- DATOS DE CARRERA -->               

                <input class="input" type="number" placeholder="Créditos de pagados" name="creditos_pagados" value="{{old('creditos_pagados')}}">
                <span class="text-danger">@error('creditos_pagados') {{$message}} @enderror</span>

                <input class="input" type="number" placeholder="Avance Porcentaje" step = "0.01" min = "30.00" max = "100.00" name="avance_porcentaje" value="{{old('avance_porcentaje')}}">
                <span class="text-danger">@error('avance_porcentaje') {{$message}} @enderror</span>

                <input class="input" type="number" placeholder="Promedio" step="0.01" max="10.00" name="promedio" value="{{old('promedio')}}">
                <span class="text-danger">@error('promedio') {{$message}} @enderror</span>


                <div class="register-fac">
                    <h6 class="register-date-fac">Fecha de ingreso a Facultad:</h6>
                    <input class="input date-birthday2" type="date" name="fecha_ingreso_fac" value="{{old('fecha_ingreso_fac')}}">
                    <span class="text-danger">@error('fecha_ingreso_fac') {{$message}} @enderror</span>
                </div>

                
                <!-- DATOS SERVICIO SOCIAL -->

                <input class="input" type="number" min="6" max="12" class="form-control" placeholder="Duración en meses de servicio social" name="duracion_servicio" value="{{old('duracion_servicio')}}">
                <span class="text-danger">@error('duracion_servicio') {{$message}} @enderror</span>

                <input type="number" min="10" max="20" class="input" placeholder="Horas por semana" name="horas_semana" value="{{old('horas_semana')}}">
                <span class="text-danger">@error('horas_semana') {{$message}} @enderror</span>
                
                <div class="register-fac">
                    <h6 class="register-date-fac">Horas de inicio: </h6>
                    <input type="time" class="input" name="hora_inicio" value="{{old('hora_inicio')}}">
                    <span class="text-danger">@error('hora_inicio') {{$message}} @enderror</span>
                </div>

                <div class="register-fac">
                    <h6 class="register-date-fac">Horas de salida: </h6>
                    <input type="time" class="input" name="hora_fin" value="{{old('hora_fin')}}">
                    <span class="text-danger">@error('hora_fin') {{$message}} @enderror</span>
                </div>

                
                <div class="register-fac">
                    <h6 class="register-date-fac">Fecha inicio: </h6>
                    <input type="date" class="input" placeholder="Fecha Inicio" name="fecha_inicio" value="{{old('fecha_inicio')}}">
                    <span class="text-danger">@error('fecha_inicio') {{$message}} @enderror</span>
                </div>

                <div class="register-fac">

                    <label class="register-date-fac">Procedencia: </label>

                        <div class="radio-button-container">
                            <input type="radio" id="procedencia_interno" onclick="internoEspecificacion()" name="interno" value="interno">
                            <label for="interno">Interno</label>

                        </div>
                        <div class="radio-button-container">
                            <input type="radio" id="procedencia_externo" onclick="internoEspecificacion()" name="interno" value="externo">
                            <label for="interno">Externo</label>
                        </div>

                    <div class="especificacion_externo" id="especificacion_externo" style="margin-left: 20px;">
                        <input class="input" type="text" id="especificacion_externo" placeholder="Especifique" name="carrera_externo" value="{{old('especificacion_externo')}}">
                    </div>

                    <div class="especificacion_interno" id="especificacion_interno" style="margin-left: 20px;">
                        <select class="input input-radio" name="carrera_interno" id="especificacion_interno">
                            <option value="Ingeniería Ambiental">Ingeniería Ambiental</option>
                            <option value="Ingeniería Civil">Ingeniería Civil</option>
                            <option value="Ingeniería de Minas y Metalurgia">Ingeniería de Minas y Metalurgia</option>
                            <option value="Ingeniería Eléctrica Electrónica">Ingeniería Eléctrica Electrónica</option>
                            <option value="Ingeniería en Computación">Ingeniería en Computación</option>
                            <option value="Ingeniería en Sistemas Biomédicos">Ingeniería en Sistemas Biomédicos</option>
                            <option value="Ingeniería en Telecomunicaciones">Ingeniería en Telecomunicaciones</option>
                            <option value="Ingeniería Geofísica">Ingeniería Geofísica</option>
                            <option value="Ingeniería Geológica">Ingeniería Geológica</option>
                            <option value="Ingeniería Geomática">Ingeniería Geomática</option>
                            <option value="Ingeniería Industrial">Ingeniería Industrial</option>
                            <option value="Ingeniería Mecánica">Ingeniería Mecánica</option>
                            <option value="Ingeniería Mecatrónica">Ingeniería Mecatrónica</option>
                            <option value="Ingeniería Petrolera">Ingeniería Petrolera</option>
                        </select>
                    </div>
                </div>


                <div class="register-fac input-select ">
                    <label class="register-date-fac">Departamento:</label>
                    <select class="input" name="departamento_id" id="eleccion_departamento"  required>
                        <option value="" disabled selected>Departamento</option>
                        <option value="1">Departamento de Servicios Académicos</option>
                        <option value="2">Departamento de Investigación y Desarrollo</option>
                        <option value="3">Departamento de Seguridad en Cómputo</option>
                        <option value="4">Departamento de Redes y Operación de Servidores</option>
                        <option value="5">Salas</option>
                    </select>
                </div>
                
                <button type="submit" class="btn register">Registrarse</button>
                <div class="hr1"></div>

            </form>
            

            <div class="return1 return">
                <i class="fa fa-arrow-circle-left" aria-hidden="true"></i><button class="return1 btn_border_opacity pointer_button" type="submit" onclick="location.href='/'">Volver al inicio</button>
            </div>

        </div>
    </div>


    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <script type="text/javascript" src="{{ URL::asset('assets/js/alumno_register.js')}}"></script>
    </body>
</html>