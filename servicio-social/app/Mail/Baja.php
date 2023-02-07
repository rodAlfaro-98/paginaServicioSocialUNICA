<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Baja extends Mailable
{
    use Queueable, SerializesModels;
    
    public $email;
    public $nombre_alumno;
    public $departamento;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($email,$nombre_alumno,$departamento)
    {
        $this->email = $email;
        $this->nombre_alumno = $nombre_alumno;
        $this->departamento = $departamento;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Usted ha sido dado de baja del sistema del servicio social de UNIA')
            ->markdown('emails.baja');
    }
}
