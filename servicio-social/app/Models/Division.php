<?php 
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Division extends Model{
    protected $table = 'division';

    protected $fillable = [
        'id','nombre','abreviatura','subdivision','titulo_coordinador','coordinador_servicio_social'
    ];

    public function getCoordinadorServicio(){
        return "".$this->titulo_coordinador." ".$this->coordinador_servicio_social;
    }

    public function getNombre(){
        return $this->nombre;
    }

    public function getAbreviatura(){
        return $this->abreviatura;
    }
}