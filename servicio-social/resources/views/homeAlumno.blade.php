@extends('layouts.alumno')

@section('title','Home')

@section('contenido')
    <link href="{{ asset('css/alumno_layout.css') }}" rel="stylesheet">
    <div class="container">
        <div class = "row">
            <div class = "col-md-offset-4" style="margin-top:20px;">
                @if(Session::has('success'))
                    <div class="alert alert-success">{{Session::get('success')}}</div>
                @endif
                @if(Session::has('fail'))
                    <div class="alert alert-danger">{{Session::get('fail')}}</div>
                @endif
                <h2>Bienvenido.<h2> 
                <div class="hr1"></div>
                <h4>Datos del alumno</h4>
                <div class="hr1"></div>
                <table class="table">
                    <thead>
                        <th>Número de cuenta</th>
                        <th>Nombre</th>
                        <th>Fecha de inicio</th>
                        <th>Fecha de terminación</th>
                        <th>Duración en meses</th>
                        <th>Clave Carrera</th>
                        <th>Departamento</th>
                        <th>Estado</th>
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
                            <td>{{$data->estado}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection