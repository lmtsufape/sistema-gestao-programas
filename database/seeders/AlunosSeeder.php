<?php

namespace Database\Seeders;

use App\Models\Aluno;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AlunosSeeder extends Seeder
{

    public function run()
    {
        $aluno = Aluno::create([
            'cpf' => "348.126.240-02",
            'curso_id' => 1,
            'semestre_entrada' => "2018.2"
        ]);

        $aluno->user()->create([
            'name' => "Victor Francisco",
            'email' => "victorfran18@gmail.com",
            'name_social' => 'vitão',
            'password' =>  Hash::make('12345678')
        ])->givePermissionTo('aluno');

        $aluno1 = Aluno::create([
            'cpf' => "476.051.020-62",
            'curso_id' => 1,
            'semestre_entrada' => "2018.2"
        ]);

        $aluno1->user()->create([
            'name' => "Arlenio",
            'email' => "arlenio@gmail.com",
            'name_social' => 'arlen',
            'password' =>  Hash::make('12345678')
        ])->givePermissionTo('aluno');
    }
}
