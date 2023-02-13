@component('mail::message')
# Finalización del servicio

Estimado {{$nombre_alumno}}

Se le escribe para informarle que se acaba de finalizar su trámite de servicio social dentro del sistema de UNICA. Le agradecemos su servicio y horas de trabajo.

Gracias por su atención,<br>
{{ config('app.name') }}
@endcomponent
