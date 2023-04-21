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
            'edital_id' => 1,
            'disciplina_id' => 5
        ]);
    }
}
