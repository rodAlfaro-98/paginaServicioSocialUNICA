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
            'departamento' => 'prueba',
            'abreviatura_departamento' => 'DP',
            'jefe_departamento_id' => 1,
        ]);
    }
}
