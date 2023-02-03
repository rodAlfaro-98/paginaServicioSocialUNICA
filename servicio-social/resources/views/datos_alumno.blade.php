@extends('layouts.coordinador')

@section('contenido')
    <link rel="preload" href="{{URL::asset('css/normalize.css')}}" as="style">
    <link rel="stylesheet" href="{{URL::asset('css/normalize.css')}}">
    <link rel="preload" href="{{URL::asset('css/style.css')}}" as="style">
    <link rel="stylesheet" href="{{URL::asset('css/style.css')}}">
    <link rel="preload" href="{{URL::asset('css/alumno_register.css')}}" as="style">
    <link rel="stylesheet" href="{{URL::asset('css/alumno_register.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <div class="container">
        <div class="info-container-register" style="margin-top: 5%">
            <h4 class="title-register">Datos de {{$alumno->nombres}} {{ $alumno->apellido_paterno }} {{ $alumno->apellido_materno }}</h4>
            <hr>
            <form id="muestraDatos" class="inputs-container-register">
                <!-- Sesion -->
                @if(Session::has('success'))
                <div class="alert alert-success">{{Session::get('success')}}</div>
                @endif
                @if(Session::has('fail'))
                <div class="alert alert-danger">{{Session::get('fail')}}</div>
                @endif
                @csrf


                <!-- NOMBRES -->
                <div class="row" style="width: 100%">
                    <div class="col-sm-3" style="text-align: left">
                        <br>
                        <label>Nombre: </label>
                    </div>
                    <div class="col-9">
                        <input class="input" type="name" name="nombres" value="{{$alumno->nombres}}" disabled>
                    </div>
                </div>


                <div class="row" style="width: 100%">
                    <div class="col-sm-3" style="text-align: left">
                        <br>
                        <label>Apellido Paterno: </label>
                    </div>
                    <div class="col-9">
                        <input class="input" type="name" name="nombres" value="{{$alumno->apellido_paterno}}" disabled>
                    </div>
                </div>

                <div class="row" style="width: 100%">
                    <div class="col-sm-3" style="text-align: left">
                        <br>
                        <label>Apellido Materno: </label>
                    </div>
                    <div class="col-9">
                        <input class="input" type="name" name="nombres" value="{{$alumno->apellido_materno}}" disabled>
                    </div>
                </div>


                <!-- DATOS -->
                <div class="row" style="width: 100%">
                    <div class="col-sm-3" style="text-align: left">
                        <br>
                        <label>CURP: </label>
                    </div>
                    <div class="col-9">
                        <input class="input" type="name" name="nombres" value="{{$alumno->curp}}" disabled>
                    </div>
                </div>

                <div class="row" style="width: 100%">
                    <div class="col-sm-3" style="text-align: left">
                        <br>
                        <label>Numero de cuenta: </label>
                    </div>
                    <div class="col-9">
                        <input class="input" type="name" name="nombres" value="{{$alumno->numero_cuenta}}" disabled>
                    </div>
                </div>

                <div class="row" style="width: 100%">
                    <div class="col-sm-3" style="text-align: left">
                        <br>
                        <label>Fecha de Nacimiento: </label>
                    </div>
                    <div class="col-8" style="margin-left: 30px;">
                        <input class="input date-birthday" type="date" value="{{$alumno->fecha_nacimiento}}" disabled>
                    </div>
                </div>

                <div class="row" style="width: 100%">
                    <div class="col-sm-3" style="text-align: left">
                        <br>
                        <label>Género: </label>
                    </div>
                    <div class="col-9">
                        <input class="input" type="name" name="nombres" value="{{$alumno->genero}}" disabled>
                    </div>
                </div>

                <!-- DATOS DE CONTACTO -->

                <div class="row" style="width: 100%">
                    <div class="col-sm-3" style="text-align: left">
                        <br>
                        <label>Numero de cuenta: </label>
                    </div>
                    <div class="col-9">
                        <input class="input" type="email" name="nombres" value="{{$alumno->correo}}" disabled>
                    </div>
                </div>

                <div class="row" style="width: 100%">
                    <div class="col-sm-3" style="text-align: left">
                        <br>
                        <label>Telefono de casa: </label>
                    </div>
                    <div class="col-9">
                        <input class="input" type="name" name="nombres" value="{{$alumno->telefono_casa}}" disabled>
                    </div>
                </div>

                <div class="row" style="width: 100%">
                    <div class="col-sm-3" style="text-align: left">
                        <br>
                        <label>Telefono celular: </label>
                    </div>
                    <div class="col-9">
                        <input class="input" type="name" name="nombres" value="{{$alumno->telefono_celular}}" disabled>
                    </div>
                </div>

                


                <!-- DATOS DE CARRERA -->               

                <div class="row" style="width: 100%">
                    <div class="col-sm-3" style="text-align: left">
                        <br>
                        <label>Créditos pagados: </label>
                    </div>
                    <div class="col-9">
                        <input class="input" type="name" name="nombres" value="{{$alumno->creditos_pagados}}" disabled>
                    </div>
                </div>

                <div class="row" style="width: 100%">
                    <div class="col-sm-3" style="text-align: left">
                        <br>
                        <label>Porcentaje de Avance: </label>
                    </div>
                    <div class="col-9">
                        <input class="input" type="name" name="nombres" value="{{$alumno->avance_porcentaje}}" disabled>
                    </div>
                </div>

                <div class="row" style="width: 100%">
                    <div class="col-sm-3" style="text-align: left">
                        <br>
                        <label>Promedio: </label>
                    </div>
                    <div class="col-9">
                        <input class="input" type="name" name="nombres" value="{{$alumno->promedio}}" disabled>
                    </div>
                </div>


                <div class="row" style="width: 100%">
                    <div class="col-sm-3" style="text-align: left">
                        <label>Fecha de ingreso a la facultad: </label>
                    </div>
                    <div class="col-8" style="margin-left: 30px;">
                        <input class="input date-birthday" type="date" value="{{$alumno->fecha_ingreso_facultad}}" disabled>
                    </div>
                </div>

                
                <!-- DATOS SERVICIO SOCIAL -->

                <div class="row" style="width: 100%">
                    <div class="col-sm-3" style="text-align: left">
                        <label>Duración en meses del servicio social: </label>
                    </div>
                    <div class="col-9">
                    <input class="input" type="name" name="nombres" value="{{$alumno->duracion_servicio}}" disabled>
                    </div>
                </div>

                <div class="row" style="width: 100%">
                    <div class="col-sm-3" style="text-align: left">
                        <label>Horas del servicio social por semana: </label>
                    </div>
                    <div class="col-9">
                    <input class="input" type="name" name="nombres" value="{{$alumno->horas_semana}}" disabled>
                    </div>
                </div>
                
                <div class="row" style="width: 100%">
                    <div class="col-sm-3" style="text-align: left">
                        <br>
                        <label>Horas de entrada: </label>
                    </div>
                    <div class="col-9">
                    <input class="input" type="name" name="nombres" value="{{$alumno->hora_inicio}}" disabled>
                    </div>
                </div>

                <div class="row" style="width: 100%">
                    <div class="col-sm-3" style="text-align: left">
                        <br>
                        <label>Horas de salida: </label>
                    </div>
                    <div class="col-9">
                    <input class="input" type="name" name="nombres" value="{{$alumno->hora_fin}}" disabled>
                    </div>
                </div>

                
                <div class="row" style="width: 100%">
                    <div class="col-sm-3" style="text-align: left">
                        <label>Fecha de inicio del servicio social: </label>
                    </div>
                    <div class="col-8" style="margin-left: 30px;">
                        <input class="input date-birthday" type="date" value="{{$alumno->fecha_inicio}}" disabled>
                    </div>
                </div>

                <br>
                <div class="row" style="width: 100%">
                    <div class="col-sm-3" style="text-align: left">
                        <br>
                        <label>Procedencia: </label>
                    </div>
                    <div class="col-9" style="padding-left: 10%">
                        <div class="radio-button-container">
                            @if($alumno->interno)
                                <input type="radio" id="procedencia_interno" name="interno" value="interno" checked = "checked" disabled>
                            @else
                                <input type="radio" id="procedencia_interno" name="interno" value="interno" disabled>
                            @endif
                            <label for="interno">Interno</label>
                        </div>

                        <div class="radio-button-container">
                            @if(!$alumno->interno)
                                <input type="radio" id="procedencia_interno" name="interno" value="externo" checked = "checked" disabled>
                            @else
                                <input type="radio" id="procedencia_interno" name="interno" value="externo" disabled>
                            @endif
                            <label for="interno">Externo</label>
                        </div>
                    </div>
                </div>
                <br>

                <div class="row" style="width: 100%">
                    <div class="col-sm-3" style="text-align: left">
                        <br>
                        <label>Carrera: </label>
                    </div>
                    <div class="col-9">
                        <input class="input" type="name" name="nombres" value="{{$carrera}}" disabled>
                    </div>
                </div>

                <div class="row" style="width: 100%">
                    <div class="col-sm-3" style="text-align: left">
                        <br>
                        <label>Departamento: </label>
                    </div>
                    <div class="col-9">
                        <input class="input" type="name" name="nombres" value="{{$departamento}}" disabled>
                    </div>
                </div>
                

            </form>

        </div>
    </div>


    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <script>
        document.getElementById("muestraDatos").addEventListener('load',readOnlyForm)
        function readOnlyForm(){
            var form = document.getElementById("muestraDatos");
            alert('En función')
            var elements = form.elements;
            for (var i = 0, len = elements.length; i < len; ++i) {
                elements[i].disable = true;
            }
        }
    </script>
@endsection