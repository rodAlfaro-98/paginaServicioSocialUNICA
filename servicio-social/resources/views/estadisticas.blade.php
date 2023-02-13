@extends('layouts.coordinador')

@section('contenido')
        <div style="margin-top: 100px;">
            <h4>Estadísticas de los alumnos del {{$departamento}}</h4>
            <hr>
            <form action="{{route('departamento.descarga.estadistica')}}" method="post">
                @csrf
                <h5>Seleccione el tipo de dato</h5>
                <select class="input input-select" onchange="filtroTipoDato()" name="tipo_dato_selector" id="tipo_dato_selector" style="width: 100%">
                    <option value="" disabled selected>Tipo de dato</option>
                    <option id="tipo_semestre" name="tipo_dato" value="Semestre">Semestre de servicio</option>
                    <option id="tipo_genero" name="tipo_dato" value="Genero">Género del alumno</option>
                    <option id="tipo_interno" name="tipo_dato" value="Interno">Procedencia del alumno</option>
                    <option id="tipo_carrera" name="tipo_dato" value="Carrera">Carrera del alumno</option>
                </select>
                <div id="titulo2" style="display: none">
                    <br>
                    <br>
                    <hr>
                    <h5>Seleccione el dato</h5>
                </div>
                <select class="input input-select" name="genero" id="genero_selector" style="width: 100%; display: none">
                    <option value="" disabled selected>Genero</option>
                    @foreach($generos as $genero)
                        <option id="genero_{{$genero->genero}}" name="genero" value="{{$genero->genero}}">{{$genero->genero}}</option>
                    @endforeach
                </select>
                <select class="input input-select" name="carrera" id="carrera_selector" style="width: 100%; display: none">
                    <option value="" disabled selected>Carrera</option>
                    @foreach($carreras as $carrera)
                        <option id="carrera_{{$carrera->carrera}}" name="genero" value="{{$carrera->carrera}}">{{$carrera->carrera}}</option>
                    @endforeach
                </select>
                <select class="input input-select" name="interno" id="procedencia_selector" style="width: 100%; display: none">
                    <option value="" disabled selected>Procedencia</option>
                    <option id="prodencia_interno" name="procedencia" value="Interno">Interno</option>
                    <option id="prodencia_externo" name="procedencia" value="Externo">Externo</option>
                </select>
                <select class="input input-select" name="fecha" id="fecha_selector" style="width: 100%; display: none">
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
                <br>
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
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
        <script type="text/javascript" src="{{ URL::asset('assets/js/departamento.js')}}"></script>
@endsection