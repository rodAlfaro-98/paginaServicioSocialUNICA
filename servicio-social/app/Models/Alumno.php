<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Alumno extends Model{

    protected $table = 'alumno';

    protected $fillable = [
        'id','correo','numero_cuenta','nombres','apellido_paterno','apellido_materno',
        'fecha_nacimiento','curp','genero','telefono_casa','telefono_celular',
        'creditos_pagados','avance_porcentaje','promedio','fecha_ingreso_facultad',
        'duracion_servicio','horas_semana','hora_inicio','hora_fin','fecha_inicio',
        'fecha_fin','contraseña','interno','carrera_id','departamento_id','estado_id'
    ];

    public function getNombre(){
        return "".$this->nombres." ".$this->apellido_paterno." ".$this->apellido_materno;
    }

    public function getNombreApellidos(){
        return "".$this->apellido_paterno." ".$this->apellido_materno." ".$this->nombres;
    }

    public function getCorreo(){
        return $this->correo;
    }

    public function getCarrera(){
        return Carrera::where('id',$this->carrera_id)->first();
    }

    public function getDepartamento(){
        return Departamento::where('id',$this->departamento_id)->first();
    }

    public function getEstado(){
        return Estado::where('id',$this->estado_id)->first();
    }

    public function getFechaInicio(){
        return $this->fecha_inicio;
    }

    public function getFechaFin(){
        return $this->fecha_fin;
    }

    public function getNumCuenta(){
        return $this->numero_cuenta;
    }

    public function getCredenciales(){
        return array('numero_cuenta' => $this->numero_cuenta,'contraseña' => $this->contraseña);
    }

    public function getDatos(){
        $carrera = $this->getCarrera();
        $departamento = $this->getDepartamento();
        $estado = $this->getEstado();
        return (object) array('numero_cuenta' => $this->numero_cuenta,'nombres' => $this->getNombreApellidos(),
            'fecha_inicio' => $this->fecha_inicio,'fecha_fin'=>$this->fecha_fin,
            'duracion_servicio' => $this->duracion_servicio, 'clave_carrera' => $carrera->clave_carrera,
            'departamento' => $departamento->departamento, 'estado' => $estado->estado);
    }

}