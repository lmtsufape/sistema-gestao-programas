<?php

namespace Database\Seeders;

use App\Models\Aluno;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AlunoSeeder extends Seeder
{

    public function run()
    {
        Aluno::create([
            'curso_id' => 1,
            'semestre_entrada' => "2025.2"
        ]);

        Aluno::factory()->count(20)->create();
    }
}
