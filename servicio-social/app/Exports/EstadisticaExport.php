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

    public function __construct($filtro, $departamento, $dato){
        $this->filtro = $filtro;
        $this->dato = $dato;
        $this->departamento = $departamento;
    }

    public function collection()
    {
        $toReturn = DB::Table('alumno')
            ->join('estado','estado.id', '=', 'alumno.estado_id')
            ->join('departamento','departamento.id', '=', 'alumno.departamento_id')
            ->join('carrera','carrera.id','=','alumno.carrera_id')
            ->select('alumno.nombres','alumno.apellido_paterno','alumno.apellido_materno','alumno.numero_cuenta','alumno.fecha_inicio','alumno.fecha_fin','carrera.clave_carrera','estado.estado','departamento.abreviatura_departamento');
        switch( $this->filtro){
            case "Semestre":
                $toReturn ->where(function (Builder $query){
                    $query->where('alumno.fecha_inicio' ,'>=', $this->dato[0])
                        ->where('alumno.fecha_inicio' ,'<=', $this->dato[1]);
                })->orWhere(function (Builder $query){
                    $query->where('alumno.fecha_fin' ,'>=', $this->dato[0])
                        ->where('alumno.fecha_fin' ,'<=', $this->dato[1]);
                });
                ["2022-08-01","2022-12-01"];
            break;
            case "Genero":
                $toReturn->where('alumno.genero','=',$this->dato);
            break;
            case "Interno":
                $toReturn->where('alumno.interno','=',$this->dato);
            break;
            case "Carrera":
                $toReturn->where('carrera.carrera','=',$this->dato);
            break;
        }
        if($this->departamento !== 'DSA' ){
            $toReturn->where('departamento.abreviatura_departamento','=',$this->departamento);
        }
        return $toReturn->get();
    }

    public function headings(): array{
        return ['Nombre','Apellido Paterno','Apellido Materno','Fehca de inicio','Fecha de término','Clave de la carrera','Estado del alumno','Departamento'];
    }
}
