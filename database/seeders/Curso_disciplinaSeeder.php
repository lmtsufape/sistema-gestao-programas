<?php

namespace Database\Seeders;

use App\Models\Curso_disciplina;
use Illuminate\Database\Seeder;

class Curso_disciplinaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $curso_disciplina = Curso_disciplina::create([
            'id_curso' => 1,
            'id_disciplina' => 1
        ]);
    }
}
