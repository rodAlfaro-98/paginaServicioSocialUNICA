@extends('layouts.coordinador')

@section('contenido')
        <div style="margin-top: 100px;">
            @if(Session::has('fail'))
                <div class="alert alert-danger">{{Session::get('fail')}}</div>
            @endif
            <h4>Estadísticas de los alumnos del {{$departamento}}</h4>
            <hr>
            <form action="{{route('departamento.descarga.estadistica')}}" onsubmit="return filtroDato();" method="post">
                @csrf
                <h5>Seleccione el tipo de dato</h5>
                <div class="col">
                    <div class="container">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="Semestre" name="Semestre" value="Semestre" onclick="filtroTipoDato()">
                            <label class="form-check-label" for="Semestre">Semestre de servicio</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="Genero" name="Genero" value="Genero" onclick="filtroTipoDato()">
                            <label class="form-check-label" for="Genero">Género del alumno</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="Interno" name="Interno" value="Interno" onclick="filtroTipoDato()">
                            <label class="form-check-label" for="Interno">Procedencia del alumno</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="Carrera" name="Carrera" value="Carrera" onclick="filtroTipoDato()">
                            <label class="form-check-label" for="Carrera">Carrera del alumno</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="Estado" name="Estado" value="Estado" onclick="filtroTipoDato()">
                            <label class="form-check-label" for="Estado">Estado del alumno</label>
                        </div>
                    </div>
                </div>
                <div id="titulo2" style="display: none">
                    <br>
                    <br>
                    <hr>
                    <h5>Seleccione el dato</h5>
                </div>
                <div class="row">
                    <div class="col" id="fecha_selector" style="display: none">
                    <select class="input input-select" name="fecha"  onchange="filtroDato()" style="width: 100%;">
                        <option value="" disabled selected>Fecha</option>
                        @foreach($años as $año)
                            @if($año == $min_año)
                                @if($semestre_min == 2)
                                    <option id="fecha_{{$año}}-2" name="fecha" value="{{$año}}-2">{{$año}}-2</option>
                                @else
                                    <option id="fecha_{{$año}}-1" name="fecha" value="{{$año}}-1">{{$año}}-1</option>
                                    <option id="fecha_{{$año}}-2" name="fecha" value="{{$año}}-2">{{$año}}-2</option>
                                @endif
                            @elseif($año == $max_año)
                                @if($semestre_max == 2)
                                    <option id="fecha_{{$año}}-2" name="fecha" value="{{$año}}-2">{{$año}}-2</option>
                                @else
                                    <option id="fecha_{{$año}}-1" name="fecha" value="{{$año}}-1">{{$año}}-1</option>
                                    <option id="fecha_{{$año}}-2" name="fecha" value="{{$año}}-2">{{$año}}-2</option>
                                @endif
                            @else   
                                <option id="fecha_{{$año}}-1" name="fecha" value="{{$año}}-1">{{$año}}-1</option>
                                <option id="fecha_{{$año}}-2" name="fecha" value="{{$año}}-2">{{$año}}-2</option>
                            @endif
                        @endforeach
                    </select>
                    </div>
                    <div class="col"  id="genero_selector" style="display: none" >
                        <select class="input input-select" name="genero" onchange="filtroDato()" style="width: 100%;">
                            <option value="" disabled selected>Genero</option>
                            @foreach($generos as $genero)
                                <option id="genero_{{$genero->genero}}" name="genero" value="{{$genero->genero}}">{{$genero->genero}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col" id="procedencia_selector"  style="display: none">
                        <select class="input input-select" name="interno" id="procedencia_selector"  onchange="filtroDato()" style="width: 100%;">
                            <option value="" disabled selected>Procedencia</option>
                            <option id="prodencia_interno" name="procedencia" value="Interno">Interno</option>
                            <option id="prodencia_externo" name="procedencia" value="Externo">Externo</option>
                        </select>
                    </div>
                    <div class="col" id="carrera_selector" style="display: none">
                        <select class="input input-select" name="carrera" id="carrera_selector"  onchange="filtroDato()" style="width: 100%;">
                            <option value="" disabled selected>Carrera</option>
                            @foreach($carreras as $carrera)
                                <option id="carrera_{{$carrera->carrera}}" name="genero" value="{{$carrera->carrera}}">{{$carrera->carrera}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col" id="estado_selector" style="display: none">
                        <select class="input input-select" name="estado" id="estado_selector"  onchange="filtroDato()" style="width: 100%;">
                            <option value="" disabled selected>Estado</option>
                            <option id="PENDIENTE" name="estado" value="PENDIENTE">PENDIENTE</option>
                            <option id="ACEPTADO" name="estado" value="ACEPTADO">ACEPTADO</option>
                            <option id="RECHAZADO" name="estado" value="RECHAZADO">RECHAZADO</option>
                            <option id="BAJA" name="estado" value="BAJA">BAJA</option>
                        </select>
                    </div>
                    <br>
                </div>
                <br>
                <hr>
                <div class = "row">
                    <div class="col">
                        <button type="submit" name="boton_descarga" class="btn" style="color:white; background-color: #1D6F42" value="Excel"><img src="{{ URL::asset('assets/img/excel_icon.svg')}}" style="width:30px;height:30px;">Exportar Excel</Button>
                    </div>
                    <div class="col">
                        <button type="submit" name="boton_descarga" class="btn" style="color:white; background-color: #F40F02" value="PDF"><img src="{{ URL::asset('assets/img/pdf_icon.svg')}}" style="width:30px;height:30px;">Exportar PDF</Button>
                    </div>
                    </div>
                </div>
            </form>
            <br>
            <hr>
            <br>
            <h5>Generación del documento de prestación del Servicio Social por departamento</h5>
            <br>
            <form action="{{route('departamento.documento_division.estadistica')}}" method="post">
                @csrf
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <div class="container">
                                <div class="row">
                                    <div class="col">
                                        <label>Seleccione departamento:</label>
                                    </div>
                                    <div class="col">
                                        <select class="input input-select" name="departamento" style="width: 100%;">
                                            <option value="" disabled selected>Departamento</option>
                                            <option id="departamento_DSA" name="departamento" value="DSA">Departamento de Servicios Académicos</option>
                                            <option id="departamento_DID" name="departamento" value="DID">Departamento de Investigación y Desarrollo</option>
                                            <option id="departamento_DSC" name="departamento" value="DSC">Departamento de Seguridad Computacional</option>
                                            <option id="departamento_DROS" name="departamento" value="DROS">Departamento de Redes y Operación de Servidores</option>
                                            <option id="departamento_SALAS" name="departamento" value="SALAS">Salas</option>
                                        </select>
                                    </div>
                                </div>
                                <span class="text-danger">@error('departamento') {{$message}} @enderror</span>
                            </div>
                        </div>
                        <div class="col">
                            <div class="container">
                                <div class="row">
                                    <div class="col">
                                        <label>Seleccione periodo:</label>
                                    </div>
                                    <div class="col">
                                        <select class="input input-select" name="periodo" style="width: 100%;">
                                            <option value="" disabled selected>Periodo</option>
                                            @foreach($años as $año)
                                                @if($año == $min_año)
                                                    @if($semestre_min == 2)
                                                        <option id="periodo_{{$año}}-2" name="periodo" value="{{$año}}-2">{{$año}}-2</option>
                                                    @else
                                                        <option id="periodo_{{$año}}-1" name="periodo" value="{{$año}}-1">{{$año}}-1</option>
                                                        <option id="periodo_{{$año}}-2" name="periodo" value="{{$año}}-2">{{$año}}-2</option>
                                                    @endif
                                                @elseif($año == $max_año)
                                                    @if($semestre_max == 2)
                                                        <option id="periodo_{{$año}}-2" name="periodo" value="{{$año}}-2">{{$año}}-2</option>
                                                    @else
                                                        <option id="periodo_{{$año}}-1" name="periodo" value="{{$año}}-1">{{$año}}-1</option>
                                                        <option id="periodo_{{$año}}-2" name="periodo" value="{{$año}}-2">{{$año}}-2</option>
                                                    @endif
                                                @else   
                                                    <option id="periodo_{{$año}}-1" name="periodo" value="{{$año}}-1">{{$año}}-1</option>
                                                    <option id="periodo_{{$año}}-2" name="periodo" value="{{$año}}-2">{{$año}}-2</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <span class="text-danger">@error('periodo') {{$message}} @enderror</span>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <button type="submit" name="boton_departamento_descarga" class="btn btn-primary" style="color:white" value="PDF">Generar Documento</button>
            </form>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
        <script type="text/javascript" src="{{ URL::asset('assets/js/departamento.js')}}"></script>
@endsection