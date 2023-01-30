<!doctype html>
<html lang = "es">
    <head>
        <meta charset = "UTF-8">
        <!-- CSS only -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <style>
             /* The sidenav */
        .sidenav {
            height: 100%;
            width: 15%;
            position: fixed;
            z-index: 1;
            top: 0;
            left: 0;
            background-color: #414bb2;
            overflow-x: hidden;
            padding-top: 20px;
            color: white;
        }

        /* Page content */
        .main {
          margin-left: 15%; /* Same as the width of the sidenav */
          margin-right: 0%;
        } 

        a:link { text-decoration: none; }

        a:visited { text-decoration: none; }

        a:hover { text-decoration: none; }

        </style>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
        <title>Coordinador</title>
    </head>
    <body>
        <nav class="sidenav">
            <h3>{{$jefe->getNombreUnApellido()}}</h3>
            <div style="margin-left:10px;">
                <br>
                <br>
                <h5><a>Alumnos pendientes</a></h5>
                <h5><a>Alumnos inscritos</a></h5>
                <h5><a>Estadísticas</a></h5>
                <h5><a href="{{route('departamento.logout')}}" style="color: white;">Cerrar Sesión</a></h5>
            </div>
        </nav>
        <div class = "main">
            @yield('contenido')
        </div>
        <!-- JavaScript Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    </body>
</html>