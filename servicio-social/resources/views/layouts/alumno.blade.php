<!doctype html>
<html lang = "es">
    <head>
        <meta charset = "UTF-8">
        <!-- CSS only -->
        <!--<link href="{{ asset('css/layout_alumno.css') }}" rel="stylesheet">-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
        <link href="{{ asset('css/alumno_layout.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <title>@yield('title') | Alumno</title>
        <!--
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
        -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
    </head>
    <body>
        <header>
            <nav class="main-nav">
                <input type="checkbox" id="check" />
                <label for="check" class="menu-btn">
                <i class="fas fa-bars"></i>
                </label>
                <a href="#" class="logo">UNICA</a>
                <ul class="navlinks">
                <li><a href="{{route('alumno.home')}}" class="btn-layout_alumno">Inicio</a></li>
                <li><a href="{{route('alumno.cambia_contraseña')}}" class="btn-layout_alumno">Cambiar Contraseña</a></li>
                <li><a href="{{route('alumno.logout')}}" class="btn-layout_alumno">Cerrar Sesión</a></li>
                </ul>
            </nav>
        </header>
        <br>
        @yield('contenido')
            <!-- JavaScript Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    </body>
</html>