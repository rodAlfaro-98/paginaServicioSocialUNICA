@extends('layouts.alumno')

@section('title','Cambio Contraseña')

@push('styles')
    <link href="{{ asset('css/alumno.css') }}" rel="stylesheet">
@endpush

@section('contenido')
<main class="main">
    <div class="cambio_contrasena__container">

        <h2>UNICA</h2>

        <!--
        <div class="alert alert-info">La contraseña debe de ser de un mínimo de 12 caractéres.</div>
        -->

        @if(Session::has('fail'))
            <div class="alert_password">{{Session::get('fail')}}</div>
        @endif
        
        <form class="new_pass" action="{{route('alumno.comfirma.contraseña')}}" method="post">
            @csrf
            <h3 class="new_pass__title">Confirma tu contraseña antes de cambiarla<h3> 


            <div class="new_pass__in">
                <label class="new_pass__in-label" for="contraseña">Contraseña *</label>
                <input class="new_pass__in-input" type="password" class="form-control" placeholder="" name="contraseña" value="">
                <span class="text-danger">@error('contraseña') {{$message}} @enderror</span>
            </div>
            <br>
            <div class="new_pass__enviar">
                <button class="new_pass__enviar-btn" class="btn btn-primary register" type="submit">Confirmar</button>
            </div>
        </form>
    </div>
</main>

@endsection
