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
            'tipo' => 'Programa',
            'valor_bolsa' => 'R$ 400,00',
        ]);

        $programa1 = Programa::create([
            'nome' => "Monitoria",
            'descricao' => 'Projeto Monitoria',
            'tipo' => 'Monitoria',
            'valor_bolsa' => 'R$ 500,00',
        ]);

        $programa2 = Programa::create([
            'nome' => "Tutoria",
            'descricao' => 'Projeto Tutoria',
            'tipo' => 'Tutoria',
            'valor_bolsa' => 'R$ 600,00',
        ]);

        $programa3 = Programa::create([
            'nome' => "BIA",
            'descricao' => 'Projeto BIA',
            'tipo' => 'BIA',
            'valor_bolsa' => 'R$ 700,00',
        ]);

        $programa4 = Programa::create([
            'nome' => "PETI",
            'descricao' => 'Projeto PETI',
            'tipo' => 'PETI',
            'valor_bolsa' => 'R$ 800,00',
        ]);
    }
}
