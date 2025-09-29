<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            PermissionsSeeder::class,
            RoleSeeder::class,
            CursoSeeder::class,
            AlunoSeeder::class,
            OrientadorsSeeder::class,
            ServidorSeeder::class,
            UserSeeder::class,
            ProgramasSeeder::class,
            DisciplinaSeeder::class,
            Programa_servidorsSeeder::class,
            EditalSeeder::class,
            EditalAlunoOrientadorsSeeder::class,
            RelatorioSeeder::class,
            HistoricoVinculoAlunosSeeder::class,
            ListaDocumentosObrigatoriosSeeder::class,
            InstituicaoSeeder::class,
            EstagioSeeder::class,
            SiglaInstituicaoSeeder::class,
            AddMaisDocumentosALista::class,
        ]);
    }
}
