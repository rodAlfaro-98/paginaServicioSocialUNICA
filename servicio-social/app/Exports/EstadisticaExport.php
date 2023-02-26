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
        $datos = [];
        $toReturn = DB::Table('alumno')
            ->join('estado','estado.id', '=', 'alumno.estado_id')
            ->join('departamento','departamento.id', '=', 'alumno.departamento_id')
            ->join('carrera','carrera.id','=','alumno.carrera_id')
            ->select('alumno.nombres','alumno.apellido_paterno','alumno.apellido_materno','alumno.numero_cuenta','alumno.fecha_inicio','alumno.fecha_fin','carrera.clave_carrera','estado.estado','departamento.abreviatura_departamento');
        foreach($this->datos as $llave => $valor){
            print_r($llave.",");
            if($valor !== Null)
            switch($llave){
                case "fecha_inicio":
                    array_push($datos, $this->datos["fecha_inicio"],$this->datos["fecha_fin"]);
                    //Retorna todo
                    $toReturn->where(function($query){
                        $query->whereBetween('alumno.fecha_inicio', [$this->datos["fecha_inicio"],$this->datos["fecha_fin"]])
                            ->orWhereBetween('alumno.fecha_fin', [$this->datos["fecha_inicio"],$this->datos["fecha_fin"]]);
                    });

                        //Retorna todo
                        /*$toReturn->where(function ($query){
                            $query->where('alumno.fecha_inicio' ,'>=', $this->datos["fecha_inicio"])
                                ->where('alumno.fecha_inicio' ,'<=', $this->datos["fecha_fin"]);
                        })->orWhere(function ($query){
                            $query->where('alumno.fecha_fin' ,'>=', $this->datos["fecha_inicio"])
                                ->where('alumno.fecha_fin' ,'<=', $this->datos["fecha_fin"]);
                        });*/
                case "genero":
                    array_push($datos, $valor);
                    $toReturn->where('alumno.genero','=',$valor);
                break;
                case "interno":
                    array_push($datos, $valor);
                    $toReturn->where('alumno.interno','=',$valor);
                break;
                case "carrera":
                    array_push($datos, $valor);
                    $toReturn->where('carrera.carrera','=',$valor);
                break;
                case "estado":
                    array_push($datos, $valor);
                    $toReturn->where('estado.estado','=',$valor);
                break;
            }
        }
        if($this->departamento !== 'DSA' ){
            $toReturn = $toReturn->where('departamento.abreviatura_departamento','=',$this->departamento);
        }
        print_r($toReturn->toSql());
        print_r($datos);
        //return $toReturn->get();
    }

    public function headings(): array{
        return ['Nombre','Apellido Paterno','Apellido Materno','Fehca de inicio','Fecha de término','Clave de la carrera','Estado del alumno','Departamento'];
    }
}
