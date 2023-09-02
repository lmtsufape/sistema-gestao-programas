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
        return view('Estagio.documentos.plano_de_atividades', compact("estagio", "aluno"));
    }

    public function termo_encaminhamento(Request $request)
    {
        $pdf = new PDFController;
        $dados = [
            //ESTAGIÁRIO 
            'nome' => $request->input('nome'),
            'email' => $request->input('email'),
            'curso' => $request->input('curso'),
            'periodo' => $request->input('periodo'),
            //CAMPO DE ESTÁGIO
            'insituicao' => $request->input('instituicao'),
        ];

        return $pdf->editImage(1, $dados);
    }

    public function plano_de_atividades_form($id)
    {
        $estagio = Estagio::findOrFail($id);
        $aluno = Aluno::findOrFail($estagio->aluno_id);
        return view('Estagio.documentos.plano_de_atividades', compact("estagio", "aluno"));
    }

    public function plano_de_atividades(Request $request)
    {
        $pdf = new PDFController;
        $dados = [
            'nome' => $request->input('nome'),
            'email' => $request->input('email'),
            'curso' => $request->input('curso'),
            'periodo' => $request->input('periodo'),
            //CAMPO DE ESTAGIO
            'instituicao' => $request->input('instituição'),
            'endereco' => $request->input('endereco'),
            'numCasa' => $request->input('numCasa'),
            'complemento' => $request->input('complemento'),
            'fone' => $request->input('fone'),
            'cep' => $request->input('cep'),
            'bairro' => $request->input('bairro'),
            'cidade' => $request->input('cidade'),
            'estado' => $request->input('estado'),
            'pontoReferencia' => $request->input('pontoReferencia'),
            'supervisorEstagio' => $request->input('supervisorEstagio'),
            'FoneSupervisor' => $request->input('FoneSupervisor'),
            'emailSup' => $request->input('emailSup'),
            'cargo' => $request->input('cargo'),
            'educacaoEscolar' => $request->input('educacaoEscolar'),
            'educacaoNaoEscolar' => $request->input('educacaoNaoEscolar'),
            'modalidade' => $request->input('modalidade'),
            //PROGRAMA DE ESTAGIO
            'semestreLetivo' => $request->input('semestreLetivo'),
            'componenteCurricular' => $request->input('componenteCurricular'),
            'professorComponenteCurricular' => $request->input('professorComponenteCurricular'),
            'professorOrientador' => $request->input('professorOrientador'),
            'cargaHorariaSemanal' => $request->input('cargaHorariaSemanal'),
            'diasRealizacao' => $request->input('diasRealizacao'),
            'horario' => $request->input('horario'),
        ];

        return $pdf->editImage(3, $dados);
    }
}
