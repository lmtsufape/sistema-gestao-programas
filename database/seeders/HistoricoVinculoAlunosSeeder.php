<?php

namespace Database\Seeders;

use App\Models\HistoricoVinculoAlunos;
use Illuminate\Database\Seeder;

class HistoricoVinculoAlunosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $historico_vinculo1 = HistoricoVinculoAlunos::create([
            'vinculo_id' => 1,
            'data_inicio' => '2023-05-15',
            'data_fim' => null,
        ]);

        $historico_vinculo2 = HistoricoVinculoAlunos::create([
            'vinculo_id' => 2,
            'data_inicio' => '2023-05-16',
            'data_fim' => null,
        ]);

    }
}
