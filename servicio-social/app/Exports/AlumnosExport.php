<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use App\Models\Alumno;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AlumnosExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public function __construct($estado, $departamento){
        $this->estado = $estado;
        $this->departamento = $departamento;
    }

    public function collection()
    {
        $toReturn = DB::Table('alumno')
                ->join('estado','estado.id', '=', 'alumno.estado_id')
                ->join('departamento','departamento.id', '=', 'alumno.departamento_id')
                ->join('carrera','carrera.id','=','alumno.carrera_id')
                ->select('alumno.nombres','alumno.apellido_paterno','alumno.apellido_materno','alumno.numero_cuenta','alumno.fecha_inicio','alumno.fecha_fin','carrera.clave_carrera','estado.estado','departamento.departamento')
                ->where('estado.estado','=',$this->estado);
        if($this->departamento !== 'DSA' ){
            $toReturn->where('departamento.departamento','=',$this->departamento);
        }
        return $toReturn->get();
    }

    public function headings(): array{
        return ['Nombre','Apellido Paterno','Apellido Materno','Fehca de inicio','Fecha de término','Clave de la carrera','Estado del alumno','Departamento'];
    }
}
