<?php

namespace Database\Seeders;

use App\Models\Edital_Aluno;
use Illuminate\Database\Seeder;

class Edital_AlunoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $edital_aluno = Edital_Aluno::create(
            [
                'nome_aluno' => "Victor Francisco",
                'titulo_edital' => 'Edital PAVI',
                'data_inicio' =>"2022-11-17",
                'data_fim' =>"2024-11-18",
                'valor_bolsa' => '400.00',
                'bolsa' => 'extensao',
                'info_complementares' => 'estensao',
                'aluno_id' => 1,
                'edital_id' => 1,
                'disciplina_id' => 1,
            ]);
    }
}
