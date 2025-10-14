<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    // Define os papéis
    private $roles = [
        'tecnico_estagios',
        'coordenador_estagios',
        'tecnico_programas',
        'coordenador_programas',
        'estudante',
        'orientador',
        'pro-reitor',
        'diretor',
        'supervisor',
        'administrador',
    ];

    // Define as permissões para cada papel
    private $rolePermission = [
        'tecnico_programas' => [
            # Estudante
            'listar estudante',
            'cadastrar estudante',
            'visualizar estudante',
            'editar estudante',
            'deletar estudante',
            'home estudante',
            'listar estudante inativo',
            'verificar estudante',
            # Orientador
            'listar orientador',
            'cadastrar orientador',
            'visualizar orientador',
            'editar orientador',
            'deletar orientador',
            'home orientador',
            # Servidor
            'home servidor',
            # Disciplina
            'listar disciplina',
            'cadastrar disciplina',
            'visualizar disciplina',
            'editar disciplina',
            'deletar disciplina',
            # Edital
            'listar edital',
            'cadastrar edital',
            'visualizar edital',
            'editar edital',
            'deletar edital',
            # Vínculo entre estudante e edital
            'listar vinculo estudante-edital',
            'listar vinculo estudante-edital inativo',
            'vincular estudante-edital',
            'visualizar vinculo estudante-edital',
            'editar vinculo estudante-edital',
            'desvincular estudante-edital',
        ],
        'tecnico_estagios' => [
            # Estudante
            'listar estudante',
            'cadastrar estudante',
            'visualizar estudante',
            'editar estudante',
            'deletar estudante',
            'home estudante',
            'listar estudante inativo',
            'verificar estudante',
            # Orientador
            'listar orientador',
            'cadastrar orientador',
            'visualizar orientador',
            'editar orientador',
            'deletar orientador',
            'home orientador',
            # Servidor
            'home servidor',
            # Disciplina
            'listar disciplina',
            'cadastrar disciplina',
            'visualizar disciplina',
            'editar disciplina',
            'deletar disciplina',
            # Curso
            'listar curso',
            'cadastrar curso',
            'visualizar curso',
            'editar curso',
            'deletar curso',
            # Estágio
            'listar estagio',
            'visualizar estagio',
            'cadastrar estagio',
            'editar estagio',
            'deletar estagio',
            'configurar estagio',
            'validar documento estagio',
            'visualizar documento estagio',
            'listar documento estagio',
            'editar observacao estagio',
            'editar instituicao estagio',
            'visualizar instituicao estagio',
            'exportar dados estagio',
            'listar estudante inativo',
            'listar documento estagio',
            'adicionar documento edital',
        ],
        'orientador' => [
            'home orientador',
            'listar estudante inativo',
            'listar documento estagio',
            'adicionar documento edital',
            'visualizar vinculo estudante-edital',
        ],
        'coordenador_programas' => [
            # Vínculo edital-programa
            'cadastrar edital-programa',
            # Supervisor
            'visualizar supervisor',
            # Estudante
            'listar estudante',
            'cadastrar estudante',
            'visualizar estudante',
            'editar estudante',
            'deletar estudante',
            'home estudante',
            'listar estudante inativo',
            'verificar estudante',
            # Orientador
            'listar orientador',
            'cadastrar orientador',
            'visualizar orientador',
            'editar orientador',
            'deletar orientador',
            'home orientador',
            # Servidor
            'home servidor',
            # Curso
            'listar curso',
            'cadastrar curso',
            'visualizar curso',
            'editar curso',
            'deletar curso',
            # Disciplina
            'listar disciplina',
            'cadastrar disciplina',
            'visualizar disciplina',
            'editar disciplina',
            'deletar disciplina',
            # Edital
            'listar edital',
            'cadastrar edital',
            'visualizar edital',
            'editar edital',
            'deletar edital',
            # Vínculo entre estudante e edital
            'listar vinculo estudante-edital',
            'listar vinculo estudante-edital inativo',
            'vincular estudante-edital',
            'visualizar vinculo estudante-edital',
            'editar vinculo estudante-edital',
            'desvincular estudante-edital',
        ],
        'coordenador_estagios' => [
            # Vínculo edital-programa
            'cadastrar edital-programa',
            # Supervisor
            'visualizar supervisor',
            # Estudante
            'listar estudante',
            'cadastrar estudante',
            'visualizar estudante',
            'editar estudante',
            'deletar estudante',
            'home estudante',
            'listar estudante inativo',
            'verificar estudante',
            # Orientador
            'listar orientador',
            'cadastrar orientador',
            'visualizar orientador',
            'editar orientador',
            'deletar orientador',
            'home orientador',
            # Servidor
            'home servidor',
            # Curso
            'listar curso',
            'cadastrar curso',
            'visualizar curso',
            'editar curso',
            'deletar curso',
            # Disciplina
            'listar disciplina',
            'cadastrar disciplina',
            'visualizar disciplina',
            'editar disciplina',
            'deletar disciplina',
            # Estágio
            'listar estagio',
            'visualizar estagio',
            'cadastrar estagio',
            'editar estagio',
            'deletar estagio',
            'configurar estagio',
            'validar documento estagio',
            'visualizar documento estagio',
            'listar documento estagio',
            'editar observacao estagio',
            'editar instituicao estagio',
            'visualizar instituicao estagio',
            'exportar dados estagio',
            'listar estudante inativo',
            'listar documento estagio',
            'adicionar documento edital',
        ],
        'estudante' => [
            'home estudante',
            'visualizar vinculo estudante-edital',
            # Edital
            'visualizar proprio edital',
            # Estagio
            'preencher documento estagio',
            'listar documento estagio',
            'editar instituicao estagio',
            'visualizar instituicao estagio',
        ],
        'pro-reitor' => [
            # Estudante
            'listar estudante',
            'visualizar estudante',
            # Orientador
            'listar orientador',
            'visualizar orientador',
            # Servidor
            'listar servidor',
            'visualizar servidor',
            # Curso
            'listar curso',
            'visualizar curso',
            # Programa
            'listar programa',
            'visualizar programa',
            # Disciplina
            'listar disciplina',
            'visualizar disciplina',
            # Edital
            'listar edital',
            'visualizar edital',
            # Vínculo estudante-edital
            'listar vinculo estudante-edital',
            'listar vinculo estudante-edital inativo',
            'visualizar vinculo estudante-edital',
            # Estágio
            'listar estagio',
            'configurar estagio',
            'visualizar documento estagio',
            'exportar dados estagio',
            # Vínculo servidor-programa
            'vincular servidor-programa',
            # Vínculo edital-programa
            'cadastrar edital-programa',
            'adicionar permissao',
            # Supervisor
            'listar supervisor',
            'cadastrar supervisor',
            'visualizar supervisor',
            'editar supervisor',
            'deletar supervisor',
        ],
        'diretor' => [
            # Estudante
            'listar estudante',
            'listar estudante inativo',
            'visualizar estudante',
            'editar estudante',
            'verificar estudante',
            # Orientador
            'listar orientador',
            'visualizar orientador',
            # Servidor
            'listar servidor',
            'visualizar servidor',
            'editar servidor',
            # Curso
            'listar curso',
            'visualizar curso',
            # Programa
            'listar programa',
            'visualizar programa',
            'editar programa',
            # Disciplina
            'listar disciplina',
            'visualizar disciplina',
            # Edital
            'listar edital',
            'cadastrar edital',
            'visualizar edital',
            'editar edital',
            # Vínculo entre estudante e edital
            'listar vinculo estudante-edital',
            'listar vinculo estudante-edital inativo',
            'vincular estudante-edital',
            'visualizar vinculo estudante-edital',
            'editar vinculo estudante-edital',
            # Estágio
            'listar estagio',
            'cadastrar estagio',
            'editar estagio',
            'configurar estagio',
            'validar documento estagio',
            'visualizar documento estagio',
            'editar observacao estagio',
            'editar instituicao estagio',
            'visualizar instituicao estagio',
            'exportar dados estagio',
            # Vínculo edital-programa
            'cadastrar edital-programa',
            # Supervisor
            'visualizar supervisor',
        ],
        'supervisor' => [],
        'administrador' => [] // tem todas as permissões através do Gate::before no AuthServiceProvider
    ];

    private $permissions = [
        # Estudante
        'cadastrar estudante',
        'editar estudante',
        'listar estudante',
        'visualizar estudante',
        'deletar estudante',
        'home estudante',
        'listar estudante inativo',
        'verificar estudante',
        # Orientador
        'cadastrar orientador',
        'editar orientador',
        'listar orientador',
        'visualizar orientador',
        'deletar orientador',
        'home orientador',
        # Servidor
        'cadastrar servidor',
        'editar servidor',
        'listar servidor',
        'visualizar servidor',
        'deletar servidor',
        'home servidor',
        # Curso
        'cadastrar curso',
        'editar curso',
        'listar curso',
        'visualizar curso',
        'deletar curso',
        # Disciplina
        'cadastrar disciplina',
        'editar disciplina',
        'listar disciplina',
        'visualizar disciplina',
        'deletar disciplina',
        # Programa
        'cadastrar programa',
        'editar programa',
        'listar programa',
        'visualizar programa',
        'deletar programa',
        # Edital
        'cadastrar edital',
        'editar edital',
        'listar edital',
        'visualizar edital',
        'visualizar proprio edital',
        'deletar edital',
        'adicionar documento edital',
        # Estagio
        'listar estagio',
        'visualizar estagio',
        'cadastrar estagio',
        'editar estagio',
        'deletar estagio',
        'configurar estagio',
        'listar documento estagio',
        'preencher documento estagio',
        'visualizar documento estagio',
        'validar documento estagio',
        'editar observacao estagio',
        'visualizar instituicao estagio',
        'editar instituicao estagio',
        'exportar dados estagio',
        # Vínculo entre estudante e edital
        'listar vinculo estudante-edital',
        'listar vinculo estudante-edital inativo',
        'vincular estudante-edital',
        'editar vinculo estudante-edital',
        'visualizar vinculo estudante-edital',
        'desvincular estudante-edital',
        # Vínculo entre servidor e programa
        'vincular servidor-programa',
        # Vínculo entre edital e programa
        'cadastrar edital-programa',
        'adicionar permissao',
        # Supervisor
        'listar supervisor',
        'cadastrar supervisor',
        'visualizar supervisor',
        'editar supervisor',
        'deletar supervisor'
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Atualizar permissões
        $existingPermissions = Permission::pluck('name')->toArray();
        $permissionsToDelete = array_diff($existingPermissions, $this->permissions);
        $permissionsToCreate = array_diff($this->permissions, $existingPermissions);

        // Remover permissões que não estão na lista
        Permission::whereIn('name', $permissionsToDelete)->delete();

        // Criar novas permissões
        foreach ($permissionsToCreate as $permission) {
            Permission::create(['name' => $permission, 'guard_name' => 'web']);
        }

        // Atualizar papéis
        $existingRoles = Role::pluck('name')->toArray();
        $rolesToDelete = array_diff($existingRoles, $this->roles);
        $rolesToCreate = array_diff($this->roles, $existingRoles);

        // Remover papéis que não estão na lista
        Role::whereIn('name', $rolesToDelete)->delete();

        // Criar novos papéis
        foreach ($rolesToCreate as $roleName) {
            Role::create([
                'name' => $roleName,
                'guard_name' => 'web'
            ]);
        }

        // Atualizar permissões para cada papel
        foreach ($this->roles as $roleName) {
            $role = Role::where('name', $roleName)->first();
            if ($role) {
                $permissions = in_array($roleName, [
                    'tecnico_programas',
                    'tecnico_estagios',
                    'coordenador_programas',
                    'coordenador_estagios',
                    'diretor'
                ]) ? $this->permissions : ($this->rolePermission[$roleName] ?? []);
                $role->syncPermissions($permissions);
            }
        }
    }
}
