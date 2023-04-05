<!DOCTYPE html>
<html lang = "es">
<head>
    <meta charset = "UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Titulo -->
    <title>@yield('title') | Alumno</title>
    <!-- Estilos -->
    @vite('resources/css/alumno.css')
    <!-- Iconos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    <!-- Fuentes -->
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
                <img src="{{asset('assets/img/unknown_user.png')}}" alt="">
            </div>
            <div class="sidebar__contenedor-usuario-datos">
                <!--colocar nombre del usuario en lugar de Alumno-->
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
<script src="{{ asset('assets/js/sidebar.js')}}"></script>
</html>
