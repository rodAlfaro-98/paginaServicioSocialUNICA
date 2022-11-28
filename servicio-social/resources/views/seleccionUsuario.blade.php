<!doctype html>
<html lang = "es">
    <head>
        <meta charset = "UTF-8">
        <!-- CSS only -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
        <title>Selección de Usuario</title>
    </head>
    <body>
        <div class="container">
            <div class = "row justify-content-center">
                <div class = "col-md-6 col-md-offset-6" style="margin-top:20px;">
                    <h4>Seleccione su tipo de usuario</h4>
                    <hr>
                    <table class="table">
                        <thead>
                            
                        </thead>
                        <tbody>
                            <tr>
                                <button class="btn btn-block btn-primary" type="submit" onclick="window.location.href='{{route('departamento.login')}}'">Jefe de departamento</button>
                                <br>
                            </tr>
                            <tr>
                                <button class="btn btn-block btn-primary" type="submit" onclick="window.location.href='{{route('alumno.login')}}'">Alumno</button>
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