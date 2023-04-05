@extends('layouts.coordinador')

@section('contenido')
        <div class="container-main">
            @if(Session::has('success'))
                <div class="alert alert-success">{{Session::get('success')}}</div>
            @endif
            @if(Session::has('fail'))
                <div class="alert alert-danger">{{Session::get('fail')}}</div>
            @endif
            @csrf
            <h4 class="name-coordinador">Bienvenido Coordinador {{$jefe->getNombre()}}</h4>
            <hr>
            <div class="row-main">

                @include('layouts.filtroCoordinador')

                <div class="subcontainer1">
                    <p>Nombre del alumno:</p>
                    <div class="contain-excel">
                        <img src="{{ URL::asset('assets/img/excel.svg')}}" style="margin-left:15px;width:30px;height:30px;">
                        <p class="text-pdf-excel">Descargar tabla en Excel</p>
                        <button type="button" class="btn-excel" onclick="window.location='{{route("departamento.excel",["tipo"=> "ACEPTADO","departamento" =>$departamento])}}'" >Descargar</Button>
                    </div>
                </div>
                <div class="subcontainer2">
                    <input type="text" class="form-control input-style" id="nombre_becario" aria-describedby="basic-addon3" onkeyup="getAlumnos()" placeholder="Ingrese nombre del alumno a buscar...">
                    <div class="contain-pdf">
                        <img src="{{ URL::asset('assets/img/pdf_icon.svg')}}" style="margin-left:15px;width:30px;height:30px;">
                        <p class="text-pdf-excel">Descargar tabla en PDF</p>
                        <button type="button" class="btn-pdf" onclick="window.location='{{route("departamento.pdf",["tipo"=> "ACEPTADO","departamento" =>$departamento])}}'" >Descargar</Button>
                    </div>
                </div>
            </div>
            <hr>
            <table class="table-info" id="TablaAlumnos">
                <thead class="table-th">
                    <th class="num-cuenta">Número de cuenta</th>
                    <th class="nombre-alumno">Nombre</th>
                    <th class="fecha-inicio">Fecha de inicio</th>
                    <th class="fecha-fin">Fecha de terminación</th>
                    <th class="carrera">Carrera</th>
                    @if ($departamento == 'DSA')
                        <th>Depto.</th>
                    @endif
                    <th class="acciones">Acciones</th>
                </thead>
                <tbody class="tbody-info">
                @foreach($alumnos as $data)
                    <tr>
                        <td class="data-num-cuenta">{{$data->numero_cuenta}}</td>
                        <td class="data-nombre">{{$data->nombres}}</td>
                        <td class="data-fecha-inicio">{{$data->fecha_inicio}}</td>
                        <td class="data-fecha-fin">{{$data->fecha_fin}}</td>
                        <td class="data-carrera">{{$data->clave_carrera}}</td>
                        @if($departamento == 'DSA')
                        <td>{{$data->abreviatura_departamento}}</td>
                        @endif
                        <td>
                            <div class="button-acciones">
                                <button type="button" class="btn-acc btn-sucess" onclick="window.location='{{route("departamento.alumno.finalizar",["num_cuenta" => $data->numero_cuenta])}}'">Finalizar</Button>
                                <button type="button" class="btn-acc btn-info" onclick="window.location='{{route("departamento.alumno.datos",["num_cuenta" => $data->numero_cuenta])}}'">Datos</Button>
                                <button type="button" class="btn-acc btn-danger" onclick="confirmacionBaja({{$data->numero_cuenta}})">Baja</button>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="space"></div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
        <script type="text/javascript" src="{{ URL::asset('assets/js/departamento.js')}}"></script>
@endsection
