@extends('layouts.alumno')

@section('title','Cambio Contraseña')

@section('contenido')
<div class="container" style="margin-top:20px;">
        <div class = "row justify-content-center">
            <div class = "col-md-6 col-md-offset-6" style="margin-top:20px;">
                @if(Session::has('fail'))
                    <div class="alert alert-danger">{{Session::get('fail')}}</div>
                @endif
                <h1>Página de cambio de contraseña.<h1> 
                <br>
                <div>
                    <form action="{{route('alumno.comfirma.contraseña')}}" method="post">
                        @csrf
                        <h3>Favor de confirmar sus datos antes de introducir una nueva contraseña</h3>
                        <div class="form-group">
                            <label for="password" style="font-size: 22px;">Contraseña</label>
                            <input type="password" class="form-control" placeholder="Contraseña actual" name="contraseña" value="">
                            <span class="text-danger">@error('contraseña') {{$message}} @enderror</span>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary register" type="submit">Confirmar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection