<!doctype html>
<html lang = "es">
    <head>
        <meta charset="UTF-8">
        <!--<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">-->
        <title>Selección de Usuario</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="{{ asset("css/normalize.css") }}">
        <link rel="preload" href="{{ asset("css/style.css") }}" as="style">
        <link rel="stylesheet" href="{{ asset("css/style.css") }}">
    </head>
    <body>
        <div class="container">
            <div class="info-container">
                <h2 class="title">Iniciar Sesión</h2>
                <hr>
                @if(Session::has('success'))
                <div class="alert alert-success">{{Session::get('success')}}</div>
                @endif
                @if(Session::has('fail'))
                    <div class="alert alert-danger">{{Session::get('fail')}}</div>
                @endif
                <div class="btn-container">
                    <button class="btn-seleccion" type="submit" onclick="window.location.href='{{route('departamento.login')}}'">Jefe de departamento</button>
                </div>
                <div class="btn-container">
                    <button class="btn-seleccion" type="submit" onclick="window.location.href='{{route('alumno.login')}}'">Alumno</button>
                </div>
            </div>
            <div class="image-container">
            </div>
        </div>
    </body>
</html>
