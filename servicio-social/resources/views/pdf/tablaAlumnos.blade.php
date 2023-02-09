<!doctype HTML>
<html>
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <h4>Alumnos de con estado {{$estado}} del departamento {{$departamento}}</h4>
        <hr>
        <hr>
        <table class="table" id="TablaAlumnos">
        <thead>
            <th>Número de cuenta</th>
            <th>Nombre</th>
            <th>Fecha de inicio</th>
            <th>Fecha de terminación</th>
            <th>Carrera</th>
            @if ($departamento == 'DSA')    
                <th>Depto.</th>
            @endif
            <th>Estado</th>
        </thead>
        <tbody>
            @foreach($alumnos as $data)
            <tr>
                <td>{{$data->numero_cuenta}}</td>
                <td>{{$data->nombres}}</td>
                <td>{{$data->fecha_inicio}}</td>
                <td>{{$data->fecha_fin}}</td>
                <td>{{$data->clave_carrera}}</td>
                @if($departamento == 'DSA')
                    <td>{{$data->abreviatura_departamento}}</td>
                @endif
                <td>{{$estado}}</td>
            </tr>
            @endforeach
        </tbody>
        </table>
    </div>
</body>
</html>