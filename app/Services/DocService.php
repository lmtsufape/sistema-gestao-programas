<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Response;

/**
 * Class DocService.
 */
class DocService
{
    public function carregarArquivo()
    {
        $nomeArquivo = '1.docx';
        $caminhoArquivo = storage_path('public/' . $nomeArquivo);
        // Verificar se o arquivo existe
        if (Storage::exists($caminhoArquivo)) {
            // Ler o conteúdo do arquivo
            $conteudo = Storage::get($caminhoArquivo);

            // Definir os cabeçalhos para resposta
            $headers = [
                'Content-Type' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                'Content-Disposition' => 'inline; filename="' . $nomeArquivo . '"',
            ];

            // Retornar a resposta com o conteúdo do arquivo
            return response()->make($conteudo, 200, $headers);
        } else {
            // O arquivo não foi encontrado, retornar resposta de erro
            return response()->json(['message' => 'Arquivo não encontrado'], 404);
        }
    }
}

