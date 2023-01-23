<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class JefeDepartamentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('jefe_departamento')->insert([
            'titulo' => 'Ing.',
            'nombres' => 'Prueba',
            'apellido_paterno' => 'Prueba',
            'apellido_materno' => 'Prueba',
            'email' => 'rodrigoalfarod@gmail.com',
            'uid' => 'usuario_prueba',
            'contraseña' => Hash::make('prueba123456789')
        ]);

        DB::table('jefe_departamento')->insert([
            'titulo' => 'Ing.',
            'nombres' => 'Rodrigo',
            'apellido_paterno' => 'Alfaro',
            'apellido_materno' => 'Domínguez',
            'email' => 'rodrigo.alfaro@ingenieria.unam.edu',
            'uid' => 'roalfa98',
            'contraseña' => Hash::make('Th3B3@tl3s123456789')
        ]);
    }
}
