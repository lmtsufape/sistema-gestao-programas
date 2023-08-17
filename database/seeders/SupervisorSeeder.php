<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Supervisor;

class SupervisorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Supervisor::create([
            'nome' => 'Maria da Silva',
            'cpf' => '865.505.090-33',
            'email' => 'supervisor1@gmail.com',
            'telefone' => '(11) 1234-5678',
            'formacao' => 'Licenciatura em Matemática',
        ]);

        Supervisor::create([
            'nome' => 'João da Silva',
            'cpf' => '643.571.500-94',
            'email' => 'supervisor2@gmail.com',
            'telefone' => '(22) 9876-5432',
            'formacao' => 'Sem formação',
        ]);
    }
}
