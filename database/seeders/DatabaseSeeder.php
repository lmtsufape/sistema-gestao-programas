<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            PermissionsSeeder::class,
            OrientadorsSeeder::class,
            Tipo_servidorSeeder::class,
            ServidorSeeder::class,
            ProgramasSeeder::class,
            CursoSeeder::class,
            DisciplinaSeeder::class,
            AlunosSeeder::class,
            Programa_servidorSeeder::class,
            Curso_disciplinaSeeder::class,
            EditalSeeder::class,
            Edital_alunoSeeder::class,
            Edital_orientadorSeeder::class,
            Frequencia_mensalSeeder::class
        ]);
    }
}
