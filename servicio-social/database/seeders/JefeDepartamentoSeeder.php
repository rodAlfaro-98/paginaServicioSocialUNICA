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
        DB::table('jefe_departamento')->insert([ //1
            'titulo' => 'Ing.',
            'nombres' => 'Prueba',
            'apellido_paterno' => 'Prueba',
            'apellido_materno' => 'Prueba',
            'email' => 'rodrigoalfarod@gmail.com',
            'uid' => 'usuario_prueba',
            'contraseña' => Hash::make('prueba123456789')
        ]);

        DB::table('jefe_departamento')->insert([ //2
            'titulo' => 'Ing.',
            'nombres' => 'Rodrigo',
            'apellido_paterno' => 'Alfaro',
            'apellido_materno' => 'Domínguez',
            'email' => 'rodrigo.alfaro@ingenieria.unam.edu',
            'uid' => 'roalfa98',
            'contraseña' => Hash::make('Th3B3@tl3s123456789')
        ]);

        DB::table('jefe_departamento')->insert([ //3
            'titulo' => 'Ing.',
            'nombres' => 'Prueba2',
            'apellido_paterno' => 'Prueba2',
            'apellido_materno' => 'Prueba2',
            'email' => 'prueba2@gmail.com',
            'uid' => 'usuario_prueba2',
            'contraseña' => Hash::make('prueba123456789')
        ]);

        DB::table('jefe_departamento')->insert([ //4
            'titulo' => 'Ing.',
            'nombres' => 'Prueba3',
            'apellido_paterno' => 'Prueba3',
            'apellido_materno' => 'Prueba3',
            'email' => 'prueba2@gmail.com',
            'uid' => 'usuario_prueba3',
            'contraseña' => Hash::make('prueba123456789')
        ]);

        DB::table('jefe_departamento')->insert([ //5
            'titulo' => 'Ing.',
            'nombres' => 'Prueba4',
            'apellido_paterno' => 'Prueba4',
            'apellido_materno' => 'Prueba4',
            'email' => 'prueba2@gmail.com',
            'uid' => 'usuario_prueba4',
            'contraseña' => Hash::make('prueba123456789')
        ]);
    }
}
