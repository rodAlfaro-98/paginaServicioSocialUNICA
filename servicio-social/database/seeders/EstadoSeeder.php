<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class EstadoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('estado')->insert([ //1
            'estado' => 'ACEPTADO',
            'fecha_estado' => now(),
        ]);

        DB::table('estado')->insert([ //2
            'estado' => 'RECHAZADO',
            'fecha_estado' => now(),
        ]);

        DB::table('estado')->insert([ //3
            'estado' => 'PENDIENTE',
            'fecha_estado' => now(),
        ]);
    }
}
