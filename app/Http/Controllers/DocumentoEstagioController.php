<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Aluno;
use App\Models\Curso;
use App\Models\Disciplina;
use App\Models\DocumentoEstagio;
use App\Models\Estagio;
use App\Models\Instituicao;
use App\Models\ListaDocumentosObrigatorios;
use App\Models\Orientador;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DocumentoEstagioController extends Controller
{

    public function termo_compromisso_form($id, Request $request)
    {
        $estagio = Estagio::findOrFail($id);
        $aluno = Aluno::findOrFail($estagio->aluno_id);
        $instituicao = Instituicao::findOrFail($estagio->instituicao_id);
        $orientador = Orientador::findOrFail($estagio->orientador_id);

        $id_estagio = $estagio->id;

        if ($request->query("edit") == true) {
            $documento = DocumentoEstagio::where('estagio_id', $id_estagio)
                ->where('lista_documentos_obrigatorios_id', 2)
                ->first();

            $dados = json_decode($documento->dados, true);
            return view('Estagio.documentos.UPE.termo_de_compromisso', compact("estagio", "aluno", "instituicao", "orientador", "dados"));
        }

        return view('Estagio.documentos.UPE.termo_de_compromisso', compact("estagio", "aluno", "instituicao", "orientador"));
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
            'hora_inicial' => $request->input('hora_inicial'),
            'hora_final' => $request->input('hora_final'),
            'quant_semanas' => $request->input('quant_semanas'),
            'data_inicio' => $request->input('data_inicio'),
            'data_fim' => $request->input('data_fim'),
        ];

        // dd($dados);

        return $pdf->editImage(2, $dados);
    }

    public function termo_encaminhamento_form($id, Request $request)
    {
        $estagio = Estagio::findOrFail($id);
        $aluno = Aluno::findOrFail($estagio->aluno_id);

        $id_estagio = $estagio->id;

        if ($request->query("edit") == true) {
            $documento = DocumentoEstagio::where('estagio_id', $id_estagio)
                ->where('lista_documentos_obrigatorios_id', 1)
                ->first();

            $dados = json_decode($documento->dados, true);

            return view('Estagio.documentos.UPE.termo_de_encaminhamento', compact("estagio", "aluno", "dados"));
        }
        //dd($estagio);
        return view('Estagio.documentos.UPE.termo_de_encaminhamento', compact("estagio", "aluno"));
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


    public function plano_de_atividades_form($id, Request $request)
    {
        $estagio = Estagio::findOrFail($id);
        $aluno = Aluno::findOrFail($estagio->aluno_id);
        $orientador = Orientador::findOrFail($estagio->orientador_id);


        $id_estagio = $estagio->id;

        if ($request->query("edit") == true) {
            $documento = DocumentoEstagio::where('estagio_id', $id_estagio)
                ->where('lista_documentos_obrigatorios_id', 3)
                ->first();

            $dados = json_decode($documento->dados, true);

            return view('Estagio.documentos.UPE.plano_de_atividades', compact("estagio", "aluno", "dados", "orientador"));
        }

        return view('Estagio.documentos.UPE.plano_de_atividades', compact("estagio", "aluno", "orientador"));
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
            'instituicao' => $request->input('instituicao'),
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
            'anoInfantil' => $request->input('anoInfantil'),
            'anoFundamental' => $request->input('anoFundamental'),
            'anoMedio' => $request->input('anoMedio'),
            'modalidade' => $request->input('modalidade'),
            //PROGRAMA DE ESTAGIO
            'semestreLetivo' => $request->input('semestreLetivo'),
            'componenteCurricular' => $request->input('componenteCurricular'),
            'professorComponenteCurricular' => $request->input('professorComponenteCurricular'),
            'professorOrientador' => $request->input('professorOrientador'),
            'periodoVigencia' => $request->input('periodoVigencia'),
            'cargaHorariaSemanal' => $request->input('cargaHorariaSemanal'),
            'diasRealizacao' => $request->input('diasRealizacao'),
            'horario' => $request->input('horario'),
            'objetivosEstagio' => $request->input('objetivosEstagio'),
        ];

        return $pdf->editImage(3, $dados);
    }

    public function ficha_frequencia_form($id, Request $request)
    {
        $estagio = Estagio::findOrFail($id);
        $aluno = Aluno::findOrFail($estagio->aluno_id);
        $orientador = Orientador::findOrFail($estagio->orientador_id);

        $id_estagio = $estagio->id;

        if ($request->query("edit") == true) {
            $documento = DocumentoEstagio::where('estagio_id', $id_estagio)
                ->where('lista_documentos_obrigatorios_id', 4)
                ->first();
            $dados = json_decode($documento->dados, true);
            return view('Estagio.documentos.UPE.ficha_frequencia', compact("estagio", "aluno", "dados", "orientador"));
        }

        return view('Estagio.documentos.UPE.ficha_frequencia', compact("estagio", "aluno", "orientador"));
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

    public function frequencia_residente_form($id, Request $request)
    {
        $estagio = Estagio::findOrFail($id);
        $aluno = Aluno::findOrFail($estagio->aluno_id);

        $id_estagio = $estagio->id;

        if ($request->query("edit") == true) {
            $documento = DocumentoEstagio::where('estagio_id', $id_estagio)
                ->where('lista_documentos_obrigatorios_id', 7)
                ->first();
            $dados = json_decode($documento->dados, true);
            return view('Estagio.documentos.UPE.frequencia_residente', compact("estagio", "aluno", "dados"));
        }
        return view('Estagio.documentos.UPE.frequencia_residente', compact("estagio", "aluno"));
    }

    public function frequencia_residente(Request $request)
    {
        $pdf = new PDFController;
        $dados = [
            'residente' => $request->input('residente'),
            'curso' => $request->input('curso'),
            'unidade' => $request->input('unidade'),
            'nomeConcedente' => $request->input('nomeConcedente'),
            'etapaEducacaoBasica' => $request->input('etapaEducacaoBasica'),
            'ano' => $request->input('ano'),
            'nomeProf' => $request->input('nomeProf'),
            'numMatricula' => $request->input('numMatricula')
        ];

        return $pdf->editImage(7, $dados);
    }


    public function relatorio_acompanhamento_campo_form($id, Request $request)
    {
        $estagio = Estagio::findOrFail($id);
        $aluno = Aluno::findOrFail($estagio->aluno_id);
        $orientador = Orientador::findOrFail($estagio->orientador_id);

        $id_estagio = $estagio->id;

        if ($request->query("edit") == true) {
            $documento = DocumentoEstagio::where('estagio_id', $id_estagio)
                ->where('lista_documentos_obrigatorios_id', 5)
                ->first();

            $dados = json_decode($documento->dados, true);
            return view('Estagio.documentos.UPE.relatorio_acompanhamento_campo', compact("estagio", "aluno", "dados", "orientador"));
        }

        return view('Estagio.documentos.UPE.relatorio_acompanhamento_campo', compact("estagio", "aluno", "orientador"));
    }

    public function relatorio_acompanhamento_campo(Request $request)
    {
        $pdf = new PDFController;
        $dados = [
            'curso' => $request->input('curso'),
            'semestre' => $request->input('semestre'),
            'orientador' => $request->input('orientador'),
            'instituicao' => $request->input('instituicao'),
            'natureza' => $request->input('natureza'),
            'endereco' => $request->input('endereco'),
            'num' => $request->input('num'),
            'complemento' => $request->input('complemento'),
            'fone1' => $request->input('fone1'),
            'cep' => $request->input('cep'),
            'bairro' => $request->input('bairro'),
            'cidade' => $request->input('cidade'),
            'estado' => $request->input('estado'),
            'representante' => $request->input('representante'),
            'cargo_representante' => $request->input('cargo_representante'),
            'supervisor' => $request->input('supervisor'),
            'cargo_supervisor' => $request->input('cargo_supervisor'),
            'formacao_supervisor' => $request->input('formacao_supervisor'),
            'fone2' => $request->input('fone2'),
            'email_supervisor' => $request->input('email_supervisor'),
            'educacao' => $request->input('educacao'),
            'modalidade' => $request->input('modalidade'),
            'etapa' => $request->input('etapa'),
            'entrevistados' => $request->input('entrevistados'),
            'complementares' => $request->input('complementares'),

            'estag1' => $request->input('estag1') ?: ' ', 'turma1' => $request->input('turma1') ?: ' ', 'turno1' => $request->input('turno1') ?: ' ',
            'estag2' => $request->input('estag2') ?: ' ', 'turma2' => $request->input('turma2') ?: ' ', 'turno2' => $request->input('turno2') ?: ' ',
            'estag3' => $request->input('estag3') ?: ' ', 'turma3' => $request->input('turma3') ?: ' ', 'turno3' => $request->input('turno3') ?: ' ',
            'estag4' => $request->input('estag4') ?: ' ', 'turma4' => $request->input('turma4') ?: ' ', 'turno4' => $request->input('turno4') ?: ' ',
            'estag5' => $request->input('estag5') ?: ' ', 'turma5' => $request->input('turma5') ?: ' ', 'turno5' => $request->input('turno5') ?: ' ',
            'estag6' => $request->input('estag6') ?: ' ', 'turma6' => $request->input('turma6') ?: ' ', 'turno6' => $request->input('turno6') ?: ' ',
            'estag7' => $request->input('estag7') ?: ' ', 'turma7' => $request->input('turma7') ?: ' ', 'turno7' => $request->input('turno7') ?: ' ',
            'estag8' => $request->input('estag8') ?: ' ', 'turma8' => $request->input('turma8') ?: ' ', 'turno8' => $request->input('turno8') ?: ' ',
            'estag9' => $request->input('estag9') ?: ' ', 'turma9' => $request->input('turma9') ?: ' ', 'turno9' => $request->input('turno9') ?: ' ',
            'estag10' => $request->input('estag10') ?: ' ', 'turma10' => $request->input('turma10') ?: ' ', 'turno10' => $request->input('turno10') ?: ' ',

            'opc1' => $request->input('opc1'),
            'opc2' => $request->input('opc2'),
            'opc3' => $request->input('opc3'),
            'opc4' => $request->input('opc4'),
            'opc5' => $request->input('opc5'),

            '3_l1' => $request->input('3_l1'),
            '3_l2' => $request->input('3_l2'),
            '3_l3' => $request->input('3_l3'),

            '4_l1' => $request->input('4_l1'),
            '4_l2' => $request->input('4_l2'),
            '4_l3' => $request->input('4_l3'),
            '4_l4' => $request->input('4_l4'),

            '5_l1' => $request->input('5_l1'),
            '5_l2' => $request->input('5_l2'),
            '5_l3' => $request->input('5_l3'),
            '5_l4' => $request->input('5_l4'),

            '6_l1' => $request->input('6_l1'),
            '6_l2' => $request->input('6_l2'),
            '6_l3' => $request->input('6_l3'),
            '6_l4' => $request->input('6_l4'),
        ];

        return $pdf->editImage(5, $dados);
    }

    public function relatorio_supervisor_form($id)
    {

        $estagio = Estagio::findOrFail($id);

        return view('Estagio.documentos.UPE.relatorio_supervisor', compact("estagio"));
    }

    public function relatorio_supervisor($id, Request $request)
    {
        try {
            DB::beginTransaction();

            $estagio = Estagio::findOrFail($id);
            $aluno = Aluno::findOrFail($estagio->aluno_id);

            $pdfController = new PDFController();
            $listaDocumentosId = $pdfController->getListaDeDocumentosId();

            $documento = DocumentoEstagio::where('estagio_id', $estagio->id)
                ->where('aluno_id', $aluno->id)
                ->where('lista_documentos_obrigatorios_id', $listaDocumentosId)
                ->first();

            if ($documento) {
                $arquivo_pdf = $request->file('arquivo');

                $arquivo_pdf_blob = $arquivo_pdf->get();

                $documento->pdf = $arquivo_pdf_blob;

                return redirect()->route('estagio.documentos', ['id' => $id])->with('success', 'Documento anexado com sucesso.');
            } else {
                $documento = new DocumentoEstagio();
                $documento->aluno_id = $aluno->id;

                $arquivo_pdf = $request->file('arquivo');
                // dd($arquivo_pdf);

                $arquivo_pdf_blob = $arquivo_pdf->get();
                $documento->pdf = base64_encode($arquivo_pdf_blob);

                $documento->lista_documentos_obrigatorios_id = $listaDocumentosId;
                $documento->dados = null;
                $documento->estagio_id = $estagio->id;
                $documento->is_completo = True;
                $documento->status = 'Aguardando verificação';
            }

            $documento->save();
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            dd($e);
        }

        return redirect()->route('estagio.documentos', ['id' => $id])->with('success', 'Documento anexado com sucesso.');
    }

    public function seguro_ufape_form($id)
    {
        $estagio = Estagio::findOrFail($id);
        $aluno = Aluno::findOrfail($estagio->aluno_id);
        $curso = Curso::findOrfail($aluno->curso_id);


        $documento = DocumentoEstagio::where('estagio_id', $estagio->id)
            ->where('lista_documentos_obrigatorios_id', 8)
            ->first();
        if ($documento) {
            $documento->is_visualizado = 1;
            $documento->save();

            $dados = json_decode($documento->dados, true);

            return view('Estagio.documentos.UFAPE.seguro', compact("estagio", "dados"));
        } else {
            return view('Estagio.documentos.UFAPE.seguro', compact("estagio", "aluno", "curso"));
        }
    }

    public function seguro_ufape($id, Request $request)
    {
        $dados = [
            'email' => $request->input('email'),
            'aluno_nome' => $request->input('aluno_nome'),
            'cpf' => $request->input('cpf'),
            'data_nascimento' => $request->input('data_nascimento'),
            'sexo' => $request->input('sexo'),
            'curso' => $request->input('curso'),
            'inicio_estagio' => $request->input('inicio_estagio'),
            'termino_estagio' => $request->input('termino_estagio'),
            'local_estagio' => $request->input('local_estagio'),
            'supervisor_estagio' => $request->input('supervisor_estagio'),
            'email_supervisor' => $request->input('email_supervisor'),
            'email_orientador' => $request->input('email_orientador'),
        ];


        $estagio = Estagio::findorfail($id);
        $alunoid = $estagio->aluno_id;

        $doc = DocumentoEstagio::where('estagio_id', $id)
            ->where('aluno_id', $alunoid)
            ->first();

        if ($doc) {
            $doc->dados = json_encode($dados);
            $doc->save();
        } else {
            $documento = new DocumentoEstagio();
            $documento->aluno_id = $alunoid;
            $documento->pdf = null;
            $documento->lista_documentos_obrigatorios_id = 8;
            $documento->dados = json_encode($dados);
            $documento->estagio_id = $id;
            $documento->is_completo = 1;
            $documento->status = "Aguardando verificação";
            $documento->save();
        }

        return redirect()->route('estagio.documentos', ['id' => $id]);
    }

    public function termo_compromisso_ufape_form($id, Request $request)
    {
        $estagio = Estagio::findOrFail($id);
        $aluno = Aluno::findOrFail($estagio->aluno_id);
        $disciplina = Disciplina::findOrFail($estagio->disciplina_id);
        $curso = Curso::findOrFail($estagio->curso_id);

        $id_estagio = $estagio->id;

        $tipo_curso = explode(" ", $curso->nome)[0];

        if ($request->query("edit") == true) {
            $documento = DocumentoEstagio::where('estagio_id', $id_estagio)
                ->where('lista_documentos_obrigatorios_id', 9)
                ->first();

            $dados = json_decode($documento->dados, true);
            
            if($tipo_curso == "Bacharelado"){
                return view('Estagio.documentos.UFAPE.termo_de_compromisso_bach', compact("estagio", "aluno", "curso", "disciplina", "dados"));
            } elseif($tipo_curso == "Licenciatura"){
                return view('Estagio.documentos.UFAPE.termo_de_compromisso_lic', compact("estagio", "aluno", "curso", "disciplina", "dados"));
            }
        }
        
        if($tipo_curso == "Bacharelado"){
            return view('Estagio.documentos.UFAPE.termo_de_compromisso_bach', compact("estagio", "aluno", "curso", "disciplina"));
        } elseif($tipo_curso == "Licenciatura"){
            return view('Estagio.documentos.UFAPE.termo_de_compromisso_lic', compact("estagio", "aluno", "curso", "disciplina"));
        }
        }

    public function termo_compromisso_ufape(Request $request)
    {
        $curso = $request->input('aluno_curso');
        $tipo_curso = explode(" ", $curso)[0];

        $pdf = new PDFController;
        $dados = null;

        $data_inicio_formatada = Carbon::parse($request->input('data_inicio'))->format('d-m-Y');
        $data_fim_formatada = Carbon::parse($request->input('data_fim'))->format('d-m-Y');

        if($tipo_curso = "Bacharelado"){
            $dados = [
                //Concedente
                'nome_concedente' => $request->input('nome_concedente'),
                'cnpj' => $request->input('cnpj'),
                'endereco_concedente' => $request->input('endereco_concedente'),
                'bairro_concedente' => $request->input('bairro_concedente'),
                'cep_concedente' => $request->input('cep_concedente'),
                'cidade_concedente' => $request->input('estado_concedente'),
                'estado_concedente' => $request->input('estado_concedente'),
                'representante' => $request->input('representante'),
                'representante_cargo' => $request->input('representante_cargo'),
                'representante_email' => $request->input('representante_email'),
                'representante_telefone' => $request->input('representante_telefone'),
    
                //Aluno
                'nome_aluno' => $request->input('nome_aluno'),
                'cpf' => $request->input('cpf'),
                'rg' => $request->input('rg'),
                'org_expedicao' => $request->input('org_expedicao'),
                'nascimento' => $request->input('nascimento'),
                'endereco' => $request->input('endereco'),
                'bairro' => $request->input('bairro'),
                'cep' => $request->input('cep'),
                'cidade' => $request->input('estado'),
                'estado' => $request->input('estado'),
                'email' => $request->input('email'),
                'telefone' => $request->input('telefone'),
    
                //Cláusula 2
                'aluno_curso' => $request->input('aluno_curso'),
                'disciplina' => $request->input('disciplina'),
                'periodo' => $request->input('periodo'),
    
                //Cláusula 3
                'departamento' => $request->input('departamento'),
                
                'data_inicio' => $data_inicio_formatada,
                'data_fim' => $data_fim_formatada,
    
                'segunda_ufape' => in_array('segunda', $request->input('dias_ufape', [])),
                'terca_ufape' => in_array('terca', $request->input('dias_ufape', [])),
                'quarta_ufape' => in_array('quarta', $request->input('dias_ufape', [])),
                'quinta_ufape' => in_array('quinta', $request->input('dias_ufape', [])),
                'sexta_ufape' => in_array('sexta', $request->input('dias_ufape', [])),
    
    
                'horario_ufape_segunda' => $request->input('horario_ufape_segunda') ?? null,
                'horario_ufape_terca' => $request->input('horario_ufape_terca') ?? null,
                'horario_ufape_quarta' => $request->input('horario_ufape_quarta') ?? null,
                'horario_ufape_quinta' => $request->input('horario_ufape_quinta') ?? null,
                'horario_ufape_sexta' => $request->input('horario_ufape_sexta') ?? null,
    
                'carga_horaria_total' => $request->input('carga_horaria_total'),
                //Cláusula 4
                'atividades_estagiario' => $request->input('atividades_estagiario'),
    
                //Cláusula 8
                'orientador' => $request->input('orientador'),
    
                //Cláusula 9
                'supervisor_nome' => $request->input('supervisor_nome'),
                'supervisor_cargo' => $request->input('supervisor_cargo'),
                'tipo_curso' => "Bacharelado",
            ];
        } elseif ($tipo_curso = "Licenciatura"){
            $dados = [
                //Concedente
                'nome_concedente' => $request->input('nome_concedente'),
                'cnpj' => $request->input('cnpj'),
                'endereco_concedente' => $request->input('endereco_concedente'),
                'bairro_concedente' => $request->input('bairro_concedente'),
                'cep_concedente' => $request->input('cep_concedente'),
                'cidade_concedente' => $request->input('estado_concedente'),
                'estado_concedente' => $request->input('estado_concedente'),
                'representante' => $request->input('representante'),
                'representante_cargo' => $request->input('representante_cargo'),
                'representante_email' => $request->input('representante_email'),
                'representante_telefone' => $request->input('representante_telefone'),
    
                //Aluno
                'nome_aluno' => $request->input('nome_aluno'),
                'cpf' => $request->input('cpf'),
                'rg' => $request->input('rg'),
                'org_expedicao' => $request->input('org_expedicao'),
                'nascimento' => $request->input('nascimento'),
                'endereco' => $request->input('endereco'),
                'bairro' => $request->input('bairro'),
                'cep' => $request->input('cep'),
                'cidade' => $request->input('estado'),
                'estado' => $request->input('estado'),
                'email' => $request->input('email'),
                'telefone' => $request->input('telefone'),
    
                //Cláusula 2
                'aluno_curso' => $request->input('aluno_curso'),
                'disciplina' => $request->input('disciplina'),
                'periodo' => $request->input('periodo'),
    
                //Cláusula 3
                'departamento' => $request->input('departamento'),
    
                'data_inicio' => $data_inicio_formatada,
                'data_fim' => $data_fim_formatada,
    
                'segunda_ufape' => in_array('segunda', $request->input('dias_ufape', [])),
                'terca_ufape' => in_array('terca', $request->input('dias_ufape', [])),
                'quarta_ufape' => in_array('quarta', $request->input('dias_ufape', [])),
                'quinta_ufape' => in_array('quinta', $request->input('dias_ufape', [])),
                'sexta_ufape' => in_array('sexta', $request->input('dias_ufape', [])),
    
    
                'horario_ufape_segunda' => $request->input('horario_ufape_segunda') ?? null,
                'horario_ufape_terca' => $request->input('horario_ufape_terca') ?? null,
                'horario_ufape_quarta' => $request->input('horario_ufape_quarta') ?? null,
                'horario_ufape_quinta' => $request->input('horario_ufape_quinta') ?? null,
                'horario_ufape_sexta' => $request->input('horario_ufape_sexta') ?? null,
    
                'segunda_estagio' => in_array('segunda', $request->input('dias_estagio', [])),
                'terca_estagio' => in_array('terca', $request->input('dias_estagio', [])),
                'quarta_estagio' => in_array('quarta', $request->input('dias_estagio', [])),
                'quinta_estagio' => in_array('quinta', $request->input('dias_estagio', [])),
                'sexta_estagio' => in_array('sexta', $request->input('dias_estagio', [])),
    
    
                'horario_estagio_segunda' => $request->input('horario_estagio_segunda') ?? null,
                'horario_estagio_terca' => $request->input('horario_estagio_terca') ?? null,
                'horario_estagio_quarta' => $request->input('horario_estagio_quarta') ?? null,
                'horario_estagio_quinta' => $request->input('horario_estagio_quinta') ?? null,
                'horario_estagio_sexta' => $request->input('horario_estagio_sexta') ?? null,
    
                'carga_horaria_total' => $request->input('carga_horaria_total'),
                //Cláusula 4
                'atividades_estagiario' => $request->input('atividades_estagiario'),
    
                //Cláusula 8
                'orientador' => $request->input('orientador'),
    
                //Cláusula 9
                'supervisor_nome' => $request->input('supervisor_nome'),
                'supervisor_cargo' => $request->input('supervisor_cargo'),
                'tipo_curso' => "Licenciatura",
            ];
        }

        return $pdf->editImage(9, $dados);
    }

    public function carta_aceite_supervisor_ufape_form($id)
    {
        $estagio = Estagio::findOrFail($id);

        return view('Estagio.documentos.UFAPE.carta_aceite_supervisor', compact("estagio"));
    }

    public function carta_aceite_supervisor_ufape($id, Request $request)
    {
        // dd($request->file('arquivo'));

        try {
            DB::beginTransaction();

            $estagio = Estagio::findOrFail($id);
            $aluno = Aluno::findOrFail($estagio->aluno_id);

            // $pdfController = new PDFController();
            // $listaDocumentosId = $pdfController->getListaDeDocumentosId();
            $listaDocumentosId = 10;

            $documento = DocumentoEstagio::where('estagio_id', $estagio->id)
                ->where('aluno_id', $aluno->id)
                ->where('lista_documentos_obrigatorios_id', $listaDocumentosId)
                ->first();

            if ($documento) {
                $arquivo_pdf = $request->file('arquivo');

                $arquivo_pdf_blob = $arquivo_pdf->get();

                $documento->pdf = $arquivo_pdf_blob;

                return redirect()->route('estagio.documentos', ['id' => $id])->with('success', 'Documento anexado com sucesso.');
            } else {
                $documento = new DocumentoEstagio();
                $documento->aluno_id = $aluno->id;

                $arquivo_pdf = $request->file('arquivo');
                // dd($arquivo_pdf);

                $arquivo_pdf_blob = $arquivo_pdf->get();
                $documento->pdf = base64_encode($arquivo_pdf_blob);

                $documento->lista_documentos_obrigatorios_id = $listaDocumentosId;
                $documento->dados = null;
                $documento->estagio_id = $estagio->id;
                $documento->is_completo = True;
                $documento->status = 'Aguardando verificação';
            }

            $documento->save();
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            dd($e);
        }

        return redirect()->route('estagio.documentos', ['id' => $id])->with('success', 'Documento anexado com sucesso.');
    }

    public function ficha_frequencia_ufape_form($id, Request $request)
    {
        $estagio = Estagio::findOrFail($id);
        $aluno = Aluno::findOrFail($estagio->aluno_id);
        $curso = Curso::findOrFail($aluno->curso_id);
        $id_estagio = $estagio->id;

        if ($request->query("edit") == true) {
            $documento = DocumentoEstagio::where('estagio_id', $id_estagio)
                ->where('lista_documentos_obrigatorios_id', 11)
                ->first();

            $dados = json_decode($documento->dados, true);
            return view('Estagio.documentos.UFAPE.ficha_frequencia', compact("estagio", "aluno", "curso", "dados"));
        }

        return view('Estagio.documentos.UFAPE.ficha_frequencia', compact("estagio", "aluno", "curso"));
    }

    public function ficha_frequencia_ufape(Request $request)
    {

        $pdf = new PDFController;
        $dados = [
            'instituicao' => $request->input('instituicao'),
            'nome_estagiario' => $request->input('nome_estagiario'),
            'unidade' => $request->input('unidade'),
            'empresa' => $request->input('empresa'),
            'mes_ano_ref' => $request->input('mes_ano_ref'),
            'matricula' => $request->input('matricula'),
            'cnpj' => $request->input('cnpj'),
            'curso' => $request->input('curso'),
            'tipo' => $request->input('checkTipo')
        ];

        return $pdf->editImage(11, $dados);
    }

    public function termo_aditivo_ufape_form($id, Request $request)
    {
        $estagio = Estagio::findOrFail($id);
        $aluno = Aluno::findOrFail($estagio->aluno_id);
        $curso = Curso::findOrFail($aluno->curso_id);
        $id_estagio = $estagio->id;

        if ($request->query("edit") == true) {
            $documento = DocumentoEstagio::where('estagio_id', $id_estagio)
                ->where('lista_documentos_obrigatorios_id', 12)
                ->first();

            $dados = json_decode($documento->dados, true);
            return view('Estagio.documentos.UFAPE.termo_aditivo', compact("estagio", "aluno", "curso", "dados"));
        }

        return view('Estagio.documentos.UFAPE.termo_aditivo', compact("estagio", "aluno", "curso"));
    }

    public function termo_aditivo_ufape(Request $request)
    {

        $pdf = new PDFController;
        $data = $request->input('data_nasc');
        $data = date('d/m/Y', strtotime($data));

        $dados = [
            //concedente
            'concedente' => $request->input('concedente'),
            'cnpj_c' => $request->input('cnpj_c'),
            'endereco_c' => $request->input('endereco_c'),
            'bairro_c' => $request->input('bairro_c'),
            'cep_c' => $request->input('cep_c'),
            'cidade_c' => $request->input('cidade_c'),
            'estado_c' => $request->input('estado_c'),
            'representante_c' => $request->input('representante_c'),
            'cargo_c' => $request->input('cargo_c'),
            'email_c' => $request->input('email_c'),
            'telefone_c' => $request->input('telefone_c'),
            //estagiario
            'nome_aluno' => $request->input('nome_aluno'),
            'cpf' => $request->input('cpf'),
            'rg' => $request->input('rg'),
            'orgao_expd_uf' => $request->input('orgao_expd_uf'),

            'data_nasc' => $data,
            'endereco_e' => $request->input('endereco_e'),
            'bairro_e' => $request->input('bairro_e'),
            'cep_e' => $request->input('cep_e'),
            'cidade_e' => $request->input('cidade_e'),
            'estado_e' => $request->input('estado_e'),
            'email_e' => $request->input('email_e'),
            'telefone_e' => $request->input('telefone_e'),
            'redacao' => $request->input('redacao')
        ];

        return $pdf->editImage(12, $dados);
    }

    public function declaracao_ch_ufape_form($id, Request $request)
    {
        $estagio = Estagio::findOrFail($id);
        $aluno = Aluno::findOrFail($estagio->aluno_id);
        $curso = Curso::findOrFail($aluno->curso_id);
        $id_estagio = $estagio->id;

        if ($request->query("edit") == true) {
            $documento = DocumentoEstagio::where('estagio_id', $id_estagio)
                ->where('lista_documentos_obrigatorios_id', 13)
                ->first();

            $dados = json_decode($documento->dados, true);
            return view('Estagio.documentos.UFAPE.declaracao_ch_eso', compact("estagio", "aluno", "curso", "dados"));
        }

        return view('Estagio.documentos.UFAPE.declaracao_ch_eso', compact("estagio", "aluno", "curso"));
    }

    public function declaracao_ch_ufape(Request $request)
    {

        $pdf = new PDFController;

        $request->validate([
            'logomarca_empresa' => 'required|image|mimes:png,jpg,jpeg|max:2048'
        ]);

        //dd($request->logomarca_empresa);
        $imageName = time() . '.' . $request->logomarca_empresa->extension();

        $request->logomarca_empresa->move(storage_path('app/docs/UFAPE/logomarca_tmp'), $imageName);

        //$imagem = $request->file('logomarca_empresa');


        $dados = [
            'logomarca_empresa' => $imageName,
            'aluno' => $request->input('aluno'),
            'cpf_aluno' => $request->input('cpf_aluno'),
            'tipo_curso' => $request->input('tipo_curso'),
            'curso' => $request->input('curso'),
            'empresa' => $request->input('empresa'),
            'data_inicio' => $request->input('data_inicio'),
            'data_fim' => $request->input('data_fim'),
            'carga_horaria' => $request->input('carga_horaria'),

        ];

        return $pdf->editImage(13, $dados);
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

    public function documento_completo_form($id)
    {
        $documento = DocumentoEstagio::findOrFail($id);
        $lista_documento = ListaDocumentosObrigatorios::findOrFail($documento->lista_documentos_obrigatorios_id);

        return view('Estagio.documentos.documento_completo', compact("documento", "lista_documento"));
    }

    public function documento_completo($id, Request $request)
    {
        try {
            DB::beginTransaction();

            $documento = DocumentoEstagio::findOrFail($id);
            // dd($documento);
            $arquivo_pdf = $request->file('arquivo');

            $arquivo_pdf_blob = $arquivo_pdf->get();

            $documento->pdf = $arquivo_pdf_blob;

            $documento->is_completo = True;
            $documento->status = 'Aguardando verificação';

            $documento->save();
            DB::commit();

            return redirect()->route('estagio.documentos', ['id' => $documento->estagio_id])->with('success', 'Documento enviado com sucesso.');
        } catch (Exception $e) {
            DB::rollBack();
            dd($e);
        }
    }

    // public function observacao_show($id)
    // {
    //     $doc = DocumentoEstagio::Where('id', $id)->first();

    //     return view('Estagio.documentos.showObservacao', compact('doc'));
    // }

    public function observacao_edit($id)
    {
        $doc = DocumentoEstagio::Where('id', $id)->first();
        return view('Estagio.documentos.editObservacao', compact('doc'));
    }

    public function observacao_update(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $doc = DocumentoEstagio::find($id);
            $doc->observacao = $request->observacao  ? $request->observacao  : $doc->observacao;

            $doc->update();

            DB::commit();

            return redirect()->route('estagio.documentos', ['id' => $doc->estagio_id])
                ->with('sucesso', 'Observação editado com sucesso.');
        } catch (exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors("Falha ao editar Observação. tente novamente mais tarde.");
        }
    }

    public function download($nome, $id)
    {
        $estagio = Estagio::findorfail($id);

        $aluno = Aluno::findorfail($estagio->aluno_id);
        $curso = Curso::findorfail($estagio->curso_id);
        $disciplina = Disciplina::findorfail($estagio->disciplina_id);

        $nome_aluno = $aluno->nome_aluno;
        $nome_curso = $curso->nome;
        $nome_disciplina = $disciplina->nome;
        $tipo_estagio_sigla = $estagio->tipo;

        if ($tipo_estagio_sigla === 'eo') {
            $tipo_estagio = 'Obrigatório';
        } elseif ($tipo_estagio_sigla === 'eno') {
            $tipo_estagio = 'Não Obrigatório';
        }

        $pdfController = new PDFController;

        $path = storage_path('app/docs/relatorio_supervisor/0.png');
        $pdfFilePath = $pdfController->gerarPDF_Supervisor_UPE($path, $nome_aluno, $nome_curso, $nome_disciplina, $tipo_estagio); // Gere o PDF e obtenha o caminho do arquivo

        if ($pdfFilePath === false) {
            return response()->json(['error' => 'Erro ao gerar o PDF'], 500);
        }

        $fileName = $nome . '.pdf';

        return response()->file($pdfFilePath, ['Content-Type' => 'application/pdf', 'Content-Disposition' => "inline; filename=\"$fileName\""]);
    }
}
