<!doctype html>
<html lang = "es">
    <head>
        <meta charset = "UTF-8">
        <!-- CSS only -->
        <title>Alumno</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

        @vite('resources/css/inicio.css')

    </head>
    <body>
        <div class="container">
            <div class="info-container alumno-container">
                <h2 class="title">Iniciar Sesión</h2>


                <form action="{{route('alumno.login.usuario')}}" method="post" class="form-container">
                    @csrf

                    <!-- ALERTAS -->
                    @if(Session::has('success'))
                        <div class="alert alert-success">{{Session::get('success')}}</div>
                    @endif
                    @if(Session::has('fail'))
                        <div class="alert alert-danger">{{Session::get('fail')}}</div>
                    @endif
                    

                    <div class="input-container">
                        <input class="input" type="text" placeholder="Número de cuenta" name="num_cuenta" value="{{old('num_cuenta')}}">
                        <span class="text-danger">@error('num_cuenta') {{$message}} @enderror</span><!-- Parte de boostrap -->

                        <input class="input" type="password" placeholder="Contraseña" name="contraseña" value="">
                        <span class="text-danger">@error('contraseña') {{$message}} @enderror</span><!-- Parte de boostrap -->
                    </div>

                    <button class="btn" type="submit">Ingresar</button>
                </form>


                <button class="span btn_border_opacity" type="submit" onclick="location.href='/alumno/registro'">Registrarse</button>
                <button class="span btn_border_opacity">Olvide mi contraseña</button>

                <div class="return1 return">
                    <button class="span return1 btn_border_opacity pointer_button" type="submit" onclick="location.href='/'">
                        <i class="fa fa-arrow-circle-left" aria-hidden="true"></i>
                        Volver al inicio
                    </button>
                </div>
            </div>
            <div class="image-container">
                <img class="biblioteca_central" src="{{ asset('assets/img/biblioteca_central.jpg') }}" alt="Imágen tren fi unam">
            </div>

        </div>
    </body>
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</html>