<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class UpdatePermission extends Command
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
            ['name' => 'estudante', 'guard_name' => 'web'],
            ['name' => 'orientador', 'guard_name' => 'web'],
            ['name' => 'pro-reitor', 'guard_name' => 'web'], 
            ['name' => 'diretor', 'guard_name' => 'web'],
            ['name' => 'supervisor', 'guard_name' => 'web'],
            ['name' => 'administrador', 'guard_name' => 'web'],
        ]);

        $permissionToRoles = [
            'servidor' => 'tecnico',
            'aluno' => 'estudante',
            'orientador' => 'orientador',
            'admin' => 'administrador',
            'pro_reitor' => 'pro-reitor',
            'gestor' => 'diretor'
        ];

        $users = User::all();

        foreach ($users as $user) {
            $userRoles = $user->getAllPermissions()->pluck('name')->toArray();
            
            foreach ($userRoles as $role) {
                $user->assignRole($permissionToRoles[$role]);
            }

            $user->syncPermissions([]);
        }

        Permission::truncate();

        Permission::insert([
            # Estudante
            ['name' => 'cadastrar estudante', 'guard_name' => 'web'],
            ['name' => 'editar estudante', 'guard_name' => 'web'],
            ['name' => 'listar estudante', 'guard_name' => 'web'],
            ['name' => 'visualizar estudante', 'guard_name' => 'web'],
            ['name' => 'deletar estudante', 'guard_name' => 'web'],
            ['name' => 'home estudante', 'guard_name' => 'web'],

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
            # ['name' => 'crud editais programa', 'guard_name' => 'web'], não entendi bem esse crud

            # Edital
            ['name' => 'cadastrar edital', 'guard_name' => 'web'],
            ['name' => 'editar edital', 'guard_name' => 'web'],
            ['name' => 'listar edital', 'guard_name' => 'web'],
            ['name' => 'visualizar edital', 'guard_name' => 'web'],
            ['name' => 'deletar edital', 'guard_name' => 'web'],
            # ['name' => 'crud projetos edital', 'guard_name' => 'web'],

            # Estagio
            ['name' => 'cadastrar estagio', 'guard_name' => 'web'],
            ['name' => 'editar estagio', 'guard_name' => 'web'],
            ['name' => 'deletar estagio', 'guard_name' => 'web'],

            # Vínculo de estudante com edital
            ['name' => 'modificar estudante-edital', 'guard_name' => 'web'],
            ['name' => 'listar estudante-edital', 'guard_name' => 'web'],
        ]);

        Role::each(function ($role) {
            switch ($role->name) {
                case 'tecnico':
                    # CRUD estudante
                    $role->givePermissionTo('cadastrar estudante');
                    $role->givePermissionTo('editar estudante');
                    $role->givePermissionTo('listar estudante');
                    $role->givePermissionTo('visualizar estudante');
                    $role->givePermissionTo('deletar estudante');
                    $role->givePermissionTo('home estudante');

                    # CRUD orientador
                    $role->givePermissionTo('cadastrar orientador');
                    $role->givePermissionTo('editar orientador');
                    $role->givePermissionTo('listar orientador');
                    $role->givePermissionTo('visualizar orientador');
                    $role->givePermissionTo('deletar orientador');
                    $role->givePermissionTo('home orientador');
                    
                    # Home servidor
                    $role->givePermissionTo('home servidor');

                    # CRUD curso
                    $role->givePermissionTo('cadastrar curso');
                    $role->givePermissionTo('editar curso');
                    $role->givePermissionTo('listar curso');
                    $role->givePermissionTo('visualizar curso');
                    $role->givePermissionTo('deletar curso');
                    
                    # CRUD disciplina
                    $role->givePermissionTo('cadastrar Disciplina');
                    $role->givePermissionTo('editar Disciplina');
                    $role->givePermissionTo('listar Disciplina');
                    $role->givePermissionTo('visualizar Disciplina');
                    $role->givePermissionTo('deletar Disciplina');
                    
                    # CRUD edital
                    $role->givePermissionTo('cadastrar edital');
                    $role->givePermissionTo('editar edital');
                    $role->givePermissionTo('listar edital');
                    $role->givePermissionTo('visualizar edital');
                    $role->givePermissionTo('deletar edital');

                    # Associação de estudante com edital
                    $role->givePermissionTo('modificar estudante-edital');
                    $role->givePermissionTo('listar estudante-edital');
                    break;
                case 'orientador' or 'coordenador':
                    # Home orientador
                    $role->givePermissionTo('home orientador');
                    break;
                case 'estudante':
                    # Home estudante
                    $role->givePermissionTo('home estudante');
                    break;
                case 'pro-reitor':
                    # Visualizar estudante
                    $role->givePermissionTo('listar estudante');
                    $role->givePermissionTo('visualizar estudante');

                    # Visualizar orientador
                    $role->givePermissionTo('listar orientador');
                    $role->givePermissionTo('visualizar orientador');

                    # Visualizar tecnico
                    $role->givePermissionTo('listar tecnico');
                    $role->givePermissionTo('visualizar tecnico');

                    # Visualizar curso
                    $role->givePermissionTo('listar curso');
                    $role->givePermissionTo('visualizar curso');

                    # Visualizar programa
                    $role->givePermissionTo('listar programa');
                    $role->givePermissionTo('visualizar programa');

                    # Visualizar disciplina
                    $role->givePermissionTo('listar disciplina');
                    $role->givePermissionTo('visualizar disciplina');

                    # Visualizar edital
                    $role->givePermissionTo('listar edital');
                    $role->givePermissionTo('visualizar edital');

                    $role->givePermissionTo('listar estudante-edital');
                    break;
                case 'diretor':
                    # Visualizar estudante
                    $role->givePermissionTo('editar estudante');
                    $role->givePermissionTo('listar estudante');
                    $role->givePermissionTo('visualizar estudante');

                    # Visualizar orientador
                    $role->givePermissionTo('listar orientador');
                    $role->givePermissionTo('visualizar orientador');

                    # Visualizar tecnico
                    $role->givePermissionTo('editar tecnico');
                    $role->givePermissionTo('listar tecnico');
                    $role->givePermissionTo('visualizar tecnico');

                    # Visualizar curso
                    $role->givePermissionTo('listar curso');
                    $role->givePermissionTo('visualizar curso');

                    # Visualizar programa
                    $role->givePermissionTo('editar programa');
                    $role->givePermissionTo('listar programa');
                    $role->givePermissionTo('visualizar programa');

                    # Visualizar disciplina
                    $role->givePermissionTo('listar disciplina');
                    $role->givePermissionTo('visualizar disciplina');

                    # Visualizar edital
                    $role->givePermissionTo('cadastrar edital');
                    $role->givePermissionTo('editar edital');
                    $role->givePermissionTo('listar edital');
                    $role->givePermissionTo('visualizar edital');
                    break;
            }
        });

        return 0;
    }
}
