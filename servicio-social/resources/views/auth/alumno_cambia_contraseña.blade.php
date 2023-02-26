@extends('layouts.alumno')

@section('title','Cambio Contraseña')

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
        
        <form class="new_pass" action="{{route('alumno.cambio.contraseña.post')}}" method="post">
            @csrf
            <h3 class="new_pass__title">Cambiar Contraseña<h3> 
            <div class="new_pass__in">
                <label class="new_pass__in-label" for="contraseña">Nueva Contraseña *</label>
                <input class="new_pass__in-input" type="password" class="form-control" placeholder="" name="contraseña" value="">
                <span class="text-danger" style="font-size: 17px;">@error('contraseña') {{$message}} @enderror</span>
            </div>
            <div class="new_pass__in">
                <label class="new_pass__in-label" for="comfirma_contraseña">Confirma la contraseña *</label>
                <input class="new_pass__in-input" type="password" class="form-control" placeholder="" name="comfirma_contraseña" value="">
                <span class="text-danger" style="font-size: 17px;">@error('comfirma_contraseña') {{$message}} @enderror</span>
            </div>
            <br>
            <div class="new_pass__enviar">
                <button class="new_pass__enviar-btn" class="btn btn-primary register" type="submit">Enviar</button>
            </div>
        </form>
    </div>
</main>


@endsection