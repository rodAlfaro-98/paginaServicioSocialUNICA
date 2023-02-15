<!DOCTYPE html>
<html lang = "es">
<head>
    <meta charset = "UTF-8">
    <!-- CSS only -->
    <!--<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">-->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <title>@yield('title') | Alumno</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,400;0,500;0,700;1,300&display=swap" rel="stylesheet">

</head>
<body>
<div class="container">
    <div class="sidebar__contenedor close">
        <div class="sidebar__contenedor-header" title="Opciones">
            <div class="sidebar__contenedor-header-logo">
                <i id="btn_opciones" class="fa-solid fa-bars"></i>
            </div>
            <div class="sidebar__contenedor-header-marca">UNICA</div>
        </div>


        <div class="sidebar__contenedor-usuario" title="Perfil">
            <div class="sidebar__contenedor-usuario-logo">
                <img src="{{asset('img/unknown_user.png')}}" alt="">
            </div>
            <div class="sidebar__contenedor-usuario-datos">
                <div class="sidebar__contenedor-usuario-datos-titulo">Alumno</div>
                <div class="sidebar__contenedor-usuario-datos-subtitulo">No Asignado</div>
            </div>

        </div>

        <div class="sidebar__contenedor-opciones">
            <a href="{{route('alumno.home')}}" class="btn-layout_alumno">
            <div class="sidebar__contenedor-opciones-item" title="Inicio">
                <div class="sidebar__contenedor-opciones-item-logo">
                    <i class="fa-sharp fa-solid fa-house-chimney"></i>
                </div>
                <div class="sidebar__contenedor-opciones-item-titulo">
                    Inicio
                </div>
            </div>
            </a>

            <a href="#">
            <div class="sidebar__contenedor-opciones-item" title="Proceso">
                <div class="sidebar__contenedor-opciones-item-logo">
                    <i class="fa-regular fa-calendar"></i>
                </div>
                <div class="sidebar__contenedor-opciones-item-titulo">
                    Proceso
                </div>
            </div>
            </a>

            <a href="{{route('alumno.cambia_contraseña')}}">
            <div class="sidebar__contenedor-opciones-item" title="Cambiar Contraseñá">
                <div class="sidebar__contenedor-opciones-item-logo">
                    <i class="fa-solid fa-key"></i>
                </div>
                <div class="sidebar__contenedor-opciones-item-titulo">
                    Cambiar Contraseña
                </div>
            </div>
            </a>

            <a href="{{route('alumno.logout')}}" class="btn-logout">
            <div class="sidebar__contenedor-opciones-item" title="Cerrar Sesión">
                <div class="sidebar__contenedor-opciones-item-logo logout">
                    <i class="fa-solid fa-right-from-bracket"></i>
                </div>
                <div class="sidebar__contenedor-opciones-item-titulo logout">
                    Cerrar Sesión
                </div>
            </div> 
            </a>

        </div>
    </div>

    @yield('contenido')

</div>
</body>
<!-- JavaScript Bundle with Popper -->
<!--
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
-->
<script src="{{ asset('assets/js/alumnoSidebar.js')}}"></script>
</html>