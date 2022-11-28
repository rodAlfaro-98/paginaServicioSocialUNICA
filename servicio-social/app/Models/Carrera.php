<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Carrera extends Model{
    protected $table = 'carrera';

    protected $fillable = [
        'id','clave_carrera','carrera','division_id'
    ];

    public function getClave(){
        return $this->clave_carrera;
    }

    public function getNombre(){
        return $this->carrera;
    }

    public function getDivision(){
        return Division::where('id',$this->division_id)->first();
    }

}