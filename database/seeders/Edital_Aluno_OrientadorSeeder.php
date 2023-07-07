<?php

namespace Database\Seeders;

use App\Models\Edital_Aluno_Orientadors;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class Edital_Aluno_OrientadorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('edital_aluno_orientadors')->insert([
            [
                'titulo' => 'Edital 1',
                'data_inicio' => '2023-05-01',
                'data_fim' => '2023-05-31',
                'bolsa' => 'Integral',
                'info_complementares' => 'Lorem ipsum dolor sit amet',
                'aluno_id' => 1,
                'edital_id' => 1,
                #'disciplina_id' => 1,
                'orientador_id' => 1,
                'termo_compromisso_aluno' => 'termo_compromisso_aluno.pdf',
                'plano_projeto' => 'plano_projeto.pdf',
                'outros_documentos' => 'outros_documentos',
                'bolsista' => true,

            ],
            [
                'titulo' => 'Edital 2',
                'data_inicio' => '2023-05-01',
                'data_fim' => '2023-05-31',
                'bolsa' => 'Integral',
                'info_complementares' => 'Lorem ipsum dolor sit amet',
                'aluno_id' => 2,
                'edital_id' => 1,
                #'disciplina_id' => 1,
                'orientador_id' => 2,
                'termo_compromisso_aluno' => 'termo_compromisso_aluno.pdf',
                'plano_projeto' => 'plano_projeto.pdf',
                'outros_documentos' => 'outros_documentos',
                'bolsista' => false,
            ],
        ]);
    }
}
