@extends('layouts.alumno')

@section('contenido')
    <div class="container">
        <div class = "row">
            <div class = "col-md-offset-4" style="margin-top:20px;">
                <h2>Bienvenido.<h2> 
                <hr>
                <h4>Datos del alumno</h4>
                <hr>
                <table class="table">
                    <thead>
                        <th>Número de cuenta</th>
                        <th>Nombre</th>
                        <th>Fecha de inicio</th>
                        <th>Fecha de terminación</th>
                        <th>Duración en meses</th>
                        <th>Clave Carrera</th>
                        <th>Departamento</th>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{$data->numero_cuenta}}</td>
                            <td>{{$data->nombres}}</td>
                            <td>{{$data->fecha_inicio}}</td>
                            <td>{{$data->fecha_fin}}</td>
                            <td>{{$data->duracion_servicio}}</td>
                            <td>{{$data->clave_carrera}}</td>
                            <td>{{$data->departamento}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection