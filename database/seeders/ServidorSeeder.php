<?php

namespace Database\Seeders;

use App\Models\Servidor;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class ServidorSeeder extends Seeder
{

    public function run()
    {
        $admin = Servidor::create([
            'cpf' => "770.934.340-61",
            'instituicaoVinculo' => 'UPE',
            'matricula' => 123456,
            'tipo_servidor' => 'administrador'
        ]);

        $admin->user()->create([
            'name' => "Admin",
            'cpf' => "770.934.340-61",
            'email' => "admin@gmail.com",
            'password' => Hash::make('password')
        ])->assignRole('administrador');

        $tecnico_programas = Servidor::create([
            'cpf' => "999.053.520-27",
            'instituicaoVinculo' => 'UPE',
            'matricula' => 223456,
            'tipo_servidor' => 'tecnico_programas',
        ]);

        $tecnico_programas->user()->create([
            'name' => "Tecnico Programas",
            'cpf' => "999.053.520-27",
            'email' => "tecnico_programas@gmail.com",
            'password' => Hash::make('password')
        ])->assignRole('tecnico_programas');

        $tecnico_estagio = Servidor::create([
            'cpf' => "777.053.520-27",
            'instituicaoVinculo' => 'UPE',
            'matricula' => 345567,
            'tipo_servidor' => 'tecnico_estagios',
        ]);

        $tecnico_estagio->user()->create([
            'name' => "Tecnico Estagio",
            'cpf' => "777.053.520-27",
            'email' => "tecnico_estagios@gmail.com",
            'password' => Hash::make('password')
        ])->assignRole('tecnico_estagios');

        $pro_reitor = Servidor::create([
            'cpf' => "339.292.350-80",
            'instituicaoVinculo' => 'UPE',
            'matricula' => 323456,
            'tipo_servidor' => 'pro-reitor'
        ]);

        $pro_reitor->user()->create([
            'name' => "Pro Reitor",
            'cpf' => "339.292.350-80",
            'email' => "proreitor@gmail.com",
            'password' => Hash::make('password')
        ])->assignRole('pro-reitor');

        $diretor = Servidor::create([
            'cpf' => "961.091.750-05",
            'instituicaoVinculo' => 'UPE',
            'matricula' => 372456,
            'tipo_servidor' => 'diretor'
        ]);

        $diretor->user()->create([
            'name' => "Gestor 1",
            'cpf' => "961.091.750-05",
            'email' => "diretor@gmail.com",
            'password' => Hash::make('password')
        ])->assignRole('diretor');
    }
}
