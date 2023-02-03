<!doctype html>
<html lang = "es">
    <head>
        <meta charset = "UTF-8">
        <!-- CSS only -->
        <!-- Boostrap necesario para alertas -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
        <title>Alumno</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="preload" href="{{URL::asset('css/normalize.css')}}" as="style">
        <link rel="stylesheet" href="{{URL::asset('css/normalize.css')}}">
        <link rel="preload" href="{{URL::asset('css/style.css')}}" as="style">
        <link rel="stylesheet" href="{{URL::asset('css/style.css')}}">
    </head>
    <body>
        <div class="container">
            <div class="info-container">
                <h2 class="title">Iniciar Sesión</h2>
                <form action="{{route('alumno.login.usuario')}}" method="post" class="inputs-container">
                    @if(Session::has('success'))
                        <div class="alert alert-success">{{Session::get('success')}}</div>
                    @endif
                    @if(Session::has('fail'))
                        <div class="alert alert-danger">{{Session::get('fail')}}</div>
                    @endif
                    @csrf
                    <input class="input" type="text" placeholder="Número de cuenta" name="num_cuenta" value="{{old('num_cuenta')}}">
                    <span class="text-danger">@error('num_cuenta') {{$message}} @enderror</span><!-- Parte de boostrap -->
                    <input class="input" type="password" placeholder="Contraseña" name="contraseña" value="">
                    <span class="text-danger">@error('contraseña') {{$message}} @enderror</span><!-- Parte de boostrap -->
                    <button class="btn" type="submit">Ingresar</button>
                    <div class="hr1"></div>
                </form>
                <button class="span btn_border_opacity" type="submit" onclick="location.href='/alumno/registro'">Registrarse</button>
                <button class="span btn_border_opacity">Olvide mi contraseña</button>

                <div class="return1 return">
                    <i class="fa fa-arrow-circle-left" aria-hidden="true"></i><button class="return1 btn_border_opacity pointer_button" type="submit" onclick="location.href='/'">Volver al inicio</button>
                </div>
            </div>
            <div class="image-container"></div>
        </div>
        <!-- JavaScript Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    </body>
</html>