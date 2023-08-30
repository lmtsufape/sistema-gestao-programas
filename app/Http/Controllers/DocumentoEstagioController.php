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
            'instituicao' => $request->input('instituicao'),
            'nome' => $request->input('nome'),
            'curso' => $request->input('curso'),
            'periodo' => $request->input('periodo'),
            'ano_etapa' => $request->input('ano_etapa'),
            'versao_estagio' => $request->input('versao_estagio'),
            'data_inicio' => $request->input('data_inicio'),
            'data_fim' => $request->input('data_fim'),
            'ano' => $request->input('ano'),
            'nome_supervisor' => $request->input('nome_supervisor'),
            'cpf_supervisor' => $request->input('cpf_supervisor'),
            'formação_supervisor' => $request->input('formação_supervisor'),
            'instituicao_estagio' => $request->input('instituicao_estagio'),
            'telefone_supervisor' => $request->input('telefone_supervisor'), 
            'email_supervisor' => $request->input('email_supervisor'),
            'cidade_estágio' => $request->input('cidade_estagio'),
            'dia_atual' => $request->input('dia_atual'),
            'mes_atual' => $request->input('mes_atual'),
            'cnpj_estagio' => $request->input('cnpj_estagio'),
            'local_estagio' => $request->input('local_estagio'),
            'endereco_estagio' => $request->input('endereco_estagio'),
            'n_estagio' => $request->input('n_estagio'),
            'complemento_estagio' => $request->input('complemento_estagio'),
            'cep_estagio' => $request->input('cep_estagio'),
            'bairro_estagio' => $request->input('bairro_estagio'),
            'cidade_estagio' => $request->input('cidade_estagio'),
            'estado_estagio' => $request->input('estado_estagio'),
            'representantelegal_estagio' => $request->input('representantelegal_estagio'),
            'cargo_representantelegal' => $request->input('cargo_representantelegal'),
            'horario_estagio' => $request->input('horario_estagio')
        ];

        return $pdf->editImage('termo_encaminhamento', $dados);
    }
}
