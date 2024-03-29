@extends('layouts.coordinador')

@section('contenido')
        <div class="container-estadisticas">
            @if(Session::has('fail'))
                <div class="alert alert-danger">{{Session::get('fail')}}</div>
            @endif
            <h4 class="title-estadisticas">Estadísticas de los alumnos del {{$departamento}}</h4>
            <hr>
            <form action="{{route('departamento.descarga.estadistica')}}" onsubmit="return filtroDato();" method="post">
                @csrf
                <h5 class="tipo-dato">Seleccione el tipo de dato</h5>
                <div class="container-checkbox">
                    <div class="form-check-box">
                        <div class="checkbox-wrapper-13">
                            <input class="form-check-input" type="checkbox" id="Semestre" name="Semestre" value="Semestre" onclick="filtroTipoDato()">
                        </div>
                        <label class="option-select" for="Semestre">Semestre de servicio</label>
                    </div>
                    <div class="form-check-box">
                        <div class="checkbox-wrapper-13">
                            <input class="form-check-input" type="checkbox" id="Genero" name="Genero" value="Genero" onclick="filtroTipoDato()">
                        </div>
                        <label class="option-select" for="Genero">Género del alumno</label>
                    </div>
                    <div class="form-check-box">
                        <div class="checkbox-wrapper-13">
                        <input class="form-check-input" type="checkbox" id="Interno" name="Interno" value="Interno" onclick="filtroTipoDato()">
                        </div>
                        <label class="option-select" for="Interno">Procedencia del alumno</label>
                    </div>
                    <div class="form-check-box">
                        <div class="checkbox-wrapper-13">
                        <input class="form-check-input" type="checkbox" id="Carrera" name="Carrera" value="Carrera" onclick="filtroTipoDato()">
                        </div>
                        <label class="form-check-label" for="Carrera">Carrera del alumno</label>
                    </div>
                    <div class="form-check-box">
                        <div class="checkbox-wrapper-13">
                            <input class="form-check-input" type="checkbox" id="Estado" name="Estado" value="Estado" onclick="filtroTipoDato()">
                        </div>
                        <label class="form-check-label" for="Estado">Estado del alumno</label>
                    </div>
                    <div class="form-check-box">
                        <div class="checkbox-wrapper-13">
                            <input class="form-check-input" type="checkbox" id="becario_unica" name="becario_unica" value="becario_unica" onclick="filtroTipoDato()">
                        </div>
                        <label class="form-check-label" for="becario_unica">Becario de UNICA</label>
                    </div>
                </div>
                <div id="titulo2" style="display: none">
                    <hr>
                    <h5 class="tipo-dato">Seleccione el dato</h5>
                </div>
                <div class="row">
                <div class="col" id="fecha_selector" style="display: none">
                    <select class="input-select input-select-estadisticas" name="fecha"  onchange="filtroDato()">
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
                    <select class="input-select input-select-estadisticas" name="genero" onchange="filtroDato()" style="width: 100%;">
                        <option value="" disabled selected>Genero</option>
                        @foreach($generos as $genero)
                            <option id="genero_{{$genero->genero}}" name="genero" value="{{$genero->genero}}">{{$genero->genero}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col" id="procedencia_selector"  style="display: none">
                    <select class="input-select input-select-estadisticas" name="interno" id="procedencia_selector"  onchange="filtroDato()" style="width: 100%;">
                        <option value="" disabled selected>Procedencia</option>
                        <option id="prodencia_interno" name="procedencia" value="Interno">Interno</option>
                        <option id="prodencia_externo" name="procedencia" value="Externo">Externo</option>
                    </select>
                </div>
                <div class="col" id="carrera_selector" style="display: none">
                    <select class="input-select input-select-estadisticas" name="carrera" id="carrera_selector"  onchange="filtroDato()" style="width: 100%;">
                        <option value="" disabled selected>Carrera</option>
                        @foreach($carreras as $carrera)
                            <option id="carrera_{{$carrera->carrera}}" name="genero" value="{{$carrera->carrera}}">{{$carrera->carrera}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col" id="estado_selector" style="display: none">
                    <select class="input-select input-select-estadisticas" name="estado" id="estado_selector"  onchange="filtroDato()" style="width: 100%;">
                        <option value="" disabled selected>Estado</option>
                        <option id="PENDIENTE" name="estado" value="PENDIENTE">Pendiente</option>
                        <option id="ACEPTADO" name="estado" value="ACEPTADO">Aceptado</option>
                        <option id="RECHAZADO" name="estado" value="RECHAZADO">Rechazado</option>
                        <option id="BAJA" name="estado" value="BAJA">Baja</option>
                    </select>
                </div>
                <div class="col" id="becario_selector"  style="display: none">
                    <select class="input-select input-select-estadisticas" name="becario" id="becario_selector"  onchange="filtroDato()" style="width: 100%;">
                        <option value="" disabled selected>Becario UNICA</option>
                        <option id="becario_interno" name="becario" value="Interno">Interno</option>
                        <option id="becario_externo" name="becario" value="Externo">Externo</option>
                    </select>
                </div>
                </div>
                <div class="barra2"></div>
                <div class = "exportar-pdf-excel estadisticas-exportar-pdf-excel">
                    <div class="button-pdf-estadisticas">
                        <button type="submit" name="boton_descarga" class="btn-excel" value="Excel"><img src="{{ URL::asset('assets/img/excel.svg')}}">Exportar Excel</Button>
                    </div>
                    <div class="button-pdf-estadisticas">
                        <button type="submit" name="boton_descarga" class="btn-pdf" value="PDF"><img src="{{ URL::asset('assets/img/pdf_icon.svg')}}">Exportar PDF</Button>
                    </div>
                </div>
            </form>
            <hr>
            <h5 class="tipo-dato">Generación del documento de prestación del Servicio Social por departamento</h5>
            <br>
            <form action="{{route('departamento.documento_division.estadistica')}}" method="post">
                @csrf
                <div class="generar-documento">
                    <div class="select-dpto-flex">
                        <div class="item-dpto">
                            <label>Seleccione departamento:</label>
                        </div>
                        <select class="input-select-dpto-periodo input-select-dpto" name="departamento">
                            <option value="" disabled selected>Departamento</option>
                            <option id="departamento_DSA" name="departamento" value="DSA">Departamento de Servicios Académicos</option>
                            <option id="departamento_DID" name="departamento" value="DID">Departamento de Investigación y Desarrollo</option>
                            <option id="departamento_DSC" name="departamento" value="DSC">Departamento de Seguridad Computacional</option>
                            <option id="departamento_DROS" name="departamento" value="DROS">Departamento de Redes y Operación de Servidores</option>
                            <option id="departamento_SALAS" name="departamento" value="SALAS">Salas</option>
                        </select>
                        <span class="span-danger">@error('departamento') {{$message}} @enderror</span>
                    </div>
                    <div class="select-periodo-flex">
                        <div class="row-seleccione-periodo">
                            <label>Seleccione periodo:</label>
                        </div>
                        <select class="input-select-dpto-periodo input-select-periodo" name="periodo">
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
                        <span class="span-danger">@error('periodo') {{$message}} @enderror</span>
                    </div>
                    <div class="">
                        <button type="submit" name="boton_departamento_descarga" class="select-download-document btn-documento"value="PDF">Generar Documento</button>
                    </div>
                </div>
            </form>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
        <script type="text/javascript" src="{{ URL::asset('assets/js/departamento.js')}}"></script>
@endsection
