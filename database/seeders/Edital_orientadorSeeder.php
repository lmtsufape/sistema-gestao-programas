<?php

namespace Database\Seeders;

use App\Models\Edital_orientador;
use Illuminate\Database\Seeder;

class Edital_orientadorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $edital_orientador = Edital_orientador::create([
            'id_edital' => 1,
            'id_orientador' => 1
        ]);
    }
}
