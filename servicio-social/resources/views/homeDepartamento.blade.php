@extends('layouts.coordinador')

@section('contenido')
        <div class="container">
            <div class = "row" style="margin: 60px 50px;>
                <div class = "col-md-offset-4" style="margin-top:20px;">
                    <h4>Bienvenido Coordinador {{$jefe->getNombre()}}</h4>
                    <hr>
                    @if (Session::get('departamento') != 'DSA')
                        <p>Alumnos de la {{$departamento}}</p>
                    @endif
                    <table class="table">
                    <thead>
                        <th>Número de cuenta</th>
                        <th>Nombre</th>
                        <th>Fecha de inicio</th>
                        <th>Fecha de terminación</th>
                        <th>Duración en meses</th>
                        <th>Clave Carrera</th>
                        <th>Departamento</th>
                    </thead>
                    <tbody>
                        @foreach($alumnos as $data)
                        <tr>
                            <td>{{$data->numero_cuenta}}</td>
                            <td>{{$data->nombres}}</td>
                            <td>{{$data->fecha_inicio}}</td>
                            <td>{{$data->fecha_fin}}</td>
                            <td>{{$data->duracion_servicio}}</td>
                            <td>{{$data->clave_carrera}}</td>
                            <td>{{$data->departamento}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                </div>
            </div>
        </div>
        <!-- JavaScript Bundle with Popper -->
@endsection