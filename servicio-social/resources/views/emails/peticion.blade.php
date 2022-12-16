@component('mail::message')
# Nueva solicitud de ingreso

Estimad@ {{$nombre}}.

Se le escribe con la finalidad de informarle que el alumno {{$nombre_alumno}} con número de cuenta {{$num_cuenta}} ingresó su solicitud para realizar el trámite del servicio social dentro de su departamento.
Los datos del alumno ya están disponibles dentro del sistema en la sección de alumnos pendientes.

Gracias por su atención,<br>
{{ config('app.name') }}
@endcomponent
