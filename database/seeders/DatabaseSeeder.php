<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            PermissionsSeeder::class,
            CursoSeeder::class,
            AlunosSeeder::class,
            OrientadorsSeeder::class,
            ServidorsSeeder::class,
            ProgramasSeeder::class,
            DisciplinaSeeder::class,
            Programa_servidorsSeeder::class,
            EditalSeeder::class,
            Edital_AlunoSeeder::class,
            Edital_disciplinaSeeder::class
        ]);
    }
}
