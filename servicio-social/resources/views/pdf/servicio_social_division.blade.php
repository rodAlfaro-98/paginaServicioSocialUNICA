<!doctype HTML>
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <style>
        thead {
            background-color: #acc6fc;
        }
        #inner_doc {
            text-align: justify;
            text-justify: auto;
        }
    </style>
</head>
<body>
    <div class="container" style="text-align:right">
        <div class="row">
            <div class="col">
                <img src="{{ URL::asset('assets/img/escudo_unam.png')}}">
            </div>
            <div class="col">
                <p><strong>FACULTAD DE INGENIERÍA</strong></p>
                <p><strong>SECRETARÍA GENERAL</strong></p>
                <p><strong>UNIDAD DE SERVICIO DE CÓMPUTO ACADÉMICO</strong></p>
                <p><strong>UNICA</strong></p>
                <br>
                <br>
                <p><strong>Asunto:</strong></p>
                <p>Relación de Alumnos de Servicio Social en el {{$departamento}} {{$periodo}}</p>
                <br>
                <br>
            </div>
        </div>
    </div>
    <div id="inner_doc">
        <p><strong>{{mb_strtoupper($titulo_2)}} {{mb_strtoupper($nombre_completo_2)}}</strong></p>
        <p><strong>JEF{{($genero_2) ? 'A' : 'E'}} DEL {{mb_strtoupper($departamento)}}</strong></p>
        <p><strong>PRESENTE.</strong></p>
        <p>Por este conducto le informo que el alumno asignado para prestar su Servicio Social en el área que usted coordina este semestre {{$periodo}}, se detalla en la tabla posterior. Asimismo, le comento que, en función de dar un seguimiento a sus actividades, deberá asignar y supervisar dichas tareas.</p>
        <br>
        <div>
            <table style="margin: 0 auto;">
                <thead>
                    <th>NOMBRE</th>
                    <th>INICIO</th>
                    <th>TERMINACIÓN</th>
                </thead>
                <tbody>
                    @foreach($alumnos as $alumno)
                        <tr>
                            <td>{{$alumno->apellido_paterno}} {{$alumno->apellido_materno}} {{$alumno->nombres}}</td>
                            <td>{{str_replace('.','',mb_strtolower(\Carbon\Carbon::parse($alumno->fecha_inicio)->locale('mx')->formatLocalized('%d-%b-%y')))}}</td>
                            <td>{{str_replace('.','',mb_strtolower(\Carbon\Carbon::parse($alumno->fecha_fin)->locale('mx')->formatLocalized('%d-%b-%y')))}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <br>
        <p>Sin más por el momento le envió un cordial saludo.</p>
        <br>
        <br>
        <p><strong>Atentamente</strong></p>
        <p><strong>"POR MI RAZA HABLARÁ EL ESPIRITÚ"</strong></p>
        <p><strong>Cd. Universitaria, Cd. Mx. {{$fecha->format('d')}} de  {{$spanish_months[$fecha->format('F')]}} de {{$fecha->format('Y')}}</strong></p>
        <p><strong>JEF{{($genero_2) ? 'A' : 'E'}} DEL DEPTO. DE SERVICIOS ACADÉMICOS.</strong></p>
        <br>
        <br>
        <p><strong>{{mb_strtoupper($titulo)}} {{mb_strtoupper($nombre_completo)}}</strong></p>
    </div>
</body>