@component('mail::message')
# Cambio de contraseña

Estimad@ {{$nombre}}.

Se le escribe para informarle que su contraseña fue cambiada exitosamene a "{{$contraseña}}". 
Si no reconoce este movimiento, favor de realizar un nuevo cambio.

Gracias por su atención,<br>
{{ config('app.name') }}
@endcomponent
