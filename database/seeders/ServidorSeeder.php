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
            'tipo_servidor' => "servidor",
        ]);

        $servidor->user()->create([
            'name' => "Vanessa Passos",
            'email' => "vanessa@gmail.com",
            'password' => Hash::make('12345678')
        ])->givePermissionTo('servidor');

        $servidor1 = Servidor::create([
            'cpf' => "929.053.520-27",
            'tipo_servidor' => "servidor",
        ]);

        $servidor1->user()->create([
            'name' => "Anderson",
            'email' => "anderson@gmail.com",
            'password' => Hash::make('12345678')
        ])->givePermissionTo('servidor');
    }
}
