<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Aluno;
use App\Models\DocumentoEstagio;
use App\Models\Estagio;
use App\Models\Instituicao;
use App\Models\Orientador;
use Illuminate\Http\Request;


class DocumentoEstagioController extends Controller
{

    public function termo_compromisso_form($id)
    {
        $estagio = Estagio::findOrFail($id);
        $aluno = Aluno::findOrFail($estagio->aluno_id);
        $instituicao = Instituicao::findOrFail($estagio->instituicao_id);
        $orientador = Orientador::findOrFail($estagio->orientador_id);
        return view('Estagio.documentos.termo_de_compromisso', compact("estagio", "aluno", "instituicao", "orientador"));
    }

    public function termo_compromisso(Request $request)
    {
        $pdf = new PDFController;
        $dados = [
            //INSTITUIÇÃO DE ENSINO
            'professorComponenteCurricular' => $request->input('ProfessorComponenteCurricular'),
            'instituicaoEmail' => $request->input('instituicaoEmail'),
            'orientador' => $request->input('orientador'),
            'emailOrientador' => $request->input('emailOrientador'),

            //UNIDADE CONCEDENTE
            'instituicaoUnidadeConcedente' => $request->input('instituicaoUnidadeConcedente'),
            'cnpj' => $request->input('cnpj'),
            'localEstagio' => $request->input('localEstagio'),
            //endereço
            'endereco' => $request->input('endereco'),
            'numero' => $request->input('numero'),
            'complemento' => $request->input('complemento'),
            'cep' => $request->input('cep'),
            'bairro' => $request->input('bairro'),
            'cidade' => $request->input('cidade'),
            'estado' => $request->input('estado'),
            'representanteLegal' => $request->input('representanteLegal'),
            'cargoRepresentante' => $request->input('cargoRepresentante'),
            //supervisor
            'supervisor' => $request->input('supervisor'),
            'cargoSupervisor' => $request->input('cargoSupervisor'),
            'formacaoSupervisor' => $request->input('formacaoSupervisor'),
            'cpfSupervisor' => $request->input('cpfSupervisor'),
            'emailSupervisor' => $request->input('emailSupervisor'),
            'telefoneSupervisor' => $request->input('telefoneSupervisor'),

            //ESTAGIÁRIO
            'nomeAluno' => $request->input('nomeAluno'),
            'cpfAluno' => $request->input('cpfAluno'),
            'curso' => $request->input('curso'),
            'periodo' => $request->input('periodo'),
            //endereco do aluno
            'enderecoAluno' => $request->input('enderecoAluno'),
            'numeroEnderecoAluno' => $request->input('numeroEnderecoAluno'),
            'complementoAluno' => $request->input('complementoAluno'),
            'cepAluno' => $request->input('cepAluno'),
            'bairroAluno' => $request->input('bairroAluno'),
            'cidadeAluno' => $request->input('cidadeAluno'),
            'estadoAluno' => $request->input('estadoAluno'),
            'telefoneAluno' => $request->input('telefoneAluno'),
            'emailAluno' => $request->input('emailAluno'),
        ];

        return $pdf->editImage(2, $dados);
    }

    public function termo_encaminhamento_form($id)
    {
        $estagio = Estagio::findOrFail($id);
        $aluno = Aluno::findOrFail($estagio->aluno_id);
        return view('Estagio.documentos.termo_de_encaminhamento', compact("estagio", "aluno"));
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

        return $pdf->editImage(1, $dados);
    }

    public function ficha_frequencia_form($id)
    {
        $estagio = Estagio::findOrFail($id);
        $aluno = Aluno::findOrFail($estagio->aluno_id);
        return view('Estagio.documentos.ficha_frequencia', compact("estagio", "aluno"));
    }

    public function ficha_frequencia(Request $request)
    {
        $pdf = new PDFController;
        $dados = [
            'campus' => $request->input('campus'),
            'semestre_letivo' => $request->input('semestre_letivo'),
            'nome_estagiario' => $request->input('nome_estagiario'),
            'periodo' => $request->input('periodo'),
            'curso' => $request->input('curso'),
            'componente_curricular' => $request->input('componente_curricular'),
            'prof_componente_curricular' => $request->input('prof_componente_curricular'),
            'prof_orientador' => $request->input('prof_orientador'),
            'local_estagio' => $request->input('local_estagio'),
            'supervisor_estagio' => $request->input('supervisor_estagio')
        ];

        return $pdf->editImage(4, $dados);
    }
}
