<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class DocumentosController extends Controller
{
    public function termo_encaminhamento_form()
    {
        return view('Estagio.formularios.termo_encaminhamento');
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
