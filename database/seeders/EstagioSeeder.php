<?php

namespace Database\Seeders;

use App\Models\Estagio;
use Illuminate\Database\Seeder;

class EstagioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $estagio1 = Estagio::create([
            'descricao' => "Estágio1",
            'data_inicio' => "2023-06-21",
            'data_fim' => "2024-06-21",
            //'data_solicitacao' => "2023-05-21",
            //'cpf_aluno' => "348.126.240-02",
            'tipo' => "eo",
            'status' => true,
            'aluno_id' => 1,
            'orientador_id' => 1,
            'curso_id' => 1,
            'disciplina_id' => 7,
            'supervisor' => "João da Silva; 87 9 8123-4567;",
            'instituicao_id' => 1
        ]);

        $estagio2 = Estagio::create([
            'descricao' => "Estágio 2",
            'data_inicio' => "2023-08-30",
            'data_fim' => "2024-06-21",
            //'data_solicitacao' => "2023-05-21",
            //'cpf_aluno' => "348.126.240-02",
            'tipo' => "eo",
            'status' => true,
            'aluno_id' => 2,
            'orientador_id' => 1,
            'curso_id' => 1,
            'disciplina_id' => 7,
            'supervisor' => "Maria da Silva; 87 9 8123-4567;",
        ]);

        /*$estagio2 = Estagio::create([
            'descricao' => "Estágio2",
            'data_inicio' => "2023-07-10",
            'data_fim' => "2024-07-10",
            //'data_solicitacao' => "2023-06-10",
            'cpf_aluno' => "476.051.020-62",
            'tipo' => "eno",
            'status' => true,
            //'aluno_id' => 2,
            'orientador_id' => 2,
            'curso_id' => 2
        ]);*/
    }
}
