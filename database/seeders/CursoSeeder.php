<?php

namespace Database\Seeders;

use App\Models\Curso;
use Illuminate\Database\Seeder;

class CursoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $curso = Curso::create([
            'nome' => "BCC"
        ]);

        $curso2 = Curso::create([
            'nome' => "Veterinaria"
        ]);
    }
}
