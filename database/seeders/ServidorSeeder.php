<?php

namespace Database\Seeders;

use App\Models\Servidor;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class ServidorSeeder extends Seeder
{

    public function run()
    {
        $servidor = Servidor::create([
            'cpf' => "770.934.340-61",
            'id_tipo_servidor' => 1,
        ]);

        $servidor->user()->create([
            'name' => "Vanessa Passos",
            'email' => "vanessa@gmail.com",
            'password' => Hash::make('12345678')
        ])->givePermissionTo('servidor');

        $servidor1 = Servidor::create([
            'cpf' => "929.053.520-27",
            'id_tipo_servidor' => 2,
        ]);

        $servidor1->user()->create([
            'name' => "Anderson",
            'email' => "anderson@gmail.com",
            'password' => Hash::make('12345678')
        ])->givePermissionTo('servidor');

        $servidor2 = Servidor::create([
            'cpf' => "339.292.350-80",
            'id_tipo_servidor' => 3,
        ]);

        $servidor2->user()->create([
            'name' => "Pro Reitor",
            'email' => "reitor@gmail.com",
            'password' => Hash::make('12345678')
        ])->givePermissionTo('pro_reitor');
    }
}
