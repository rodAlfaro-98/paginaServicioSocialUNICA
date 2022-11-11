<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DivisionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('division')->insert([ //1
            "nombre" => "División de Ingenierías Civil y Geomática",
            "abreviatura" => "DCyG",
            "titulo_coordinador" => "M. I.",
            "coordinador_servicio_social" => "Claudia Elisa Sánchez Navarro"
        ]);

        DB::table('division')->insert([ //2
            "nombre" => "División de Ingeniería Mecánica e Industrial",
            "abreviatura" => "DIMEI",
            "titulo_coordinador" => "M. I.",
            "coordinador_servicio_social" => "Víctor Manuel Vázquez Huarota"
        ]);

        DB::table('division')->insert([ //3
            "nombre" => "División de Ingeniería Eléctica",
            "abreviatura" => "DIE",
            "titulo_coordinador" => "Lic.",
            "coordinador_servicio_social" => "Angélica Gutiérrez Vázquez"
        ]);

        DB::table('division')->insert([ //4
            "nombre" => "División de Ingeniería en Ciencias de la Tierra",
            "abreviatura" => "DICT",
            "subdivision" => "Carrera de Ingeniería de Minas y Metalurgia",
            "titulo_coordinador" => "Ing.",
            "coordinador_servicio_social" => "Soledad Viridiana"
        ]);

        DB::table('division')->insert([ //5
            "nombre" => "División de Ingeniería en Ciencias de la Tierra",
            "abreviatura" => "DICT",
            "subdivision" => "Carrera de Ingeniería Geológica",
            "titulo_coordinador" => "Ing.",
            "coordinador_servicio_social" => "Isabel Domínguez"
        ]);

        DB::table('division')->insert([ //6
            "nombre" => "División de Ingeniería en Ciencias de la Tierra",
            "abreviatura" => "DICT",
            "subdivision" => "Carrera de Ingeniería Geofísica",
            "titulo_coordinador" => "Ing.",
            "coordinador_servicio_social" => "Thalía Alfonsina Reyes Pimentel"
        ]);

        DB::table('division')->insert([ //7
            "nombre" => "División de Ingeniería en Ciencias de la Tierra",
            "abreviatura" => "DICT",
            "subdivision" => "Carrera de Ingeniería Petrolera",
            "titulo_coordinador" => "M. I.",
            "coordinador_servicio_social" => "Berenice Anell Martínez Cabañas"
        ]);
    }
}
