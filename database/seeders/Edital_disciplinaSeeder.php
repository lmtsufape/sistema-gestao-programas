<?php

namespace Database\Seeders;

use App\Models\Edital_disciplina;
use Illuminate\Database\Seeder;

class Edital_disciplinaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $edital_disciplina = Edital_disciplina::create([
            'id_edital' => 1,
            'id_disciplina' => 5
        ]);
    }
}
