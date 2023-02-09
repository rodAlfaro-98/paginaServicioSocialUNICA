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

    public function getAlumnosAceptados($superUsuario = false){
        $aux = array();
        $alumnos = ($superUsuario) ? Alumno::select('*')->orderBy('departamento_id')->orderBy('numero_cuenta')->get() : Alumno::where('departamento_id',$this->id)->get();
        foreach($alumnos as $alumno){
        $estado = Estado::where('id',$alumno->estado_id)->first();
        if(strcmp($estado->getEstado(),'ACEPTADO') == 0)
            array_push($aux,$alumno->getDatos());
        }
        return $aux;
    }

    public function getAlumnosPendientes($superUsuario = false){
        $aux = array();
        $alumnos = ($superUsuario) ? Alumno::select('*')->orderBy('departamento_id')->orderBy('numero_cuenta')->get() : Alumno::where('departamento_id',$this->id)->get();
        foreach($alumnos as $alumno){
            $estado = Estado::where('id',$alumno->estado_id)->first();
            if(strcmp($estado->getEstado(),'PENDIENTE') == 0)
                array_push($aux,$alumno->getDatos());
        }
        return $aux;
    }

    public function getAlumnosRechazados($superUsuario = false){
        $aux = array();
        $alumnos = ($superUsuario) ? Alumno::select('*')->orderBy('departamento_id')->orderBy('numero_cuenta')->get() : Alumno::where('departamento_id',$this->id)->get();
        foreach($alumnos as $alumno){
            $estado = Estado::where('id',$alumno->estado_id)->first();
            if((strcmp($estado->getEstado(),'RECHAZO') == 0) || (strcmp($estado->getEstado(),'BAJA') == 0))
                array_push($aux,$alumno->getDatos());
        }
        return $aux;
    }
}