<!doctype html>
<html lang = "es">
    <head>
        <meta charset = "UTF-8">
        <!-- CSS only -->
        <link href="{{ asset('css/layout_alumno.css') }}" rel="stylesheet">
        <style>
            .topnav {
                background-color: #0275d8;
                overflow: hidden;
                height: 55px;
            }

            /* Style the links inside the navigation bar */
            .topnav a {
                float: left;
                color: #f2f2f2;
                text-align: center;
                padding: 14px 16px;
                text-decoration: none;
                font-size: 17px;
            }

            /* Change the color of links on hover */
            .topnav a:hover {
                background-color: #ddd;
                color: black;
            }

            /* Add a color to the active/current link */
            .topnav a.active {
                background-color: #aa3304;
                color: white;
            }

             /* Dropdown Button */
            button.dropdown-menu {
                display: inline-block;
                background-color: #0275da;
                color: white;
                padding: 14px 16px;
                font-size: 16px;
                border: none;
            }

            .dropdown {
                position: relative;
                background-color: #0275d8;
                height: 55px;
            }

            /* Dropdown Content (Hidden by Default) */
            .dropdown-content {
                display: none;
                background-color: #f1f1f1;
                min-width: 160px;
                box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
                z-index: 1;
                text-align: left;
            }

            /* Links inside the dropdown */
            .dropdown-content a {
                color: black;
                padding: 10px 12px;
                text-decoration: none;
                display: block;
            }

            /* Change color of dropdown links on hover */
            .dropdown-content a:hover {background-color: #ddd; color: black;}

            /* Show the dropdown menu on hover */
            .dropdown:hover .dropdown-content {display: block;}

            .dropdown:hover .dropdown-menu {display: none; background-color: #ddd; color: black;} 

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