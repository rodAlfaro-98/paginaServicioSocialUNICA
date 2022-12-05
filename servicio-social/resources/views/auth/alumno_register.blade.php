<!doctype html>
<html lang = "es">
    <head>
        <meta charset = "UTF-8">
        <!-- CSS only -->
        <style>
            .especificacion{
                display: none;
            }
            .especificacion_externo{
                display: none;
            }
            .especificacion_interno{
                display: none;
            }
        </style>
        <link rel="preload" href="css/normalize.css" as="style">
        <link rel="stylesheet" href="css/normalize.css">
        <link rel="preload" href="css/style.css" as="style">
        <link rel="stylesheet" href="css/style.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
        <title>Registro Alumno</title>
    </head>
    <body>
        <div class="container">
            <div class = "row justify-content-center">
                <div class = "col-md-6 col-md-offset-6" style="margin-top:20px;">
                    <h4>Registro Alumno</h4>
                    <hr>
                    <form action="{{route('alumno.register.usuario')}}" method="post">
                        @if(Session::has('success'))
                        <div class="alert alert-success">{{Session::get('success')}}</div>
                        @endif
                        @if(Session::has('fail'))
                        <div class="alert alert-danger">{{Session::get('fail')}}</div>
                        @endif
                        @csrf
                        <div class="form-group">
                            <label for="numero_cuenta">Numero de cuenta</label>
                            <input type="text" class="form-control input" placeholder="#########" name="numero_cuenta" value="{{old('numero_cuenta')}}">
                            <span class="text-danger">@error('numero_cuenta') {{$message}} @enderror</span>
                        </div>
                        <div class="form-group">
                            <label for="correo">Correo</label>
                            <input type="email" class="form-control" placeholder="ejemplo_correo@prueba.com" name="correo" value="{{old('correo')}}">
                            <span class="text-danger">@error('correo') {{$message}} @enderror</span>
                        </div>
                        <div class="form-group">
                            <label for="nombres">Nombre(s)</label>
                            <input type="text" class="form-control" placeholder="Juan Alejandro" name="nombres" value="{{old('nombres')}}">
                            <span class="text-danger">@error('nombres') {{$message}} @enderror</span>
                        </div>
                        <div class="form-group">
                            <label for="apellido_paterno">Apellido Paterno</label>
                            <input type="text" class="form-control" placeholder="López" name="apellido_paterno" value="{{old('apellido_paterno')}}">
                            <span class="text-danger">@error('apellido_paterno') {{$message}} @enderror</span>
                        </div>
                        <div class="form-group">
                            <label for="apellido_materno">Apellido Materno</label>
                            <input type="text" class="form-control" placeholder="López" name="apellido_materno" value="{{old('apellido_materno')}}">
                            <span class="text-danger">@error('apellido_materno') {{$message}} @enderror</span>
                        </div>
                        <div class="form-group">
                            <label for="fecha_nacimiento">Fecha de nacimiento</label>
                            <input type="date" class="form-control" name="fecha_nacimiento" value="{{old('fecha_nacimiento')}}">
                            <span class="text-danger">@error('fecha_nacimiento') {{$message}} @enderror</span>
                        </div>
                        <div class="form-group">
                            <label for="curp">Curp</label>
                            <input type="text" class="form-control" placeholder="NNNNAAMMDDGCCLLL00" name="curp" value="{{old('curp')}}">
                            <span class="text-danger">@error('curp') {{$message}} @enderror</span>
                        </div>
                        <div class="form-group">
                            <label>Género</label><br>
                            <div style="margin-left: 30px;">
                                <input type="radio" id="genero_hombre" onclick="vistaEspecificacion()" name="genero" value="Hombre">
                                <label for="genero">Hombre</label><br>
                                <input type="radio" id="genero_mujer" onclick="vistaEspecificacion()" name="genero" value="Mujer">
                                <label for="genero">Mujer</label><br>
                                <input type="radio" id="genero_otro" onclick="vistaEspecificacion()" name="genero" value="Otro">
                                <label for="genero">Otro</label><br>
                                <div class="especificacion" id="especificacion" style="display: hidden;">
                                    <label for="genero">Especifique: </label>
                                    <input type="text" id="especificacion_genero" name="genero_especifico" value="{{old('genero')}}">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="telefono_casa">Telefono de casa</label>
                            <input type="text" class="form-control" placeholder="55380615" name="telefono_casa" value="{{old('telefono_casa')}}">
                            <span class="text-danger">@error('telefono_casa') {{$message}} @enderror</span>
                        </div>
                        <div class="form-group">
                            <label for="telefono_celular">Telefono celular</label>
                            <input type="text" class="form-control" placeholder="5521552155" name="telefono_celular" value="{{old('telefono_celular')}}">
                            <span class="text-danger">@error('telefono_celular') {{$message}} @enderror</span>
                        </div>
                        <div class="form-group">
                            <label for="creditos_pagados">Creditos pagados</label>
                            <input type="number" class="form-control" placeholder="358" name="creditos_pagados" value="{{old('creditos_pagados')}}">
                            <span class="text-danger">@error('creditos_pagados') {{$message}} @enderror</span>
                        </div>
                        <div class="form-group">
                            <label for="avance_porcentaje">Creditos pagados</label>
                            <input type="number" step = "0.01" min = "30.00" max = "100.00" class="form-control" placeholder="81.73" name="avance_porcentaje" value="{{old('avance_porcentaje')}}">
                            <span class="text-danger">@error('creditos_pagados') {{$message}} @enderror</span>
                        </div>
                        <div class="form-group">
                            <label for="promedio">promedio</label>
                            <input type="number" step="0.01" max="10.00" class="form-control" placeholder="9.21" name="promedio" value="{{old('promedio')}}">
                            <span class="text-danger">@error('promedio') {{$message}} @enderror</span>
                        </div>
                        <div class="form-group">
                            <label for="fecha_ingreso_fac">Fecha aproximada de ingreso a la facultad</label>
                            <input type="date" class="form-control" placeholder="9.21" name="fecha_ingreso_fac" value="{{old('fecha_ingreso_fac')}}">
                            <span class="text-danger">@error('fecha_ingreso_fac') {{$message}} @enderror</span>
                        </div>
                        <div class="form-group">
                            <label for="duracion_servicio">Duración en meses de servicio social</label>
                            <input type="number" min="6" max="12" class="form-control" placeholder="6" name="duracion_servicio" value="{{old('duracion_servicio')}}">
                            <span class="text-danger">@error('duracion_servicio') {{$message}} @enderror</span>
                        </div>
                        <div class="form-group">
                            <label for="horas_semana">Horas por semana</label>
                            <input type="number" min="10" max="20" class="form-control" placeholder="20" name="horas_semana" value="{{old('horas_semana')}}">
                            <span class="text-danger">@error('horas_semana') {{$message}} @enderror</span>
                        </div>
                        <div class="form-group">
                            <label for="hora_inicio">Horas de inicio</label>
                            <input type="time" class="form-control" name="hora_inicio" value="{{old('hora_inicio')}}">
                            <span class="text-danger">@error('hora_inicio') {{$message}} @enderror</span>
                        </div>
                        <div class="form-group">
                            <label for="hora_fin">Horas de salida</label>
                            <input type="time" class="form-control" name="hora_fin" value="{{old('hora_fin')}}">
                            <span class="text-danger">@error('hora_fin') {{$message}} @enderror</span>
                        </div>
                        <div class="form-group">
                            <label for="fecha_inicio">Fecha inicio</label>
                            <input type="date" class="form-control" name="fecha_inicio" value="{{old('fecha_inicio')}}">
                            <span class="text-danger">@error('fecha_ingreso_fac') {{$message}} @enderror</span>
                        </div>
                        <div class="form-group">
                            <label>Procedencia</label><br>
                            <div style="margin-left: 30px;">
                                <input type="radio" id="procedencia_interno" onclick="internoEspecificacion()" name="interno" value="interno">
                                <label for="interno">Interno</label><br>
                                <input type="radio" id="procedencia_externo" onclick="internoEspecificacion()" name="interno" value="externo">
                                <label for="interno">Externo</label><br>
                                <div class="especificacion_externo" id="especificacion_externo" style="margin-left: 20px;">
                                    <label for="carrera">Especifique: </label>
                                    <input type="text" id="especificacion_externo" name="carrera_externo" value="{{old('genero')}}">
                                </div>
                                <div class="especificacion_interno" id="especificacion_interno" style="margin-left: 20px;">
                                    <label for="carrera">Seleccione su carrera: </label>
                                    <select name="carrera_interno" id="especificacion_interno">
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
                        </div>
                        <br>
                        <div class="form-group">
                            <label>Departamento</label>
                            <select name="departamento_id" id="eleccion_departamento">
                                <option value="1">Departamento de Servicios Académicos</option>
                                <option value="2">Departamento de Investigación y Desarrollo</option>
                                <option value="3">Departamento de Seguridad en Cómputo</option>
                                <option value="4">Departamento de Redes y Operación de Servidores</option>
                                <option value="5">Salas</option>
                            </select>
                        </div>
                        <br>
                        <div class="form-group">
                            <button class="btn btn-secondary register" type="submit">Registrar</button>
                        </div>
                        <br>
                    </form>
                </div>
            </div>
        </div>
        <!-- JavaScript Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
        <script>
            function vistaEspecificacion(){
                if(document.getElementById('genero_otro').checked) {
                    document.getElementById('especificacion').style.display = "block";
                }else{
                    document.getElementById('especificacion').style.display = "none";
                    document.getElementById('especificacion_genero').value = null;
                }
            }
            function internoEspecificacion(){
                if(document.getElementById('procedencia_externo').checked){
                    document.getElementById('especificacion_externo').style.display = "block";
                }else{
                    document.getElementById('especificacion_externo').style.display = "none";
                }
                if(document.getElementById('procedencia_interno').checked){
                    document.getElementById('especificacion_interno').style.display = "block";
                }else{
                    document.getElementById('especificacion_interno').style.display = "none";
                }
            }
        </script>
    </body>
</html>