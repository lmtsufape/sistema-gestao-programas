<?php

namespace Database\Seeders;

use App\Models\Aluno;
use App\Models\Servidor;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $admin = Servidor::firstWhere('cpf', '770.934.340-61');
        $admin->user()->create([
            'name' => "Admin",
            'cpf' => $admin->cpf,
            'email' => "admin@gmail.com",
            'password' => bcrypt('password')
        ])->assignRole('administrador');

        $tecnico_program = Servidor::firstWhere('cpf', '999.053.520-27');
        $tecnico_program->user()->create([
            'name' => "Tecnico Programas",
            'cpf' => $tecnico_program->cpf,
            'email' => "tecnico_programas@gmail.com",
            'password' => bcrypt('password')
        ])->assignRole('tecnico_programas');

        $coord_program = Servidor::firstWhere('cpf', '934.053.520-27');
        $coord_program->user()->create([
            'name' => "Coordenador Programas",
            'cpf' => $coord_program->cpf,
            'email' => "coordenador_programas@gmail.com",
            'password' => bcrypt('password')
        ])->assignRole('coordenador_programas');

        $tecnico_estagio = Servidor::firstWhere('cpf', '777.053.520-27');
        $tecnico_estagio->user()->create([
            'name' => "Tecnico Estagio",
            'cpf' => $tecnico_estagio->cpf,
            'email' => "tecnico_estagios@gmail.com",
            'password' => bcrypt('password')
        ])->assignRole('tecnico_estagios');

        $coord_estagios = Servidor::firstWhere('cpf', '345.345.525-27');
        $coord_estagios->user()->create([
            'name' => "Coordenador Estagios",
            'cpf' => $coord_estagios->cpf,
            'email' => "coordenador_estagios@gmail.com",
            'password' => bcrypt('password')
        ])->assignRole('coordenador_estagios');

        $pro_reitor = Servidor::firstWhere('cpf', '339.292.350-80');
        $pro_reitor->user()->create([
            'name' => "Pro Reitor",
            'cpf' => $pro_reitor->cpf,
            'email' => "proreitor@gmail.com",
            'password' => bcrypt('password')
        ])->assignRole('pro-reitor');

        $diretor = Servidor::firstWhere('cpf', '961.091.750-05');
        $diretor->user()->create([
            'name' => "Gestor 1",
            'cpf' => $diretor->cpf,
            'email' => "diretor@gmail.com",
            'password' => bcrypt('password')
        ])->assignRole('diretor');

        $aluno = Aluno::find(1);
        $aluno->user()->create([
            'name' => "Aluno",
            'cpf' => '348.126.240-02',
            'email' => "aluno@gmail.com",
            'password' => bcrypt('password')
        ])->assignRole('estudante');
    }
}
