<?php

namespace Database\Seeders;

use App\Models\Disciplina;
use Illuminate\Database\Seeder;

class DisciplinaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $disciplina0 = Disciplina::create([
        //     'nome' => "Não tem disciplina",
        //     'curso_id' => 1,

        // ]);
        $disciplina = Disciplina::create([
            'nome' => "Programação orientada a objetos",
            'curso_id' => 1,

        ]);

        $disciplina2 = Disciplina::create([
            'nome' => "Calculo 1",
            'curso_id' => 1,
        ]);

        $disciplina3 = Disciplina::create([
            'nome' => "Sistemas Operacionas",
            'curso_id' => 1,
        ]);

        $disciplina4 = Disciplina::create([
            'nome' => "Engenharia de software",
            'curso_id' => 1,
        ]);

        $disciplina5 = Disciplina::create([
            'nome' => "Paradigmas de linguagem de programação",
            'curso_id' => 1,
        ]);

        $disciplina6 = Disciplina::create([
            'nome' => "Calculo 1",
            'curso_id' => 2,
        ]);

        $disciplina7 = Disciplina::create([
            'nome' => "Estágio",
            'curso_id' => 1,
        ]);

        $disciplina8 = Disciplina::create([
            'nome' => "Estágio",
            'curso_id' => 2,
        ]);
    }
}
