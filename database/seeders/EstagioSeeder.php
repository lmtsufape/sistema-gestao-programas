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
            'data_solicitacao' => "2023-05-21",
            'tipo_estagio' => "eo",
            'status' => true,
            'aluno_id' => 1,
            'orientador_id' => 1
            //'disciplina_id' => 1 //ainda falta fazer a relação com disciplina.
        ]);

        $estagio2 = Estagio::create([
            'descricao' => "Estágio2",
            'data_inicio' => "2023-07-10",
            'data_fim' => "2024-07-10",
            'data_solicitacao' => "2023-06-10",
            'tipo_estagio' => "eno",
            'status' => true,
            'aluno_id' => 2,
            'orientador_id' => 2
        ]);

        $estagio3 = Estagio::create([
            'descricao' => "Estágio3",
            'data_inicio' => "2023-08-15",
            'data_fim' => "2024-08-15",
            'data_solicitacao' => "2023-07-15",
            'tipo_estagio' => "eo",
            'status' => true,
            'aluno_id' => 1,
            'orientador_id' => 1
        ]);

        $estagio4 = Estagio::create([
            'descricao' => "Estágio4",
            'data_inicio' => "2023-09-01",
            'data_fim' => "2024-09-01",
            'data_solicitacao' => "2023-08-01",
            'tipo_estagio' => "eno",
            'status' => true,
            'aluno_id' => 2,
            'orientador_id' => 2
        ]);
    }
}
