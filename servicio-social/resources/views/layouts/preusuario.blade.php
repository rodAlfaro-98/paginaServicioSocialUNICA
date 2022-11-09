
<!-- Guardado en resources/views/layouts/principal.blade.php -->

<style>
  #outer {
    width:100%
  }
  #inner {
    display: table;
    margin: 0 auto;
    width:85%;
  }
</style>

<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('/img/cdd.ico') }}" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>Servicio Social UNICA</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('dist/jquery.fancybox.min.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/font-awesome.min.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/admin.css') }}"/>

</head>
<body>
<div class="wrap" style="width:100%">
    @if(session()->has('msj'))
        <div class="alert alert-danger" role='alert'>{{session('msj')}}</div>          
    @endif
    

    <aside id="side-menu" class="aside" role="navigation">
        <ul class="nav nav-list accordion">
        </ul>
    </aside>
    @yield('contenido')

    <footer class="content-inner" id="inner">
        <div class="panel panel-default">
            <div class="panel-heading">
                Hecho en México, Universidad Nacional Autónoma de México, Facultad de Ingeniería, Unidad de servicios de cómputo académico, Departamento de Investigación y Desarrollo.
                Todos los derechos reservados 2021.
            </div>
        </div>
    </footer>
</div>
<script src="{{ asset ('/js/jquery.js') }}"></script>
<script src="{{ asset ('/js/admin.js') }}"></script>
<script src="{{ asset ('/dist/jquery.fancybox.min.js') }}"></script>
<script src="{{ asset('/js/bootstrap.min.js') }}"></script>
</body>
</html>