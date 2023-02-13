<!doctype html>
<html lang = "es">
    <head>
        <meta charset = "UTF-8">
        <!-- CSS only -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="{{URL::asset('css/departamento_layout.css')}}">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
        <title>Coordinador</title>
    </head>
    <body>
        <div class="page">
            <header tabindex="0">
                <h5 class="learn-more-h5 btnh5 header-h5"><a href="{{route('departamento.logout')}}">
                <span class="circle" aria-hidden="true">
                <span class="icon-h5 arrow"></span>
                </span>
                <span class="button-text">Cerrar Sesión</span></a>
                </h5>
            </header>
            <div id="nav-container">
                <div class="bg"></div>
                <div class="button" tabindex="0">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </div>
                <div id="nav-content" tabindex="0">
                    <ul>
                        <h5 class="learn-more-h5 btnh5"><a href="{{route('departamento.pendientes')}}">
                        <span class="circle" aria-hidden="true">
                        <span class="icon-h5 arrow"></span>
                        </span>
                        <span class="button-text">Alumnos pendientes</span></a>
                        </h5>

                        <h5 class="learn-more-h5 btnh5"><a href="{{route('departamento.home')}}">
                        <span class="circle" aria-hidden="true">
                        <span class="icon-h5 arrow"></span>
                        </span>
                        <span class="button-text">Alumnos inscritos</span></a>
                        </h5>

                        <h5 class="learn-more-h5 btnh5"><a href="{{route('departamento.rachazados')}}">
                        <span class="circle" aria-hidden="true">
                        <span class="icon-h5 arrow"></span>
                        </span>
                        <span class="button-text">Alumnos rechazados</span></a>
                        </h5>

                        <h5 class="learn-more-h5 btnh5"><a href="{{route('departamento.estadistica')}}">
                        <span class="circle" aria-hidden="true">
                        <span class="icon-h5 arrow"></span>
                        </span>
                        <span class="button-text">Estadísticas</span></a>
                        </h5>
                    </ul>
                </div>
            </div>

            <main>
                <div class="content">
                @yield('contenido')
                </div>
            </main>
        </div>
        <!-- JavaScript Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    </body>
</html>