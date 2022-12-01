<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Departamento extends Model{
    protected $table = 'departamento';

    protected $fillable = [
        'id','departamento','abreviatura_departamento','jefe_departamento_id'
    ];

    public function getNombre(){
        return $this->departamento;
    }

    public function getAbreviatura(){
        return $this->abreviatura_departamento;
    }

    public function getJefeDepartamento(){
        return JefeDepartamento::where('id',$this->jefe_departamento_id)->first();
    }

    public function getAlumnosAceptados(){
        $alumnos = Alumno::where('departamento_id',$this->id)->get();
        $aux = array();
        foreach($alumnos as $alumno){
            $estado = Estado::where('id',$alumno->estado_id)->first();
            if(strcmp($estado->getEstado(),'ACEPTADO') == 0)
                array_push($aux,$alumno->getDatos());
        }
        return $aux;
    }

    public function getAlumnosPendientes(){
        $alumnos = Alumno::where('departamento_id',$this->id)->get();
        $aux = array();
        foreach($alumnos as $alumno){
            $estado = Estado::where('id',$alumno->estado_id)->first();
            if(strcmp($estado->getEstado(),'PENDIENTE') == 0)
                array_push($aux,$alumno->getDatos());
        }
        return $aux;
    }
}