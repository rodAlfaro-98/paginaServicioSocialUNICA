@extends('layouts.coordinador')

@section('contenido')
        <div class="container">
            <div class = "row" style="margin: 60px 50px;">
                <div class = "col-md-offset-4" style="margin-top:20px;">
                    @if(Session::has('success'))
                        <div class="alert alert-success">{{Session::get('success')}}</div>
                    @endif
                    @if(Session::has('fail'))
                        <div class="alert alert-danger">{{Session::get('fail')}}</div>
                    @endif
                    @csrf
                    <h4>Bienvenido Coordinador {{$jefe->getNombre()}}</h4>
                    <hr>
                    <div class="container">
                        <div class="row">
                            @if ($departamento != 'DSA')
                                <h6>Alumnos de la {{$departamento}}</h6>
                            @else
                                <div class="col">
                                    <p>Filtro por división:</p>
                                    <div class="container">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" id="DSA" name="DSA" value="DSA" onclick="getSelected()">
                                            <label class="form-check-label" for="DSA">DSA</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" id="DID" name="DID" value="DID" onclick="getSelected()">
                                            <label class="form-check-label" for="DID">DID</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" id="DSC" name="DSC" value="DSC" onclick="getSelected()">
                                            <label class="form-check-label" for="DSC">DSC</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" id="DROS" name="DROS" value="DROS" onclick="getSelected()">
                                            <label class="form-check-label" for="DROS">DROS</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" id="Salas" name="Salas" value="Salas" onclick="getSelected()">
                                            <label class="form-check-label" for="Salas">Salas</label>
                                        </div>
                                    </div>
                                </div>
                                <br>
                            @endif
                            <div class="col">
                                <div class="container">
                                    <br>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label for="nombre_becario">Nombre del alumno:</label>
                                        </div>
                                        <div class="col">
                                            <input type="text" class="form-control" id="nombre_becario" aria-describedby="basic-addon3" onkeyup="getAlumnos()" placeholder="Ingrese nombre del alumno a buscar...">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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
                        <th>Acciones<th>
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
                            <td>
                                <div class="container">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <button type="button" class="btn btn-info" style="color:white;" onclick="window.location='{{route("departamento.alumno.datos",["num_cuenta" => $data->numero_cuenta])}}'">Datos</Button>
                                        </div>
                                        <div class="col-sm-6">
                                            <button type="button" class="btn btn-danger" onclick="confirmacionBaja({{$data->numero_cuenta}})">Baja</button>    
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
        <script>
            function confirmacionBaja(numero_cuenta){
                if( confirm("Se va a dar de baja al alumno con numero de cuenta: "+numero_cuenta+"\nDesea confirmar la acción?") == true ){
                    window.location.href = "/departamento/baja/"+numero_cuenta;
                }
            }
            function getAlumnos(){
                var tablr,tr,txtValue,txtInput,filter;
                table = document.getElementById('TablaAlumnos')
                tr = table.getElementsByTagName("tr");
                filter = document.getElementById('nombre_becario');
                txtInput = filter.value.toUpperCase()
                for (var i = 1; i < tr.length; i++){
                    var nombre = tr[i].getElementsByTagName("td")[1].innerHTML
                    if(nombre.toUpperCase().includes(txtInput)){
                        tr[i].style.display = "";
                    }else{
                        tr[i].style.display = "none";
                    }
                }
            }
            function getSelected(){
                var filter = [];
                if(document.getElementById('DSA').checked) {
                    filter.push('DSA');
                }
                if(document.getElementById('DID').checked) {
                    filter.push('DID');
                }
                if(document.getElementById('DSC').checked) {
                    filter.push('DSC');
                }
                if(document.getElementById('DROS').checked) {
                    filter.push('DROS');
                }
                if(document.getElementById('Salas').checked) {
                    filter.push('Salas');
                }
                var table, tr, txtValue;
                table = document.getElementById('TablaAlumnos')
                tr = table.getElementsByTagName("tr");
                if(filter.length == 0){
                    for (var i = 1; i < tr.length; i++){
                        tr[i].style.display = "";
                    }
                }
                else{
                    for (var i = 1; i < tr.length; i++){
                        var departamento = tr[i].getElementsByTagName("td")[5]
                        if(filter.includes(departamento.innerHTML)){
                            tr[i].style.display = "";
                        }else{
                            tr[i].style.display = "none";
                        }
                    }
                }

            }
        </script>
@endsection