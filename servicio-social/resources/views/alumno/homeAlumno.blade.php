@extends('layouts.alumno')

@section('title','Home')

@section('contenido')
<main class="main">
    @if(Session::has('success'))
        <div class="alert alert-success">{{Session::get('success')}}</div>
    @endif
    @if(Session::has('fail'))
        <div class="alert alert-danger">{{Session::get('fail')}}</div>
    @endif
    <div class="info_container">
        <div class="info_general">
            <div class="nombre_container">
                <p class="nombre">{{$data->nombres}}</p>
            </div>
            <div class="info_estado">
                <p>Estado </p>
                <div class="estado_container">
                    <i class="fa-solid fa-check"></i>
                    <h4>{{$data->estado}}</h4>
                </div>
            </div>
        </div>
        <hr class="info_hr">
        <div class="info_total">
            <div class="info_total__container info_fill">
                <label class="info_total__label" for="nombre">Nombre</label>
                <input class="info_total__input" type="text" value="{{$data->nombres}}" id="nombre" disabled>
            </div>
            <div class="info_total__container">
                <label class="info_total__label" for="numero_cuenta">Numero de cuenta</label>
                <input class="info_total__input" type="text" value="{{$data->numero_cuenta}}" id="numero_cuenta" disabled>
            </div>
            <div class="info_total__container">
                <label class="info_total__label" for="duracion_meses">Duracion en Meses</label>
                <input class="info_total__input" type="text" value="{{$data->duracion_servicio}}" id="duracion_meses" disabled>
            </div>
            <div class="info_total__container">
                <label class="info_total__label" for="fecha_inicio">Fecha Inicio</label>
                <input class="info_total__input" type="date" value="{{$data->fecha_inicio}}" id="fecha_inicio" disabled>
            </div>
            <div class="info_total__container">
                <label class="info_total__label" for="fecha_fin">Fecha Fin</label>
                <input class="info_total__input" type="date" value="{{$data->fecha_fin}}" id="fecha_fin" disabled>
            </div>
            <div class="info_total__container">
                <label class="info_total__label" for="clave_carrera">Clave Carrera</label>
                <input class="info_total__input" type="text" value="{{$data->clave_carrera}}" id="clave_carrera" disabled>
            </div>
            <div class="info_total__container">
                <label class="info_total__label" for="departamento">Departamento</label>
                <input class="info_total__input" type="text" value="{{$data->departamento}}" id="departamento" disabled>
            </div>
        </div>
    </div>
</main>
@endsection