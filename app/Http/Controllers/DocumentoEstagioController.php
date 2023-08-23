<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\DocumentoEstagio;
use App\Models\Estagio;
use Illuminate\Http\Request;


class DocumentoEstagioController extends Controller
{
    public function termo_encaminhamento_form($id)
    {
        $estagio = Estagio::findOrFail($id);

        return view('Estagio.documentos.termo_de_encaminhamento', compact("estagio"));
    }

    public function termo_encaminhamento(Request $request)
    {
        $pdf = new PDFController;
        $dados = [
            'nome' => $request->input('nome'),
            'curso' => $request->input('curso'),
            'periodo' => $request->input('periodo'),
        ];

        return $pdf->editImage('termo_encaminhamento', $dados);
    }
}
