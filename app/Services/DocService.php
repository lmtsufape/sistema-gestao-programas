<?php

namespace App\Services;

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

}
