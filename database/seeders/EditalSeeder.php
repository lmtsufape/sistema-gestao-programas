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
            'nome' => 'Edital PAVI',
            'descricao' => 'Morte instantanea',
            'semestre' => '2023.1',
            'programa_id' => 1,
            'curso_id' => 1,
            'data_inicio' =>"2022-11-17",
            'data_fim' =>"2024-11-18"
        ]);
    }
}
