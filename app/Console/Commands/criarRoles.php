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

        return 0;
    }
}
