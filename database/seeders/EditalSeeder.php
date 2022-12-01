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
            'id_curso' => 1,
            'id_programa' => 1,
            'data_inicio' =>"2022-11-17 12:00:00",
            'data_fim' =>"2024-11-18 12:00:00",
            'semestre' =>"2022.1"
        ]);    
    }
}
