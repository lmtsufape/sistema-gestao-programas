<?php

namespace Database\Seeders;

use App\Models\Edital_Aluno;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class Edital_AlunoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('edital_alunos')->insert([
            [
                'nome_aluno' => 'João',
                'titulo_edital' => 'Edital 1',
                'data_inicio' => '2023-05-01',
                'data_fim' => '2023-05-31',
                'valor_bolsa' => 1000.00,
                'bolsa' => 'Integral',
                'info_complementares' => 'Lorem ipsum dolor sit amet',
                'aluno_id' => 1,
                'edital_id' => 1,
                'disciplina_id' => 1,
            ],
            [
                'nome_aluno' => 'Maria',
                'titulo_edital' => 'Edital 1',
                'data_inicio' => '2023-05-01',
                'data_fim' => '2023-05-31',
                'valor_bolsa' => 1000.00,
                'bolsa' => 'Integral',
                'info_complementares' => 'Lorem ipsum dolor sit amet',
                'aluno_id' => 2,
                'edital_id' => 1,
                'disciplina_id' => 1,
            ],
        ]);
    }
}
