<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ListaDocumentosObrigatorios;

class AddMaisDocumentosALista extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $documento = ListaDocumentosObrigatorios::create([
            'titulo' => "Termo Aditivo",
            'descricao_documento' => "Termo aditivo do estágio.",
            'tipo_entrega' => "inicial",
            'tipo_estagio' => "eo",
            'instituicao' => "UFAPE"
        ]);

        $documento = ListaDocumentosObrigatorios::create([
            'titulo' => "Declaração para comprovação de carga horária realizada no Eso",
            'descricao_documento' => "Declaração para Comprovação de Carga Horária realizada no Eso.            ",
            'tipo_entrega' => "final",
            'tipo_estagio' => "eo",
            'instituicao' => "UFAPE"
        ]);
    }
}
