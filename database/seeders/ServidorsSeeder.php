<?php

namespace Database\Seeders;

use App\Models\Servidor;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class ServidorsSeeder extends Seeder
{

    public function run()
    {
        $servidor = Servidor::create([
            'cpf' => "770.934.340-61",
            'instituicaoVinculo' => 'UPE',
            'matricula' => 123456,
            'tipo_servidor' => 'adm'
        ]);

        $servidor->user()->create([
            'name' => "Admin",
            'cpf' => "770.934.340-61",
            'email' => "admin@gmail.com",
            'password' => Hash::make('12345678')
        ])->givePermissionTo('admin');

        $servidor1 = Servidor::create([
            'cpf' => "929.053.520-27",
            'instituicaoVinculo' => 'UPE',
            'matricula' => 223456,
            'tipo_servidor' => 'servidor'
        ]);

        $servidor1->user()->create([
            'name' => "Tecnico Adm 1",
            'cpf' => "929.053.520-27",
            'email' => "servidor@gmail.com",
            'password' => Hash::make('12345678')
        ])->givePermissionTo('servidor');

        $servidor2 = Servidor::create([
            'cpf' => "339.292.350-80",
            'instituicaoVinculo' => 'UPE',
            'matricula' => 323456,
            'tipo_servidor' => 'pro_reitor'
        ]);

        $servidor2->user()->create([
            'name' => "Pro Reitor",
            'cpf' => "339.292.350-80",
            'email' => "reitor@gmail.com",
            'password' => Hash::make('12345678')
        ])->givePermissionTo('pro_reitor');

        $servidor3 = Servidor::create([
            'cpf' => "286.260.190-09",
            'instituicaoVinculo' => 'UPE',
            'matricula' => 291456,
            'tipo_servidor' => 'servidor'
        ]);

        $servidor3->user()->create([
            'name' => "Tecnico Adm 2",
            'cpf' => "286.260.190-09",
            'email' => "servidor2@gmail.com",
            'password' => Hash::make('12345678')
        ])->givePermissionTo('servidor');

        $servidor4 = Servidor::create([
            'cpf' => "961.091.750-05",
            'instituicaoVinculo' => 'UPE',
            'matricula' => 372456,
            'tipo_servidor' => 'gestor'
        ]);

        $servidor4->user()->create([
            'name' => "Gestor 1",
            'cpf' => "961.091.750-05",
            'email' => "gestor@gmail.com",
            'password' => Hash::make('12345678')
        ])->givePermissionTo('gestor');
    }
}
