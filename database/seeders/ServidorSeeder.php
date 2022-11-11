<?php

namespace Database\Seeders;

use App\Models\Servidor;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class ServidorSeeder extends Seeder
{

    public function run()
    {
        $servidor1 = Servidor::create([
            'cpf' => "73946545084",
            'setor' => "Escolaridade",
        ]);

        $servidor1->user()->create([
            'name' => "Vanessa Passos",
            'email' => "vanessa@gmail.com",
            'password' => Hash::make('12345678')
        ])->givePermissionTo('servidor');
    }
}
