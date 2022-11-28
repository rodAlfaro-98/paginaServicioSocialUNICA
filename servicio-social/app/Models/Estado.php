<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Estado extends Model{
    protected $table = "estado";

    protected $fillable = [
        'id','estado','fecha_estado'
    ];

    public function getEstado(){
        return $this->estado;
    }

    public function getFecha(){
        return $this->fecha_estado;
    }
}