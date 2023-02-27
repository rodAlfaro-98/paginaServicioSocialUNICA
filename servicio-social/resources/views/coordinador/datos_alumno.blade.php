@extends('layouts.coordinador')

@section('contenido')
    <!--
    <link rel="preload" href="{{URL::asset('css/normalize.css')}}" as="style">
    <link rel="stylesheet" href="{{URL::asset('css/normalize.css')}}">
    <link rel="preload" href="{{URL::asset('css/style.css')}}" as="style">
    <link rel="stylesheet" href="{{URL::asset('css/style.css')}}">
    <link rel="preload" href="{{URL::asset('css/alumno_register.css')}}" as="style">
    <link rel="stylesheet" href="{{URL::asset('css/alumno_register.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    -->
    <link rel="preload" href="{{URL::asset('css/main.css')}}" as="style">
    <link rel="stylesheet" href="{{URL::asset('css/main.css')}}">
    <link rel="preload" href="{{URL::asset('css/departamento.css')}}" as="style">
    <link rel="stylesheet" href="{{URL::asset('css/departamento.css')}}">
    <div class="container-datos-alumno">
        <h4 class="title-register">Datos de {{$alumno->nombres}} {{ $alumno->apellido_paterno }} {{ $alumno->apellido_materno }}</h4>
            <div class="barra"></div>
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
                <div class="datos-flex">
                    <div class="container-data">
                        <div class="first-row">
                            <label class="">Nombre: </label>
                        </div>
                        <div class="row-input">
                            <input class="input" type="name" name="nombres" value="{{$alumno->nombres}}" disabled>
                        </div>
                    </div>
                    
                    <div class="container-data">
                        <div class="row-size-text">
                            <label>Apellido Paterno: </label>
                        </div>
                        <div class="row-input">
                            <input class="input" type="name" name="nombres" value="{{$alumno->apellido_paterno}}" disabled>
                        </div>
                    </div>
                    
                    <div class="container-data">
                        <div class="row-size-text">
                            <label>Apellido Materno: </label>
                        </div>
                        <div class="row-input">
                            <input class="input" type="name" name="nombres" value="{{$alumno->apellido_materno}}" disabled>
                        </div>
                    </div>
                </div>

                <!-- DATOS -->

                <div class="datos-flex">
                    <div class="container-data">
                        <div class="row-size-text">
                            <label>CURP: </label>
                        </div>
                        <div class="row-input">
                            <input class="input" type="name" name="nombres" value="{{$alumno->curp}}" disabled>
                        </div>
                    </div>
                    <div class="container-data">
                        <div class="row-size-text" >
                            <label>Numero de cuenta: </label>
                        </div>
                        <div class="row-input">
                            <input class="input" type="name" name="nombres" value="{{$alumno->numero_cuenta}}" disabled>
                        </div>
                    </div>
                    <div class="container-data">
                        <div class="row-size-text">
                            <label>Fecha de Nacimiento: </label>
                        </div>
                        <div class="row-input">
                            <input class="input date-birthday" type="date" value="{{$alumno->fecha_nacimiento}}" disabled>
                        </div>
                    </div>
                </div>

                <div class="datos-flex">
                    <div class="container-data">
                        <div class="row-size-text">
                            <label>Género: </label>
                        </div>
                        <div class="row-input">
                            <input class="input" type="name" name="nombres" value="{{$alumno->genero}}" disabled>
                        </div>
                    </div>
                    <div class="container-data">
                        <div class="row-size-text">
                            <label>Correo: </label>
                        </div>
                        <div class="row-input">
                            <input class="input" type="email" name="nombres" value="{{$alumno->correo}}" disabled>
                        </div>
                    </div>
                <!-- DATOS DE CONTACTO -->
                    <div class="container-data">
                        <div class="row-size-text">
                            <label>Telefono de casa: </label>
                        </div>
                        <div class="row-input">
                            <input class="input" type="name" name="nombres" value="{{$alumno->telefono_casa}}" disabled>
                        </div>
                    </div>
                </div>

                <div class="datos-flex">
                    <div class="container-data">
                        <div class="row-size-text">
                            <label>Telefono celular: </label>
                        </div>
                        <div class="row-input">
                            <input class="input" type="name" name="nombres" value="{{$alumno->telefono_celular}}" disabled>
                        </div>
                    </div>
                    <!-- DATOS DE CARRERA -->    
                    <div class="container-data">
                        <div class="row-size-text">
                            <label>Créditos pagados: </label>
                        </div>
                        <div class="row-input">
                            <input class="input" type="name" name="nombres" value="{{$alumno->creditos_pagados}}" disabled>
                        </div>
                    </div>
                    <div class="container-data">
                        <div class="row-size-text">
                            <label>Porcentaje de Avance: </label>
                        </div>
                        <div class="row-input">
                            <input class="input" type="name" name="nombres" value="{{$alumno->avance_porcentaje}}" disabled>
                        </div>
                    </div>
                </div> 
                
                <div class="datos-flex">
                    <div class="container-data">
                        <div class="row-size-text">
                            <label>Promedio: </label>
                        </div>
                        <div class="row-input">
                            <input class="input" type="name" name="nombres" value="{{$alumno->promedio}}" disabled>
                        </div>
                    </div>
                    <div class="container-data">
                        <div class="row-size-text">
                            <label>Fecha de ingreso a la facultad: </label>
                        </div>
                        <div class="row-input">
                            <input class="input date-birthday" type="date" value="{{$alumno->fecha_ingreso_facultad}}" disabled>
                        </div>
                    </div>
                    <!-- DATOS SERVICIO SOCIAL -->
                    <div class="container-data">
                        <div class="row-size-text">
                            <label>Horas de entrada: </label>
                        </div>
                        <div class="row-input">
                            <input class="input" type="name" name="nombres" value="{{$alumno->hora_inicio}}" disabled>
                        </div>
                    </div>
                </div>

                <div class="datos-flex">
                    <div class="container-data">
                        <div class="row-size-text">
                            <label>Horas del servicio social <br>por semana: </label>
                        </div>
                        <div class="row-input">
                            <input class="input" type="name" name="nombres" value="{{$alumno->horas_semana}}" disabled>
                        </div>
                    </div>
                    <div class="container-data">
                        <div class="row-size-text">
                            <label><br>Carrera:</label>
                        </div>
                        <div class="row-input">
                            <input class="input" type="name" name="nombres" value="{{$carrera}}" disabled>
                        </div>
                    </div>
                    <div class="container-data">
                        <div class="row-size-text">
                            <label><br>Horas de salida: </label>
                        </div>
                        <div class="row-input">
                            <input class="input" type="name" name="nombres" value="{{$alumno->hora_fin}}" disabled>
                        </div>
                    </div>
                </div>

                <div class="datos-flex">
                    <div class="container-data">
                        <div class="row-size-text">
                            <label>Duración en meses del <br> servicio social: </label>
                        </div>
                        <div class="row-input">
                            <input class="input" type="name" name="nombres" value="{{$alumno->duracion_servicio}}" disabled>
                        </div>
                    </div>
                    <div class="container-data">
                        <div class="row-size-text">
                            <label>Fecha de inicio <br> del servicio social: </label>
                        </div>
                        <div class="row-input">
                            <input class="input date-birthday" type="date" value="{{$alumno->fecha_inicio}}" disabled>
                        </div>
                    </div>
                    <div class="container-data procedencia">
                        <div class="row-size-text">
                            <label><br>Procedencia: </label>
                        </div>
                        <div class="radio-button-container">
                            <div class="">
                                @if($alumno->interno)
                                    <input type="radio" id="procedencia_interno" name="interno" value="interno" checked = "checked" disabled>
                                @else
                                    <input type="radio" id="procedencia_interno" name="interno" value="interno" disabled>
                                @endif
                                <label for="interno">Interno</label>
                            </div>

                            <div class="">
                                @if(!$alumno->interno)
                                    <input type="radio" id="procedencia_interno" name="interno" value="externo" checked = "checked" disabled>
                                @else
                                    <input type="radio" id="procedencia_interno" name="interno" value="externo" disabled>
                                @endif
                                <label for="interno">Externo</label>
                            </div>
                        </div>  
                    </div>
                </div>
            </form>
            <div class="datos-flex">
                <div class="container-data">
                    <div class="row-size-text row-dpto">
                        <label>Departamento: </label>
                    </div>
                    <div class="row-input">
                        <input class="input last-input" type="name" name="nombres" value="{{$departamento}}" disabled>
                    </div>
                </div>
                <div class="container-data">
                    <br><br>
                    <div class="return">
                        <a href="{{route('departamento.home')}}"><button class="btn-acc btn-danger">Regresar</button></a>
                    </div>
                </div>
            </div>
    </div>
    <div class="space"></div>

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