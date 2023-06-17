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
            'nome' => "Bacharelado em Agronomia"
        ]);

        $curso2 = Curso::create([
            'nome' => "Bacharelado em Ciência da computação"
        ]);

        $curso3 = Curso::create([
            'nome' => "Bacharelado em Engenharia de Alimentos"
        ]);

        $curso4 = Curso::create([
            'nome' => "Bacharelado em Medicina Veterinária"
        ]);

        $curso5 = Curso::create([
            'nome' => "Bacharelado em Zootecnia"
        ]);

        $curso6 = Curso::create([
            'nome' => "Licenciatura em Letras"
        ]);

        $curso7 = Curso::create([
            'nome' => "Licenciatura em Pedagogia"
        ]);

        $curso8 = Curso::create([
            'nome' => "Outro Curso"
        ]);
    }
}
