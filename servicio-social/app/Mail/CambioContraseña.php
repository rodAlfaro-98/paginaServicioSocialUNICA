<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CambioContraseña extends Mailable
{
    use Queueable, SerializesModels;
    public $contraseña;
    public $nombre;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($nombre,$contraseña)
    {   
        $this->nombre = $nombre;
        $this->contraseña = $contraseña;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Cambio de contraseña exitoso')
            ->markdown('emails.cambio_contraseña');
    }
}
