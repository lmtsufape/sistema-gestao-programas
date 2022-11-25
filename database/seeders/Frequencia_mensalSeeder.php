<?php

namespace Database\Seeders;

use App\Models\Frequencia_mensal;
use Illuminate\Database\Seeder;

class Frequencia_mensalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $frequencia_mensal = Frequencia_mensal::create([
            'mes' => 'agosto',
            'tempo_total' => 12.3,
            'frequencia' => json_encode(['dia1' => 10, 'dia2' => 12]),
            'id_edital_aluno' => 1
        ]);
    }
}
