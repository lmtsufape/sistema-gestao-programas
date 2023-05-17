<?php

namespace Database\Seeders;

use App\Models\Programa_servidor;
use Illuminate\Database\Seeder;

class Programa_servidorsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $programa_servidor = Programa_servidor::create([
            'programa_id' => 1,
            'servidor_id' => 1
        ]);

        $programa_servidor2 = Programa_servidor::create([
            'programa_id' => 2,
            'servidor_id' => 1
        ]);

        $programa_servidor3 = Programa_servidor::create([
            'programa_id' => 3,
            'servidor_id' => 2
        ]);

        $programa_servidor4 = Programa_servidor::create([
            'programa_id' => 4,
            'servidor_id' => 3,
        ]);

        $programa_servidor5 = Programa_servidor::create([
            'programa_id' => 5,
            'servidor_id' => 3,
        ]);
    }
}
