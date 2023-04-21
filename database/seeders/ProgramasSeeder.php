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
        ]);

        $programa1 = Programa::create([
            'nome' => "Monitoria",
            'descricao' => 'Projeto Monitoria',
            'tipo' => 'Monitoria',
        ]);

        $programa2 = Programa::create([
            'nome' => "Tutoria",
            'descricao' => 'Projeto Tutoria',
            'tipo' => 'Tutoria',
        ]);

        $programa3 = Programa::create([
            'nome' => "BIA",
            'descricao' => 'Projeto BIA',
            'tipo' => 'BIA',
        ]);

        $programa4 = Programa::create([
            'nome' => "PETI",
            'descricao' => 'Projeto PETI',
            'tipo' => 'PETI',
        ]);
    }
}
