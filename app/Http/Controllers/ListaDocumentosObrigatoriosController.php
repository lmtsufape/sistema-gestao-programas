<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\ListaDocumentosObrigatoriosUpdateFormRequest;
use App\Models\ListaDocumentosObrigatorios;
use Illuminate\Http\Request;

class ListaDocumentosObrigatoriosController extends Controller
{
    public function editConfig()
    {
        $documentos = ListaDocumentosObrigatorios::all();
        return view('Estagio.editConfig', compact('documentos'));
    }

    public function updateConfig(ListaDocumentosObrigatoriosUpdateFormRequest $request)
    {
        $documentos = ListaDocumentosObrigatorios::all();
        $documentos->each(function ($documento) use ($request) {
            $documento->data_limite = $request->input($documento->id);
            $documento->save();
        });

        return redirect()->route('estagio.index')->with('success', 'Configuração atualizada com sucesso!');
    }
    
    
}
