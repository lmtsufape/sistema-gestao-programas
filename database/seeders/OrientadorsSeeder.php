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
            'cpf' => "348.126.240-02",
            'matricula' => "123456"
        ]);

        $orientador->user()->create([
            'name' => "Marcius Petrucio",
            'email' => "Marcius@gmail.com",
            'password' =>  Hash::make('12345678')
        ])->givePermissionTo('orientador');
    }
}
