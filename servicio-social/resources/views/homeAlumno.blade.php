<!doctype html>
<html lang = "es">
    <head>
        <meta charset = "UTF-8">
        <!-- CSS only -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
        <title>Home Alumno</title>
    </head>
    <body>
        <div class="container">
            <div class = "row">
                <div class = "col-md-offset-4" style="margin-top:20px;">
                    <h4>Bienvenido al dashboard</h4>
                    <hr>
                    <table class="table">
                        <thead>
                            <th>Número de cuenta</th>
                            <th>Nombre</th>
                            <th>Fecha de inicio</th>
                            <th>Fecha de terminación</th>
                            <th>Duración en meses</th>
                            <th>Clave Carrera</th>
                            <th>Departamento</th>
                            <th>Accion</th>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{$data->numero_cuenta}}</td>
                                <td>{{$data->nombres}} {{$data->apellido_paterno}} {{$data->apellido_materno}}</td>
                                <td>{{$data->fecha_inicio}}</td>
                                <td>{{$data->fecha_fin}}</td>
                                <td>{{$data->duracion_servicio}}</td>
                                <td>{{$data->clave_carrera}}</td>
                                <td>{{$data->departamento}}</td>
                                <td><a href="/alumno/logout">Logout</a></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- JavaScript Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    </body>
</html>