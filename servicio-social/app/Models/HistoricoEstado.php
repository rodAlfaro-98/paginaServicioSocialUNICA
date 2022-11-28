<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HistoricoEstado extends Model{
    protected $table = 'historico_estado';

    protected $fillable = [
        'id','fecha_estado','estado_id','departamento_id','alumno_id'
    ];

    public function getFecha(){
        return $this->fecha_estado;
    }

    public function getEstado(){
        return Estado::findOrFail($this->estado_id)->first();
    }

    public function getDepartamento(){
        return Departamento::findOrFail($this->departamento_id)->first();
    }

    public function getAlumno(){
        return Alumno::findOrFail($this->alumno_id)->first();
    }
}