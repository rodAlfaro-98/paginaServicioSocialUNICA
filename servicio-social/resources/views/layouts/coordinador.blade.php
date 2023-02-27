<!doctype html>
<html lang = "es">
    <head>
        <meta charset = "UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- CSS only -->
        <!--<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">-->
        <!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">-->
        <!--<link rel="stylesheet" href="{{URL::asset('css/departamento_layout.css')}}">-->
        <!--<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">-->
        <link href="{{ asset('css/main.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,400;0,500;0,700;1,300&display=swap" rel="stylesheet">
        <title>Coordinador</title>
    </head>
    <body>
        <div class="container container-sidebar">
                <div class="sidebar__contenedor close">
                <div class="sidebar__contenedor-header" title="Opciones">
                    <div class="sidebar__contenedor-header-logo">
                        <i id="btn_opciones" class="fa-solid fa-bars"></i>
                    </div>
                    <div class="sidebar__contenedor-header-marca">UNICA</div>
                </div>


            <div class="sidebar__contenedor-usuario" title="Perfil">
                <div class="sidebar__contenedor-usuario-logo admin-logo">
                    <i class="fa-solid fa-user-gear"></i>
                </div>
                <div class="sidebar__contenedor-usuario-datos">
                    <div class="sidebar__contenedor-usuario-datos-titulo">Coordinador</div>
                    <div class="sidebar__contenedor-usuario-datos-subtitulo">{{$jefe->getNombre()}}</div>
                </div>

            </div>

            <div class="sidebar__contenedor-opciones">
                <a href="{{route('departamento.home')}}" class="btn-layout_alumno">
                <div class="sidebar__contenedor-opciones-item" title="Alumnos Inscritos">
                    <div class="sidebar__contenedor-opciones-item-logo">
                        <i class="fa-solid fa-briefcase"></i>
                    </div>
                    <div class="sidebar__contenedor-opciones-item-titulo">
                        Alumnos Inscritos
                    </div>
                </div>
                </a>

                <a href="{{route('departamento.pendientes')}}">
                <div class="sidebar__contenedor-opciones-item" title="Alumnos Pendientes">
                    <div class="sidebar__contenedor-opciones-item-logo">
                        <i class="fa-solid fa-clipboard-question"></i>
                    </div>
                    <div class="sidebar__contenedor-opciones-item-titulo">
                        Alumnos Pendientes
                    </div>
                </div>
                </a>

                <a href="{{route('departamento.rachazados')}}">
                <div class="sidebar__contenedor-opciones-item" title="Alumnos Rechazados">
                    <div class="sidebar__contenedor-opciones-item-logo">
                        <i class="fa-sharp fa-regular fa-circle-xmark"></i>
                    </div>
                    <div class="sidebar__contenedor-opciones-item-titulo">
                        Alumnos Rechazados
                    </div>
                </div>
                </a>

                <a href="{{route('departamento.estadistica')}}">
                <div class="sidebar__contenedor-opciones-item" title="Estadisticas">
                    <div class="sidebar__contenedor-opciones-item-logo">
                        <i class="fa-solid fa-chart-line"></i>
                    </div>
                    <div class="sidebar__contenedor-opciones-item-titulo">
                    Estadisticas
                    </div>
                </div>
                </a>

                <a href="{{route('departamento.logout')}}" class="btn-logout">
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

        <!-- JavaScript Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
        <script src="{{ asset('assets/js/alumnoSidebar.js')}}"></script>
    </body>
</html>