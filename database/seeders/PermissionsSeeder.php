<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionsSeeder extends Seeder 
{
    public function run ()
    {
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

            # Edital
            ['name' => 'cadastrar edital', 'guard_name' => 'web'],
            ['name' => 'editar edital', 'guard_name' => 'web'],
            ['name' => 'listar edital', 'guard_name' => 'web'],
            ['name' => 'visualizar edital', 'guard_name' => 'web'],
            ['name' => 'deletar edital', 'guard_name' => 'web'],
            ['name' => 'adicionar documento edital', 'guard_name' => 'web'],

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
            ['name' => 'exportar dados estagio', 'guard_name' => 'web'],
            
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
            ['name' => 'cadastrar supervisor', 'guard_name' => 'web'],
            ['name' => 'visualizar supervisor', 'guard_name' => 'web'],
            ['name' => 'editar supervisor', 'guard_name' => 'web'],
            ['name' => 'deletar supervisor', 'guard_name' => 'web'],
        ]);
    }
}