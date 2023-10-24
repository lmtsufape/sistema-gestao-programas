<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SiglaInstituicaoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $documentosObrigatorios = DB::table('lista_documentos_obrigatorios')->get();

        foreach ($documentosObrigatorios as $documento) {
            // Verifica se o ID é menor ou igual a 7 e define a sigla apropriada
            $sigla = $documento->id <= 7 ? 'UPE' : 'UFAPE';

            DB::table('lista_documentos_obrigatorios')
                ->where('id', $documento->id)
                ->update(['instituicao' => $sigla]);
        }
    }
}
