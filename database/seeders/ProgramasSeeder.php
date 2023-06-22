<?php

namespace Database\Seeders;

use App\Models\Programa;
use Illuminate\Database\Seeder;

class ProgramasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $programa = Programa::create([
            'nome' => "PAVI",
            'descricao' => 'Projeto PAVI',
            'data_inicio' =>"2023-06-21",
            'data_fim' =>"2024-06-21"
        ]);

        $programa1 = Programa::create([
            'nome' => "Monitoria",
            'descricao' => 'Projeto Monitoria',
            'data_inicio' =>"2023-06-21",
            'data_fim' =>"2024-06-21"
        ]);

        $programa2 = Programa::create([
            'nome' => "Tutoria",
            'descricao' => 'Projeto Tutoria',
            'data_inicio' =>"2023-06-21",
            'data_fim' =>"2024-06-21"
        ]);

        $programa3 = Programa::create([
            'nome' => "BIA",
            'descricao' => 'Projeto BIA',
            'data_inicio' =>"2023-06-21",
            'data_fim' =>"2024-06-21"
        ]);

        $programa4 = Programa::create([
            'nome' => "PETI",
            'descricao' => 'Projeto PETI',
            'data_inicio' =>"2023-06-21",
            'data_fim' =>"2024-06-21"
        ]);
    }
}
