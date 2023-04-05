<!doctype html>
<html lang = "es">
    <head>
        <meta charset = "UTF-8">
        <!-- CSS only -->
        <!--
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
        -->
        <title>Departamento</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        @vite(['resources/css/inicio.css'])

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
    <body>
        <div class="container">
            <div class="info-container jefe-container">
                <h2 class="title">Iniciar Sesión</h2>

                @if(Session::has('success'))
                    <div class="alert alert-success">{{Session::get('success')}}</div>
                @endif
                @if(Session::has('fail'))
                    <div class="alert alert-danger">{{Session::get('fail')}}</div>
                @endif


                <form action="{{route('departamento.login.usuario')}}" method="post" class="form-container">
                    @csrf
                    <input class="input" type="text" placeholder="Usuario" name="usuario" value="{{old('uid')}}">
                    <span class="text-danger">@error('usuario') {{$message}} @enderror</span>
                    <input class="input" type="password" placeholder="Contraseña" name="contraseña" value="">
                    <span class="text-danger">@error('contraseña') {{$message}} @enderror</span>
                    <button class="btn" type="submit">Ingresar</button>
                </form>


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
        <!-- JavaScript Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    </body>
</html>