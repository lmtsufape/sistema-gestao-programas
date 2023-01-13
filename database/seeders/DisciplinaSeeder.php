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
        $disciplina = Disciplina::create([
            'nome' => "Programação orientada a objetos"
        ]);

        $disciplina2 = Disciplina::create([
            'nome' => "Calculo 1"
        ]);

        $disciplina3 = Disciplina::create([
            'nome' => "Sistemas Operacionas"
        ]);

        $disciplina4 = Disciplina::create([
            'nome' => "Engenharia de software"
        ]);

        $disciplina5 = Disciplina::create([
            'nome' => "Paradigmas de linguagem de programação"
        ]);
    }
}
