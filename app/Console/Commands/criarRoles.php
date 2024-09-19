<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class criarRoles extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'permission:fix-roles';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'cria as roles na tabela de roles';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        Role::insert([
            ['name' => 'tecnico', 'guard_name' => 'web'],
            ['name' => 'coordenador', 'guard_name' => 'web'],
            ['name' => 'aluno', 'guard_name' => 'web'],
            ['name' => 'orientador', 'guard_name' => 'web'],
            ['name' => 'pro reitor', 'guard_name' => 'web'], 
            ['name' => 'diretor', 'guard_name' => 'web'],
            ['name' => 'supervisor', 'guard_name' => 'web'],
            ['name' => 'administrador', 'guard_name' => 'web'],
        ]);

        $permissionToRoles = [
            'servidor' => 'tecnico',
            'aluno' => 'aluno',
            'orientador' => 'orientador',
            'admin' => 'administrador',
            'pro_reitor' => 'pro reitor',
            'gestor' => 'diretor'
        ];

        $users = User::all();

        foreach ($users as $user) {
            $userRoles = $user->getAllPermissions()->pluck('name')->toArray();
            
            foreach ($userRoles as $role) {
                $role = Role::where('name', $permissionToRoles[$role])->first();
                $user->assignRole($role);
            }

            $user->syncPermissions([]);
        }

        Permission::truncate();

        Permission::insert([
            # Aluno
            ['name' => 'cadastrar aluno', 'guard_name' => 'web'],
            ['name' => 'editar aluno', 'guard_name' => 'web'],
            ['name' => 'listar aluno', 'guard_name' => 'web'],
            ['name' => 'visualizar aluno', 'guard_name' => 'web'],
            ['name' => 'deletar aluno', 'guard_name' => 'web'],
            ['name' => 'home aluno', 'guard_name' => 'web'],

            # Orientador
            ['name' => 'cadastrar orientador', 'guard_name' => 'web'],
            ['name' => 'editar orientador', 'guard_name' => 'web'],
            ['name' => 'listar orientador', 'guard_name' => 'web'],
            ['name' => 'visualizar orientador', 'guard_name' => 'web'],
            ['name' => 'deletar orientador', 'guard_name' => 'web'],
            ['name' => 'home orientador', 'guard_name' => 'web'],

            # Servidor
            ['name' => 'cadastrar servidor', 'guard_name' => 'web'],
            ['name' => 'editar servidor', 'guard_name' => 'web'],
            ['name' => 'listar servidor', 'guard_name' => 'web'],
            ['name' => 'visualizar servidor', 'guard_name' => 'web'],
            ['name' => 'deletar servidor', 'guard_name' => 'web'],
            ['name' => 'home servidor', 'guard_name' => 'web'],

            # Curso
            ['name' => 'cadastrar curso', 'guard_name' => 'web'],
            ['name' => 'editar curso', 'guard_name' => 'web'],
            ['name' => 'listar curso', 'guard_name' => 'web'],
            ['name' => 'visualizar curso', 'guard_name' => 'web'],
            ['name' => 'deletar curso', 'guard_name' => 'web'],

            # Disciplina
            ['name' => 'cadastrar Disciplina', 'guard_name' => 'web'],
            ['name' => 'editar Disciplina', 'guard_name' => 'web'],
            ['name' => 'listar Disciplina', 'guard_name' => 'web'],
            ['name' => 'visualizar Disciplina', 'guard_name' => 'web'],
            ['name' => 'deletar Disciplina', 'guard_name' => 'web'],

            # Programa
            ['name' => 'cadastrar programa', 'guard_name' => 'web'],
            ['name' => 'editar programa', 'guard_name' => 'web'],
            ['name' => 'listar programa', 'guard_name' => 'web'],
            ['name' => 'visualizar programa', 'guard_name' => 'web'],
            ['name' => 'deletar programa', 'guard_name' => 'web'],
            //['name' => 'crud editais programa', 'guard_name' => 'web'], não entendi bem esse crud

            # Edital
            ['name' => 'cadastrar edital', 'guard_name' => 'web'],
            ['name' => 'editar edital', 'guard_name' => 'web'],
            ['name' => 'listar edital', 'guard_name' => 'web'],
            ['name' => 'visualizar edital', 'guard_name' => 'web'],
            ['name' => 'deletar edital', 'guard_name' => 'web'],
        ]);

        return 0;
    }
}
