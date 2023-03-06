<!doctype HTML>
<html>
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <!-- Se copiaron y pegaron estilos por compatibilidad-->
    <style>
.container{flex-direction:column;width:1000px}.header{border:1px solid grey;border-collapse:collapse;margin:20px auto;width:90%}.header td,.header th{border:1px solid grey}.header__title{color:grey;font-size:18px;font-weight:700}.header__datos{padding-left:8px}.header__datos-title{color:grey;font-size:14px;font-weight:700}.header__datos-info{color:grey;font-size:16px;text-align:center}.table{border-collapse:collapse;font-size:14px;margin:25px auto;min-width:400px;overflow:hidden;width:90%}.table td,.table th{padding:8px 15px;text-align:center}.table__campos tr{background-color:#4f81bd;color:#fff;font-weight:700}.table__registros tr{border-bottom:1px solid #ddd}.table__registros tr:nth-last-of-type(2n){background-color:#f3f3f3}.table__registros tr:last-of-type{border-bottom:1px solid #000}

/*! normalize.css v8.0.1 | MIT License | github.com/necolas/normalize.css */html{-webkit-text-size-adjust:100%;line-height:1.15}body{margin:0}main{display:block}h1{font-size:2em;margin:.67em 0}hr{box-sizing:content-box;height:0;overflow:visible}pre{font-family:monospace,monospace;font-size:1em}a{background-color:transparent}abbr[title]{border-bottom:none;text-decoration:underline;-webkit-text-decoration:underline dotted;text-decoration:underline dotted}b,strong{font-weight:bolder}code,kbd,samp{font-family:monospace,monospace;font-size:1em}small{font-size:80%}sub,sup{font-size:75%;line-height:0;position:relative;vertical-align:baseline}sub{bottom:-.25em}sup{top:-.5em}img{border-style:none}button,input,optgroup,select,textarea{font-family:inherit;font-size:100%;line-height:1.15;margin:0}button,input{overflow:visible}button,select{text-transform:none}[type=button],[type=reset],[type=submit],button{-webkit-appearance:button}[type=button]::-moz-focus-inner,[type=reset]::-moz-focus-inner,[type=submit]::-moz-focus-inner,button::-moz-focus-inner{border-style:none;padding:0}[type=button]:-moz-focusring,[type=reset]:-moz-focusring,[type=submit]:-moz-focusring,button:-moz-focusring{outline:1px dotted ButtonText}fieldset{padding:.35em .75em .625em}legend{box-sizing:border-box;color:inherit;display:table;max-width:100%;padding:0;white-space:normal}progress{vertical-align:baseline}textarea{overflow:auto}[type=checkbox],[type=radio]{box-sizing:border-box;padding:0}[type=number]::-webkit-inner-spin-button,[type=number]::-webkit-outer-spin-button{height:auto}[type=search]{-webkit-appearance:textfield;outline-offset:-2px}[type=search]::-webkit-search-decoration{-webkit-appearance:none}::-webkit-file-upload-button{-webkit-appearance:button;font:inherit}details{display:block}summary{display:list-item}[hidden],template{display:none}html{box-sizing:border-box;font-size:62.5%}*,:after,:before{box-sizing:inherit;margin:0;padding:0}body{font-family:Open Sans,sans-serif,Arial;font-size:1.6rem}p{color:#191919;font-size:2rem}a{text-decoration:none}h1{font-size:4rem}h2{font-size:3.6rem}h3{font-size:3rem}.container{display:flex;height:100vh;margin:0;width:100%}img{display:block;max-width:100%}
/*# sourceMappingURL=alumnosEstadisticas.css.map */



    </style>
</head>
<body>
    <div class="container">
        <table class="header">
            <tr>
                <td rowspan="3">
                    <picture>
                        <img class="unica_logo" src="data:image/png;base64,<?php echo base64_encode(file_get_contents(base_path('public/assets/img/unica.png'))); ?>" width="250" height="120">
                    </picture>
                </td>

                <th rowspan="3" class="header__title">
                    RELACIÓN DE ALUMNOS DE SERVICIO SOCIAL EN UNICA
                </th>
                <td class="header__datos">
                    <p class="header__datos-title">Responsable:</p>
                    <p class="header__datos-info">Beatriz Barrera Hernández</p>
                </td>
            </tr>
                <td class="header__datos">
                    <p class="header__datos-title">Departamento:</p>
                    <p class="header__datos-info">Servicios Académicos</p>
                </td>
            </tr>
            <tr>
                <td class="header__datos">
                    <p class="header__datos-title">Periodo:</p>
                    <p class="header__datos-info">Semestre 2022-1</p>
                </td>
            </tr>
        </table>



        <table class="table" id="TablaAlumnos">
        <thead class="table__campos">
            <tr>
                <th>Número de cuenta</th>
                <th>Nombre</th>
                <th>Fecha de inicio</th>
                <th>Fecha de terminación</th>
                <th>Carrera</th>
                @if ($departamento == 'DSA')    
                    <th>Depto.</th>
                @endif
                <th>Estado</th>
                <th>Becario</th>
            </tr>
        </thead>
        <tbody class="table__registros">
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
                <td>{{ucfirst(strtolower($data->estado))}}</td>
                @if($data->becario_unica == 1)
                    <td>Verdadero</td>
                @else
                    <td>Falso</td>
                @endif
            </tr>
            @endforeach
        </tbody>
        </table>
    </div>
</body>
</html>
