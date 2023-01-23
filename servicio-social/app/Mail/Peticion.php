<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Peticion extends Mailable
{
    use Queueable, SerializesModels;
    
    public $email;
    public $nombre;
    public $num_cuenta;
    public $nombre_alumno;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($email,$nombre,$num_cuenta,$nombre_alumno)
    {
        $this->email = $email;
        $this->nombre = $nombre;
        $this->num_cuenta = $num_cuenta;
        $this->nombre_alumno = $nombre_alumno;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Nuevo registro al programa de servicio social de UNICA')
            ->markdown('emails.peticion');
    }
}
