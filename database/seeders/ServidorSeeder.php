<?php

namespace Database\Seeders;

use App\Models\Servidor;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class ServidorSeeder extends Seeder
{

    public function run()
    {
        Servidor::create([
            'cpf' => "770.934.340-61",
            'instituicaoVinculo' => 'UPE',
            'matricula' => 123456,
            'tipo_servidor' => 'administrador'
        ]);


       Servidor::create([
            'cpf' => "999.053.520-27",
            'instituicaoVinculo' => 'UPE',
            'matricula' => 223456,
            'tipo_servidor' => 'tecnico_programas',
        ]);


        Servidor::create([
            'cpf' => "934.053.520-27",
            'instituicaoVinculo' => 'UPE',
            'matricula' => 543456,
            'tipo_servidor' => 'coordenador_programas',
        ]);


        Servidor::create([
            'cpf' => "777.053.520-27",
            'instituicaoVinculo' => 'UPE',
            'matricula' => 345567,
            'tipo_servidor' => 'tecnico_estagios',
        ]);


        Servidor::create([
            'cpf' => "345.345.525-27",
            'instituicaoVinculo' => 'UPE',
            'matricula' => 445656,
            'tipo_servidor' => 'coordenador_estagios',
        ]);


        Servidor::create([
            'cpf' => "339.292.350-80",
            'instituicaoVinculo' => 'UPE',
            'matricula' => 323456,
            'tipo_servidor' => 'pro-reitor'
        ]);


        Servidor::create([
            'cpf' => "961.091.750-05",
            'instituicaoVinculo' => 'UPE',
            'matricula' => 372456,
            'tipo_servidor' => 'diretor'
        ]);
    }
}
