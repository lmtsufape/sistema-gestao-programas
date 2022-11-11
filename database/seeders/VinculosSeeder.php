<?php

namespace Database\Seeders;

use App\Models\Vinculo;
use Illuminate\Database\Seeder;

class VinculosSeeder extends Seeder
{
    public function run()
    {

        Vinculo::create([
            'status' => 'CANCELADA',
            'bolsa' => 'REMUNERADA',
            'programa' => 'PAVI',
            'valor_bolsa' => 800,
            'curso' => 'BCC',
            'semestre' => '2021.1',
            'data_inicio' => "2021-02-10",
            'data_fim' => '2021-08-10',
            'aluno_id' => 4,
            'professor_id' => 1
        ]);
        Vinculo::create([
            'status' => 'ANDAMENTO',
            'bolsa' => 'REMUNERADA',
            'valor_bolsa' => 350,
            'programa' => 'TUTORIA',
            'disciplina' => 'Lógica matemática',
            'curso' => 'BCC',
            'semestre' => '2022.2',
            'data_inicio' => "2022-08-17",
            'data_fim' => '2022-11-17',
            'aluno_id' => 1,
            'professor_id' => 2
        ]);

        Vinculo::create([
            'status' => 'CONCLUIDA',
            'bolsa' => 'VOLUNTARIA',
            'programa' => 'MONITORIA',
            'disciplina' => 'POO',
            'curso' => 'BCC',
            'semestre' => '2020.2',
            'data_inicio' => "2020-08-17",
            'data_fim' => '2020-11-17',
            'aluno_id' => 2,
            'professor_id' => 3
        ]);

        Vinculo::create([
            'status' => 'ANDAMENTO',
            'bolsa' => 'REMUNERADA',
            'programa' => 'BIA',
            'valor_bolsa' => 500,
            'curso' => 'BCC',
            'semestre' => '2022.2',
            'data_inicio' => "2022-08-17",
            'data_fim' => '2022-11-17',
            'aluno_id' => 3,
            'professor_id' => 5
        ]);
    }
}
