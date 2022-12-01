<?php

namespace Database\Seeders;

use App\Models\Programa_servidor;
use Illuminate\Database\Seeder;

class Programa_servidorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $programa_servidor = Programa_servidor::create([
            'id_programa' => 1,
            'id_servidor' => 1
        ]);
    }
}
