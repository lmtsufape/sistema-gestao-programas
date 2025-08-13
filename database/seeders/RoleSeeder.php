<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
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

        $permissions = [
            'tecnico' => [
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

                # Estágio
                'listar estagio',
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
            ],
            'orientador' => [
                'home orientador',
                'listar estudante inativo',
                'listar documento estagio',
                'adicionar documento edital',
                'visualizar vinculo estudante-edital',
            ],
            'coordenador' => [
                'home orientador',
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
            'administrador' => []
        ];

        Role::each(function ($role) use ($permissions) {
            if (in_array($role->name, ['tecnico', 'coordenador', 'diretor'])) {
                $role->syncPermissions(Permission::all());
            } else {
                $role->givePermissionTo($permissions[$role->name]);
            }
        });
    }
}
