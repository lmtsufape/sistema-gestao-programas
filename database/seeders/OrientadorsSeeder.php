<?php

namespace Database\Seeders;

use App\Models\Orientador;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class OrientadorsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $orientador = Orientador::create([
            'cpf' => "827.846.340-94",
            'matricula' => "123456"
        ]);

        $orientador->user()->create([
            'name' => "Marcius Petrucio",
            'email' => "Marcius@gmail.com",
            'password' =>  Hash::make('12345678')
        ])->givePermissionTo('orientador');

        $orientador1 = Orientador::create([
            'cpf' => "786.116.540-05",
            'matricula' => "246810"
        ]);

        $orientador1->user()->create([
            'name' => "Rodrigo Rocha",
            'email' => "Rodrigo@gmail.com",
            'password' =>  Hash::make('12345678')
        ])->givePermissionTo('orientador');
    }
}
