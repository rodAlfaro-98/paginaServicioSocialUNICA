<?php

namespace App\Exports;

use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;
use App\Models\Alumno;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class EstadisticaExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public function __construct($filtro, $departamento, $datos){
        $this->filtro = $filtro;
        $this->datos = $datos;
        $this->departamento = $departamento;
    }

    public function collection()
    {
        $table = DB::table('alumno')
            ->join('carrera','alumno.carrera_id','=','carrera.id')
            ->join('departamento','alumno.departamento_id','=','departamento.id')
            ->join('estado','estado.id','=','alumno.estado_id')
            ->select('alumno.nombres','alumno.apellido_paterno','alumno.apellido_materno','alumno.numero_cuenta','alumno.fecha_inicio','alumno.fecha_fin','carrera.clave_carrera','estado.estado','departamento.abreviatura_departamento','alumno.becario_unica')
            ->where(function (Builder $query){
                if($this->datos['fecha_inicio'] != Null)
                    $query->whereBetween('alumno.fecha_inicio',[date($this->datos['fecha_inicio']),date($this->datos['fecha_fin'])])
                        ->orWhereBetween('alumno.fecha_fin',[date($this->datos['fecha_inicio']),date($this->datos['fecha_fin'])]);

            });
        if($this->datos['genero'] != Null)
            $table->where('alumno.genero','=',$this->datos['genero']);
        if($this->datos['interno'] != Null)
            $table->where('alumno.interno','=',$this->datos['interno']);
        if($this->datos['carrera'] != Null)
            $table->where('carrera.carrera','=',$this->datos['carrera']);
        if($this->datos['estado'] != Null)
            $table->where('estado.estado','=',$this->datos['estado']);
        if($this->datos['becario'] != Null)
            $table->where('alumno.becario_unica','=',$this->datos['becario']);
        return $table->get();
    }

    public function headings(): array{
        return ['Nombre','Apellido Paterno','Apellido Materno','Número de cuenta','Fehca de inicio','Fecha de término','Clave de la carrera','Estado del alumno','Departamento','Es becario'];
    }
}
