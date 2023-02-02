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
            'id_programa' => 1,
            'data_inicio' =>"2022-11-17",
            'data_fim' =>"2024-11-18"
        ]);
    }
}
