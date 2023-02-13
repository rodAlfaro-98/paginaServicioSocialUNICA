<!doctype html>
<html lang = "es">
    <head>
        <meta charset = "UTF-8">
        <!-- CSS only -->
        <!--<link href="{{ asset('css/layout_alumno.css') }}" rel="stylesheet">-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
        <link rel="stylesheet" href="{{URL::asset('css/alumno_layout.css')}}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <style>
        </style>
        <title>@yield('title') | Alumno</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    </head>
    <body>
        <div class="container-fluid">
            <div class="row">
                <div class="topnav col-10">
                    <nav>
                        <a href="{{route('alumno.home')}}">Inicio</a>
                    </nav>
                </div>
                <div class="dropdown col-2">
                    <button class="dropdown-menu" style="right: 0; left: auto;"><img class="img2" src="{{ asset(URL::to('/assets/img/hamburger.png')) }}" width="25" height="25">Sesión</button>
                    <div class="dropdown-content dropdown-menu-right">
                        <a href="{{route('alumno.cambia_contraseña')}}">Cambiar Contraseña</a>
                        <a href="{{route('alumno.logout')}}">Cerrar Sesión</a>
                    </div>
                </div>
            </div>
        </div>
        @yield('contenido')
            <!-- JavaScript Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    </body>
</html>