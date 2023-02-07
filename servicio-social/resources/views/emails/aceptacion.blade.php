@component('mail::message')
# Aceptación de solicitud

Estimado {{$nombre_alumno}}

Su solicitud para para realizar el servicio social en el departamento {{$departamento}} ha sido aceptada. 
Dentro de la página del servicio social debe de ver que su solicitud cambió de "PENDIENTE" a "ACEPTADA".

Gracias por su atención,<br>
{{ config('app.name') }}
@endcomponent
