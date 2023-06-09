<?php

namespace Database\Seeders;

use App\Models\Edital;
use Illuminate\Database\Seeder;

class EditalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $edital = Edital::create([
            'descricao' => 'Edital de seleção de bolsistas para o Programa de Apoio à Vivência Interdisciplinar (PAVI), para o semestre 2023.1. Essa é uma descrição teste.',
            'semestre' => '2023.1',
            'programa_id' => 1,
            #'disciplina_id' => 1,
            'titulo_edital' => 'Edital PAVI',
            'data_inicio' =>"2022-11-17",
            'data_fim' =>"2024-11-18",
            'valor_bolsa' => '400',
        ]);
    }
}
