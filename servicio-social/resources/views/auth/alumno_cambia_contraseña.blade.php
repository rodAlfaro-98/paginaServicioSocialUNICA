@extends('layouts.alumno')

@section('title','Cambio Contraseña')

@section('contenido')
<div class="container">
        <div class = "row justify-content-center">
            <div class = "col-md-6 col-md-offset-6" style="margin-top:20px;">
                @if(Session::has('fail'))
                    <div class="alert alert-danger">{{Session::get('fail')}}</div>
                @endif
                <div class="alert alert-info">La contraseña debe de ser de un mínimo de 12 caractéres.</div>
                <h2>Página de cambio de contraseña.<h2> 
                <br>
                <div class = "content">    
                <form action="{{route('alumno.cambio.contraseña.post')}}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="contraseña" style="font-size: 22px;">Favor de ingresar nueva contraseña</label>
                        <input type="password" class="form-control" placeholder="Contraseña actual" name="contraseña" value="">
                        <span class="text-danger" style="font-size: 17px;">@error('contraseña') {{$message}} @enderror</span>
                    </div>
                    <div class="form-group">
                        <label for="comfirma_contraseña" style="font-size: 22px;">Favor de comfirmar la contraseña</label>
                        <input type="password" class="form-control" placeholder="Contraseña actual" name="comfirma_contraseña" value="">
                        <span class="text-danger" style="font-size: 17px;">@error('comfirma_contraseña') {{$message}} @enderror</span>
                    </div>
                    <br>
                    <div class="form-group">
                        <button class="btn btn-primary register" type="submit">Enviar</button>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
@endsection