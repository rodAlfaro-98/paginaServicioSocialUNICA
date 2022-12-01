<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class AlumnoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('alumno')->insert([
            'id' => 1,
            'correo' => 'rodrigoalfarod@gmail.com',
            'numero_cuenta' => '316355311',
            'nombres' => 'Rodrigo',
            'apellido_paterno' => 'Alfaro',
            'apellido_materno' => 'Domínguez',
            'curp' => 'AADR980715HDFLMD69',
            'genero' => 'H',
            'telefono_casa' => 5520796326,
            'telefono_celular' => 5548967649,
            'creditos_pagados' => 218,
            'avance_porcentaje' => 84.5,
            'promedio' => 92.8,
            'duracion_servicio' => 6,
            'horas_semana' => 20,
            'hora_inicio' => '13:00',
            'hora_fin' => '17:00',
            'contraseña' => Hash::make('alumno123456789'),
            'interno' => True,
            'carrera_id' => 9,
            'departamento_id' => 1,
            'estado_id' => 1,
            'fecha_nacimiento' => now(),
            'fecha_ingreso_facultad' => now(),
            'fecha_inicio' => now(),
            'fecha_fin' => Carbon::now()->addMonths(6)
        ]);

        DB::table('alumno')->insert([
            'id' => 2,
            'correo' => 'kevin@gmail.com',
            'numero_cuenta' => '316355318',
            'nombres' => 'Kevin',
            'apellido_paterno' => 'López',
            'apellido_materno' => 'González',
            'curp' => 'LOGK10022001HGRLMD01',
            'genero' => 'H',
            'telefono_casa' => 5522239482,
            'telefono_celular' => 5548967939,
            'creditos_pagados' => 210,
            'avance_porcentaje' => 80.5,
            'promedio' => 88.8,
            'duracion_servicio' => 12,
            'horas_semana' => 10,
            'hora_inicio' => '13:00',
            'hora_fin' => '15:00',
            'contraseña' => Hash::make('kevin123456789'),
            'interno' => True,
            'carrera_id' => 9,
            'departamento_id' => 1,
            'estado_id' => 3,
            'fecha_nacimiento' => now(),
            'fecha_ingreso_facultad' => now(),
            'fecha_inicio' => now(),
            'fecha_fin' => Carbon::now()->addMonths(6)
        ]);
    }
}
