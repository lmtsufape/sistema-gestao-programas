<?php

namespace Database\Seeders;

use App\Models\Relatorio;
use Illuminate\Database\Seeder;

class RelatorioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $relatorio = Relatorio::create([
            'status' => 'pendente',
            'observacao' => 'observacao',
            'tipo' => 'tipo',
            'relatorio' => 'relatorio',
            'edital_aluno_orientadors_id' => 1,
        ]);

    }
}
