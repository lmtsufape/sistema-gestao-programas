<?php

namespace Database\Seeders;

use App\Models\Edital_aluno;
use Illuminate\Database\Seeder;

class Edital_alunoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $edital_aluno = Edital_aluno::create([
            'id_edital' => 1,
            'id_aluno' => 1,
            'bolsa' => "PAVI",
            'valor_bolsa' => "500"
        ]);
    }
}
