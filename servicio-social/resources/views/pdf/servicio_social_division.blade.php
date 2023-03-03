<!doctype HTML>
<head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,400;0,500;0,700;1,300&display=swap" rel="stylesheet">
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
    <table>
        <tbody>
            <tr>
                <td style="width: 50%">
                    <?php
                        $path = 'assets/img/escudo_unam.png';
                        $type = pathinfo($path,PATHINFO_EXTENSION);
                        $data = file_get_contents($path);
                        $base64 = 'data:image/'.$type.';base64,'.base64_encode($data);
                    ?>
                    <img src="{{$base64}}" style="width: 75%">
                </td>
                <td style = "text-align: right">
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
                </td>
            </tr>
        </tbody>
    </table>
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