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
    }
}
