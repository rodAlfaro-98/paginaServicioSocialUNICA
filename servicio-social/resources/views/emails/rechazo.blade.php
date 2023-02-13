@component('mail::message')
# Rechazo de solicitud

Estimado {{$nombre_alumno}}

Su solicitud para para realizar el servicio social en el departamento {{$departamento}} ha sido rechazada. 
Dentro de la página del servicio social debe de ver que su solicitud cambió de "PENDIENTE" a "RECHAZADO".
Si desea más información favor de contactar con el departamento de servicios académicos de UNICA.

Gracias por su atención,<br>
{{ config('app.name') }}
@endcomponent
