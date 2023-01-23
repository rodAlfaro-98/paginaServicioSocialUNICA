<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

use App\Models\Alumno;

class AlumnoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Alumno 1
        $alumno = new Alumno();
        $alumno->correo = 'rodrigoalfarod_falso@gmail.com';
        $alumno->numero_cuenta = '316355311';
        $alumno->nombres = 'Rodrigo';
        $alumno->apellido_paterno = 'Alfaro';
        $alumno->apellido_materno = 'Domínguez';
        $alumno->curp = 'AADR980715HDFLMD69';
        $alumno->genero = 'H';
        $alumno->telefono_casa = 5520796326;
        $alumno->telefono_celular = 5548967649;
        $alumno->creditos_pagados = 218;
        $alumno->avance_porcentaje = 84.5;
        $alumno->promedio = 92.8;
        $alumno->duracion_servicio = 6;
        $alumno->horas_semana = 20;
        $alumno->hora_inicio = '13:00';
        $alumno->hora_fin = '17:00';
        $alumno->contraseña = Hash::make('alumno123456789');
        $alumno->interno = True;
        $alumno->carrera_id = 9;
        $alumno->departamento_id = 1;
        $alumno->estado_id = 1;
        $alumno->fecha_nacimiento = now();
        $alumno->fecha_ingreso_facultad = now();
        $alumno->fecha_inicio = now();
        $alumno->fecha_fin = Carbon::now()->addMonths(6);
        $alumno->save();

        //Alumno 2
        $alumno = new Alumno();
        $alumno->correo = 'kevin@gmail.com';
        $alumno->numero_cuenta = '316355318';
        $alumno->nombres = 'Kevin';
        $alumno->apellido_paterno = 'López';
        $alumno->apellido_materno = 'González';
        $alumno->curp = 'LOGK10022001HGRLMD01';
        $alumno->genero = 'H';
        $alumno->telefono_casa = 5522239482;
        $alumno->telefono_celular = 5548967939;
        $alumno->creditos_pagados = 210;
        $alumno->avance_porcentaje = 80.5;
        $alumno->promedio = 88.8;
        $alumno->duracion_servicio = 12;
        $alumno->horas_semana = 10;
        $alumno->hora_inicio = '13:00';
        $alumno->hora_fin = '15:00';
        $alumno->contraseña = Hash::make('kevin123456789');
        $alumno->interno = True;
        $alumno->carrera_id = 9;
        $alumno->departamento_id = 1;
        $alumno->estado_id = 3;
        $alumno->fecha_nacimiento = now();
        $alumno->fecha_ingreso_facultad = now();
        $fecha_inicio = Carbon::now()->subMonths(2);
        $alumno->fecha_inicio = $fecha_inicio;
        $alumno->fecha_fin = $fecha_inicio->addMonths(6);
        $alumno->save();

        $nombres = [
            "Sofía",
            "María_José",
            "Valentina",
            "Regina",
            "Camila",
            "Valeria",
            "Ximena",
            "María_Fernanda",
            "Victoria",
            "Renata",
            "Santiago",
            "Mateo",
            "Sebastián",
            "Leonardo",
            "Matías",
            "Emiliano",
            "Daniel",
            "Gael",
            "Miguel Ángel",
            "Diego",
        ];

        $apellidos = [
            "Hernández",
            "García",
            "Martínez",
            "López",
            "González",
            "Pérez",
            "Rodríguez",
            "Sánchez",
            "Ramírez",
            "Cruz",
        ];
        $genero = ['H','M'];

        //Alumnos 3-13
        for($i=0; $i<20; $i++){
            $alumno = new Alumno();
            $nombre_alumno =  $nombres[rand(0,count($nombres)-1)];
            $app_alumno = $apellidos[rand(0,count($apellidos)-1)];
            $apm_alumno = $apellidos[rand(0,count($apellidos)-1)];
            $alumno->correo = $nombre_alumno.'_'.((string) $i).'@gmail.com';
            $alumno->numero_cuenta = '3163353'.((string) $i);
            $alumno->nombres = $nombre_alumno;
            $alumno->apellido_paterno = $app_alumno;
            $alumno->apellido_materno = $apm_alumno;
            $alumno->curp = $app_alumno[0].$app_alumno[0].$apm_alumno[0].$nombre_alumno[0].((string) $i).((string) $i).((string) $i).((string) $i).((string) $i).((string) $i).'01HGRLMD01';
            $alumno->genero = $genero[rand(0,1)];
            $numero = "";
            for($j = 0; $j<10; $j++){
                $numero = $numero.((string) rand(0,9));
            }
            $alumno->telefono_casa = (int) $numero;
            $alumno->telefono_celular = $alumno->telefono_casa +1;
            $alumno->creditos_pagados = rand(210,420);
            $alumno->avance_porcentaje = rand(60,99)+0.5;
            $alumno->promedio = rand(60,99)+0.5;
            $alumno->duracion_servicio = 12;
            $alumno->horas_semana = 10;
            $alumno->hora_inicio = '13:00';
            $alumno->hora_fin = '15:00';
            $alumno->contraseña = Hash::make($nombre_alumno.'123456789');
            $alumno->interno = True;
            $alumno->carrera_id = rand(1,14);
            $alumno->departamento_id = rand(1,5);
            $alumno->estado_id = 1;
            $alumno->fecha_nacimiento = now();
            $alumno->fecha_ingreso_facultad = now();
            $fecha_inicio = Carbon::now()->subMonths(rand(0,5));
            $alumno->fecha_inicio = $fecha_inicio;
            $alumno->fecha_fin = $fecha_inicio->addMonths(6);
            $alumno->save();
        }
    }
}
