<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Aluno;
use App\Models\DocumentoEstagio;
use App\Models\Estagio;
use App\Models\Instituicao;
use App\Models\Orientador;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DocumentoEstagioController extends Controller
{

    public function edit($id)
    {
        $documento = DocumentoEstagio::findOrFail($id);
        return view('Estagio.documentos.editDocumento', compact('documento'));
    }

    public function update($dados, $id)
    {
        $documento = DocumentoEstagio::Where('id', $id)->first();

        // terá um método para cada documento, esse switchcase servirá para selecionar o método especifico de cada documento.
        switch ($id) {
                //termo de encaminhamento
            case 1:
                $documentPath1 = storage_path('app/docs/termo_encaminhamento/0.png');
                $documentPath2 = storage_path('app/docs/termo_encaminhamento/1.png');
                return $this->editTermoEncaminhamento([$documentPath1, $documentPath2], $dados);
                break;
                //termo de compromisso
            case 2:
                $documentPath1 = storage_path('app/docs/termo_compromisso/0.png');
                $documentPath2 = storage_path('app/docs/termo_compromisso/1.png');
                return $this->editTermoCompromisso([$documentPath1, $documentPath2], $dados);
                break;
            default:
                return redirect()->back()->with('error', 'Tipo de documento desconhecido.');
        }

        $documento->save();
    }


    public function termo_compromisso_form($id, Request $request)
    {
        $estagio = Estagio::findOrFail($id);
        $aluno = Aluno::findOrFail($estagio->aluno_id);
        $instituicao = Instituicao::findOrFail($estagio->instituicao_id);
        $orientador = Orientador::findOrFail($estagio->orientador_id);

        if ($request->query("edit") == true) {
            $documento = DocumentoEstagio::findOrFail(2);
            $dados = json_decode($documento->dados, true);
            return view('Estagio.documentos.termo_de_compromisso', compact("estagio", "aluno", "instituicao", "orientador", "dados"));
        }

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

    public function termo_encaminhamento_form($id, Request $request)
    {
        $estagio = Estagio::findOrFail($id);
        $aluno = Aluno::findOrFail($estagio->aluno_id);
      
        if ($request->query("edit") == true ) {
            $documento = DocumentoEstagio::findOrFail(1);
            $dados = json_decode($documento->dados, true);
            
            return view('Estagio.documentos.termo_de_encaminhamento', compact("estagio", "aluno", "dados"));
        }
        //dd($estagio);
        return view('Estagio.documentos.termo_de_encaminhamento', compact("estagio", "aluno"));
    }

    public function termo_encaminhamento(Request $request)
    {
        $pdf = new PDFController;
        $dados = [
            'instituicao' => $request->input('instituicao'),
            'nome' => $request->input('nome'),
            'email' => $request->input('email'),
            'curso' => $request->input('curso'),
            'periodo' => $request->input('periodo'),
            //CAMPO DE ESTÁGIO
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
  
    public function ficha_frequencia_form($id, Request $request)
    {
        $estagio = Estagio::findOrFail($id);
        $aluno = Aluno::findOrFail($estagio->aluno_id);

        if ($request->query("edit") == true) {
            $documento = DocumentoEstagio::findOrFail(4);
            $dados = json_decode($documento->dados, true);
            return view('Estagio.documentos.ficha_frequencia', compact("estagio", "aluno", "dados"));
        }

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
            'supervisor_estagio' => $request->input('supervisor_estagio'),

            'data1' => $request->input('data1') ?: ' ', 'atividade1' => $request->input('atividade1') ?: ' ', 'ch1' => $request->input('ch1') ?: ' ',
            'data2' => $request->input('data2') ?: ' ', 'atividade2' => $request->input('atividade2') ?: ' ', 'ch2' => $request->input('ch2') ?: ' ',
            'data3' => $request->input('data3') ?: ' ', 'atividade3' => $request->input('atividade3') ?: ' ', 'ch3' => $request->input('ch3') ?: ' ',
            'data4' => $request->input('data4') ?: ' ', 'atividade4' => $request->input('atividade4') ?: ' ', 'ch4' => $request->input('ch4') ?: ' ',
            'data5' => $request->input('data5') ?: ' ', 'atividade5' => $request->input('atividade5') ?: ' ', 'ch5' => $request->input('ch5') ?: ' ',
            'data6' => $request->input('data6') ?: ' ', 'atividade6' => $request->input('atividade6') ?: ' ', 'ch6' => $request->input('ch6') ?: ' ',
            'data7' => $request->input('data7') ?: ' ', 'atividade7' => $request->input('atividade7') ?: ' ', 'ch7' => $request->input('ch7') ?: ' ',
            'data8' => $request->input('data8') ?: ' ', 'atividade8' => $request->input('atividade8') ?: ' ', 'ch8' => $request->input('ch8') ?: ' ',
            'data9' => $request->input('data9') ?: ' ', 'atividade9' => $request->input('atividade9') ?: ' ', 'ch9' => $request->input('ch9') ?: ' ',
            'data10' => $request->input('data10') ?: ' ', 'atividade10' => $request->input('atividade10') ?: ' ', 'ch10' => $request->input('ch10') ?: ' ',
            'data11' => $request->input('data11') ?: ' ', 'atividade11' => $request->input('atividade11') ?: ' ', 'ch11' => $request->input('ch11') ?: ' ',
            'data12' => $request->input('data12') ?: ' ', 'atividade12' => $request->input('atividade12') ?: ' ', 'ch12' => $request->input('ch12') ?: ' ',
            'data13' => $request->input('data13') ?: ' ', 'atividade13' => $request->input('atividade13') ?: ' ', 'ch13' => $request->input('ch13') ?: ' ',
            'data14' => $request->input('data14') ?: ' ', 'atividade14' => $request->input('atividade14') ?: ' ', 'ch14' => $request->input('ch14') ?: ' ',
            'data15' => $request->input('data15') ?: ' ', 'atividade15' => $request->input('atividade15') ?: ' ', 'ch15' => $request->input('ch15') ?: ' ',
            'data16' => $request->input('data16') ?: ' ', 'atividade16' => $request->input('atividade16') ?: ' ', 'ch16' => $request->input('ch16') ?: ' ',
            'data17' => $request->input('data17') ?: ' ', 'atividade17' => $request->input('atividade17') ?: ' ', 'ch17' => $request->input('ch17') ?: ' ',
            'data18' => $request->input('data18') ?: ' ', 'atividade18' => $request->input('atividade18') ?: ' ', 'ch18' => $request->input('ch18') ?: ' ',
            'data19' => $request->input('data19') ?: ' ', 'atividade19' => $request->input('atividade19') ?: ' ', 'ch19' => $request->input('ch19') ?: ' ',
            'data20' => $request->input('data20') ?: ' ', 'atividade20' => $request->input('atividade20') ?: ' ', 'ch20' => $request->input('ch20') ?: ' ',
            'data21' => $request->input('data21') ?: ' ', 'atividade21' => $request->input('atividade21') ?: ' ', 'ch21' => $request->input('ch21') ?: ' ',
            'data22' => $request->input('data22') ?: ' ', 'atividade22' => $request->input('atividade22') ?: ' ', 'ch22' => $request->input('ch22') ?: ' ',


            'ch_total' => $request->input('ch_total')
        ];

        return $pdf->editImage(4, $dados);
    }

    public function aprovar_documento($id)
    {
        $documentoEstagio = DocumentoEstagio::find($id);
    
        if (!$documentoEstagio) {
            return redirect()->back()->with('error', 'Documento não encontrado');
        }
    
        $documentoEstagio->status = 'Aprovado';
        $documentoEstagio->save();
    
        return redirect()->back()->with('success', 'Documento aprovado com sucesso');
    }

    public function negar_documento($id)
    {
        $documentoEstagio = DocumentoEstagio::find($id);
    
        if (!$documentoEstagio) {
            return redirect()->back()->with('error', 'Documento não encontrado');
        }
    
        $documentoEstagio->status = 'Negado';
        $documentoEstagio->save();
    
        return redirect()->back()->with('success', 'Documento aprovado com sucesso');
    }

}
