<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use Illuminate\Support\Facades\Artisan;

class UpdatePermission extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'permission:fix';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cria todas as roles necessárias.
        Atribui os users a suas roles respectivas baseando-se nas permissões atuais.
        Limpa a tabela de permissões.
        Cria todas as permissões necessárias. (ou a maioria pelo menos)
        Atribui as permissões as roles.';

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
            'gestor' => 'diretor',
            'coordenador' => 'coordenador',
            'supervisor' => 'supervisor'
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
            ['name' => 'listar estudante inativo', 'guard_name' => 'web'],
            ['name' => 'verificar estudante', 'guard_name' => 'web'],

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
            ['name' => 'cadastrar disciplina', 'guard_name' => 'web'],
            ['name' => 'editar disciplina', 'guard_name' => 'web'],
            ['name' => 'listar disciplina', 'guard_name' => 'web'],
            ['name' => 'visualizar disciplina', 'guard_name' => 'web'],
            ['name' => 'deletar disciplina', 'guard_name' => 'web'],

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
            ['name' => 'listar estagio', 'guard_name' => 'web'],
            ['name' => 'cadastrar estagio', 'guard_name' => 'web'],
            ['name' => 'editar estagio', 'guard_name' => 'web'],
            ['name' => 'deletar estagio', 'guard_name' => 'web'],
            ['name' => 'configurar estagio', 'guard_name' => 'web'],
            ['name' => 'listar documento estagio', 'guard_name' => 'web'],
            ['name' => 'preencher documento estagio', 'guard_name' => 'web'],
            ['name' => 'visualizar documento estagio', 'guard_name' => 'web'],
            ['name' => 'validar documento estagio', 'guard_name' => 'web'],
            ['name' => 'editar observacao estagio', 'guard_name' => 'web'],
            ['name' => 'visualizar instituicao estagio', 'guard_name' => 'web'],
            ['name' => 'editar instituicao estagio', 'guard_name' => 'web'],
            
            # Vínculo entre estudante e edital
            ['name' => 'listar vinculo estudante-edital', 'guard_name' => 'web'],
            ['name' => 'listar vinculo estudante-edital inativo', 'guard_name' => 'web'],
            ['name' => 'vincular estudante-edital', 'guard_name' => 'web'],
            ['name' => 'editar vinculo estudante-edital', 'guard_name' => 'web'],
            ['name' => 'visualizar vinculo estudante-edital', 'guard_name' => 'web'],
            ['name' => 'desvincular estudante-edital', 'guard_name' => 'web'],

            # Vínculo entre servidor e programa
            ['name' => 'vincular servidor-programa', 'guard_name' => 'web'],
            
            # Vínculo entre edital e programa
            ['name' => 'cadastrar edital-programa', 'guard_name' => 'web'],
            
            ['name' => 'adicionar permissao', 'guard_name' => 'web'],

            # Supervisor
            ['name' => 'listar supervisor', 'guard_name' => 'web'],
            ['name' => 'cadastar supervisor', 'guard_name' => 'web'],
            ['name' => 'visualizar supervisor', 'guard_name' => 'web'],
            ['name' => 'editar supervisor', 'guard_name' => 'web'],
            ['name' => 'deletar supervisor', 'guard_name' => 'web'],
        ]);

        // Limpar cache de permissões
        Artisan::call('permission:cache-reset');

        // Iniciar permissões manualmente
        Permission::get(); // Isso força o carregamento de permissões no sistema

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
                    $role->givePermissionTo('listar estudante inativo');
                    $role->givePermissionTo('verificar estudante');

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
                    $role->givePermissionTo('cadastrar disciplina');
                    $role->givePermissionTo('editar disciplina');
                    $role->givePermissionTo('listar disciplina');
                    $role->givePermissionTo('visualizar disciplina');
                    $role->givePermissionTo('deletar disciplina');
                    
                    # CRUD edital
                    $role->givePermissionTo('cadastrar edital');
                    $role->givePermissionTo('editar edital');
                    $role->givePermissionTo('listar edital');
                    $role->givePermissionTo('visualizar edital');
                    $role->givePermissionTo('deletar edital');

                    # Vínculo entre estudante e edital
                    $role->givePermissionTo('listar vinculo estudante-edital');
                    $role->givePermissionTo('vincular estudante-edital');
                    $role->givePermissionTo('editar vinculo estudante-edital');
                    $role->givePermissionTo('visualizar vinculo estudante-edital');
                    $role->givePermissionTo('desvincular estudante-edital');
                    $role->givePermissionTo('listar vinculo estudante-edital inativo');

                    # Estágio
                    $role->givePermissionTo('listar estagio');
                    $role->givePermissionTo('cadastrar estagio');
                    $role->givePermissionTo('editar estagio');
                    $role->givePermissionTo('configurar estagio');
                    $role->givePermissionTo('deletar estagio');
                    $role->givePermissionTo('validar documento estagio');
                    $role->givePermissionTo('visualizar documento estagio');
                    $role->givePermissionTo('listar documento estagio');
                    $role->givePermissionTo('editar observacao estagio');
                    $role->givePermissionTo('editar instituicao estagio');
                    $role->givePermissionTo('visualizar instituicao estagio');

                    break;
                case 'orientador' or 'coordenador':
                    # Home orientador
                    $role->givePermissionTo('home orientador');

                    $role->givePermissionTo('listar estudante inativo');
                    
                    $role->givePermissionTo('listar documento estagio');

                    break;
                case 'estudante':
                    # Home estudante
                    $role->givePermissionTo('home estudante');

                    $role->givePermissionTo('visualizar vinculo estudante-edital');

                    # Estagio
                    $role->givePermissionTo('cadastrar estagio');
                    $role->givePermissionTo('preencher documento estagio');
                    $role->givePermissionTo('listar documento estagio');
                    $role->givePermissionTo('editar instituicao estagio');
                    $role->givePermissionTo('visualizar instituicao estagio');

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
                    
                    # Vínculo estudante-edital
                    $role->givePermissionTo('listar vinculo estudante-edital');
                    $role->givePermissionTo('listar vinculo estudante-edital inativo');
                    $role->givePermissionTo('visualizar vinculo estudante-edital');
                    
                    # Estágio
                    $role->givePermissionTo('listar estagio');
                    $role->givePermissionTo('configurar estagio');
                    $role->givePermissionTo('visualizar documento estagio');
                    
                    # Vínculo servidor-programa
                    $role->givePermissionTo('vincular servidor-programa');
                    
                    # Vínculo edital-programa
                    $role->givePermissionTo('cadastrar edital-programa');
                    
                    $role->givePermissionTo('adicionar permissao');
                    
                    # Supervisor
                    $role->givePermissionTo('listar supervisor');
                    $role->givePermissionTo('cadastrar supervisor');
                    $role->givePermissionTo('visualizar supervisor');
                    $role->givePermissionTo('editar supervisor');
                    $role->givePermissionTo('deletar supervisor');

                    break;
                case 'diretor':
                    # estudante
                    $role->givePermissionTo('editar estudante');
                    $role->givePermissionTo('listar estudante');
                    $role->givePermissionTo('visualizar estudante');
                    $role->givePermissionTo('listar estudante inativo');
                    $role->givePermissionTo('verificar estudante');

                    # orientador
                    $role->givePermissionTo('listar orientador');
                    $role->givePermissionTo('visualizar orientador');

                    # tecnico
                    $role->givePermissionTo('editar tecnico');
                    $role->givePermissionTo('listar tecnico');
                    $role->givePermissionTo('visualizar tecnico');

                    # curso
                    $role->givePermissionTo('listar curso');
                    $role->givePermissionTo('visualizar curso');

                    # programa
                    $role->givePermissionTo('editar programa');
                    $role->givePermissionTo('listar programa');
                    $role->givePermissionTo('visualizar programa');

                    # disciplina
                    $role->givePermissionTo('listar disciplina');
                    $role->givePermissionTo('visualizar disciplina');

                    # edital
                    $role->givePermissionTo('cadastrar edital');
                    $role->givePermissionTo('editar edital');
                    $role->givePermissionTo('listar edital');
                    $role->givePermissionTo('visualizar edital');

                    # Vínculo entre estudante e edital
                    $role->givePermissionTo('listar vinculo estudante-edital');
                    $role->givePermissionTo('vincular estudante-edital');
                    $role->givePermissionTo('editar vinculo estudante-edital');
                    $role->givePermissionTo('visualizar vinculo estudante-edital');
                    $role->givePermissionTo('listar vinculo estudante-edital inativo');

                    # Estágio
                    $role->givePermissionTo('listar estagio');
                    $role->givePermissionTo('cadastrar estagio');
                    $role->givePermissionTo('editar estagio');
                    $role->givePermissionTo('configurar estagio');
                    $role->givePermissionTo('validar documento estagio');
                    $role->givePermissionTo('visualizar documento estagio');
                    $role->givePermissionTo('editar observacao estagio');
                    $role->givePermissionTo('editar instituicao estagio');
                    $role->givePermissionTo('visualizar instituicao estagio');

                    # Vínculo edital-programa
                    $role->givePermissionTo('cadastrar edital-programa');

                    # Supervisor
                    $role->givePermissionTo('visualizar supervisor');

                    break;
            }
        });

        return 0;
    }
}
