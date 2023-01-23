<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Registro extends Mailable
{
    use Queueable, SerializesModels;
    public $email;
    public $nombre;
    public $departamento;
    public $jefe_departamento;
    public $contraseña;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($email,$nombre,$departamento,$jefe_departamento,$contraseña)
    {
        $this->email = $email;
        $this->nombre = $nombre;
        $this->departamento = $departamento;
        $this->jefe_departamento = $jefe_departamento;
        $this->contraseña = $contraseña;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Su registro al sistema fue exitoso')
            ->markdown('emails.registros');
    }
}
