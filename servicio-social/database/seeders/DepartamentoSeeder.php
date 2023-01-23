<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartamentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('departamento')->insert([
            'departamento' => 'Departamento de Servicios Académicos',
            'abreviatura_departamento' => 'DSA',
            'jefe_departamento_id' => 2,
        ]);

        DB::table('departamento')->insert([
            'departamento' => 'Departamento de Investigación y Desarrollo',
            'abreviatura_departamento' => 'DID',
            'jefe_departamento_id' => 1,
        ]);

        DB::table('departamento')->insert([
            'departamento' => 'Departamento de Seguridad en Cómputo',
            'abreviatura_departamento' => 'DSC',
            'jefe_departamento_id' => 1,
        ]);

        DB::table('departamento')->insert([
            'departamento' => 'Departamento de Redes y Operación de Servidores',
            'abreviatura_departamento' => 'DROS',
            'jefe_departamento_id' => 1,
        ]);

        DB::table('departamento')->insert([
            'departamento' => 'Salas',
            'abreviatura_departamento' => 'Salas',
            'jefe_departamento_id' => 1,
        ]);
    }
}
