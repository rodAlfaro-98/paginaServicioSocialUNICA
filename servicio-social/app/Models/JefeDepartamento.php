<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JefeDepartamento extends Model{
    protected $table = "jefe_departamento";

    protected $fillabel = [
        "id", "titulo","nombres","apellido_paterno","apellido_materno","email","uid","contraseña"
    ];

    public function getNombre(){
        return "".$this->nombres." ".$this->apellido_paterno." ".$this->apellido_materno;
    }

    public function getNombreUnApellido(){
        return "".$this->nombres." ".$this->apellido_paterno;
    }

    public function getNombreTitulo(){
        return "".$this->titulo." ".$this->nombres." ".$this->apellido_paterno." ".$this->apellido_materno;
    }

    public function getEmail(){
        return $this->email;
    }

    public function getUid(){
        return $this->uid;
    }

    public function getCredenciales(){
        return array('uid' => $this->uid, 'contraseña' => $this->contraseña);
    }
}