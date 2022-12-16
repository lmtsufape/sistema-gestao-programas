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
            'nome' => "PAVI"
        ]);

        $programa1 = Programa::create([
            'nome' => "Monitoria"
        ]);

        $programa2 = Programa::create([
            'nome' => "Tutoria"
        ]);

        $programa3 = Programa::create([
            'nome' => "BIA"
        ]);

        $programa4 = Programa::create([
            'nome' => "PETI"
        ]);
    }
}
