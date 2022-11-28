<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(DivisionSeeder::class);
        $this->call(CarreraSeeder::class);
        $this->call(JefeDepartamentoSeeder::class);
        $this->call(DepartamentoSeeder::class);
        $this->call(EstadoSeeder::class);
        $this->call(AlumnoSeeder::class);
        $this->call(HistoricoEstadoSeeder::class);
    }
}
