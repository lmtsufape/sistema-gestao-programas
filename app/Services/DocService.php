<?php

namespace App\Services;

use App\Models\ListaDocumentosObrigatorios;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

/**
 * Class DocService.
 */
class DocService
{
    public static function tmpdoc()
    {
        $nomeUnico = 'doc_' . Str::uuid() . '.docx';
        $caminhoTemporario = storage_path('app/docs/tmp/') . $nomeUnico;

        $diretorio = dirname($caminhoTemporario);

        if (!File::isDirectory($diretorio)) {
            File::makeDirectory($diretorio, 0755, true, true);
        }
        
        return $caminhoTemporario;
    }

    public static function download($id, $nome)
    {   
        $doc = ListaDocumentosObrigatorios::find($id);
        $instituicao = $doc->instituicao;
        $path = storage_path("app/docs/{$instituicao}/") . $nome;

        $headers = [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
        ];

        return response()->download($path, $nome, $headers);
    }

}
