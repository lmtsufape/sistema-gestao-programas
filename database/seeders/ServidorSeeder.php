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
            'password' => Hash::make('12345678')
        ])->assignRole('administrador');

        $tecnico = Servidor::create([
            'cpf' => "929.053.520-27",
            'instituicaoVinculo' => 'UPE',
            'matricula' => 223456,
            'tipo_servidor' => 'tecnico'
        ]);

        $tecnico->user()->create([
            'name' => "Tecnico Adm 1",
            'cpf' => "929.053.520-27",
            'email' => "tecnico@gmail.com",
            'password' => Hash::make('12345678')
        ])->assignRole('tecnico');

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
            'password' => Hash::make('12345678')
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
            'password' => Hash::make('12345678')
        ])->assignRole('diretor');
    }
}
