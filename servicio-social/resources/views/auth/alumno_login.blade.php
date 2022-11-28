<!doctype html>
<html lang = "es">
    <head>
        <meta charset = "UTF-8">
        <!-- CSS only -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
        <title>Login Alumno</title>
    </head>
    <body>
        <div class="container">
            <div class = "row justify-content-center">
                <div class = "col-md-6 col-md-offset-6" style="margin-top:20px;">
                    <h4>Login Alumno</h4>
                    <hr>
                    <form action="{{route('alumno.login.usuario')}}" method="post">
                        @if(Session::has('succes'))
                        <div class="alert alert-success">{{Session::get('success')}}</div>
                        @endif
                        @if(Session::has('fail'))
                        <div class="alert alert-danger">{{Session::get('fail')}}</div>
                        @endif
                        @csrf
                        <div class="form-group">
                            <label for="num_cuenta">Numero de cuenta</label>
                            <input type="text" class="form-control" placebolder="#########" name="num_cuenta" value="{{old('num_cuenta')}}" type="number">
                            <span class="text-danger">@error('num_cuenta') {{$message}} @enderror</span>
                        </div>
                        <div class="form-group">
                            <label for="password">Contraseña</label>
                            <input type="password" class="form-control" placeholder="Ingresa contraseña" name="contraseña" value="">
                            <span class="text-danger">@error('contraseña') {{$message}} @enderror</span>
                        </div>
                        <br>
                        <div class="form-group">
                            <button class="btn btn-block btn-primary" type="submit">Ingresar</button>
                        </div>
                    </form>
                    <hr>
                    <button class="btn btn-block btn-primary" type="submit" onclick="location.href='/'">Cambiar de tipo de usuario</button>
                    <br>
                    <br>
                    <p>Si no está registrado en el sistema da click en el siguiente botón</p>
                    <button class="btn btn-block btn-primary" type="submit" onclick="location.href='/alumno/registro'">Ingresar solicitud</button>
                    </div>
            </div>
        </div>
        <!-- JavaScript Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    </body>
</html>