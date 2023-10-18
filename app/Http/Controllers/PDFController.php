<?php

namespace App\Http\Controllers;

use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Models\DocumentoEstagio;
use App\Models\ListaDocumentosObrigatorios;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Exception;
use TCPDF;

class PDFController extends Controller
{
    private const AZUL = '#00009C';
    private const FONT = 'fonts/Arial.ttf';
    private $documentType = 6;

    public function editImage($documentType, $dados)
    {
        $this->documentType = $documentType;

        // terá um método para cada documento, esse switchcase servirá para selecionar o método especifico de cada documento.
        switch ($this->documentType) {
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
                //plano de atividades
            case 3:
                $documentPath = storage_path('app/docs/plano_de_atividades/0.png');
                return $this->editPlanoDeAtividades($documentPath, $dados);
                break;
                //ficha de frequência
            case 4:
                $documentPath = storage_path('app/docs/ficha_frequencia/0.png');
                return $this->editFichaFrequencia([$documentPath], $dados);
                break;
                // Relatório de Acompanhamento do Campo de Estágio
            case 5:
                $documentPath1 = storage_path('app/docs/relatorio_acompanhamento_campo/0.png');
                $documentPath2 = storage_path('app/docs/relatorio_acompanhamento_campo/1.png');
                return $this->editRelatorioCampo([$documentPath1, $documentPath2], $dados);
                break;
                // frequencia_residente
            case 7:
                $documentPath1 = storage_path('app/docs/frequencia_residente/0.png');
                $documentPath2 = storage_path('app/docs/frequencia_residente/1.png');
                return $this->editFrequenciaResidente([$documentPath1, $documentPath2], $dados);
                break;
            default:
                return redirect()->back()->with('error', 'Tipo de documento desconhecido.');
        }
    }

    private function toPDF($images, $dados)
    {
        $pdf = new TCPDF();
        $pdf->SetMargins(0, 0, 0);
        $pdf->SetPrintHeader(false);
        $pdf->setPrintFooter(false);

        $pdf->AddPage();

        foreach ($images as $index => $image) {
            if ($index !== 0) {
                $pdf->AddPage();
            }

            // Salvar a imagem editada temporariamente
            $tmpImagePath = tempnam(sys_get_temp_dir(), 'documento') . '.jpg';
            $image->save($tmpImagePath, 100);

            // Incorporar a imagem no PDF
            $pdf->Image($tmpImagePath, 7, 0, 200);

            unlink($tmpImagePath); // Excluir a imagem temporária após uso
        }

        // // Salvar a imagem editada temporariamente
        // $tmpImagePath = tempnam(sys_get_temp_dir(), 'documento') . '.jpg';
        // $image->save($tmpImagePath, 100);

        // // Incorporar a imagem no PDF
        // $pdf->Image($tmpImagePath, 7, 0, 200);

        // Capturar a saída PDF em uma variável
        ob_start();
        $pdf->Output('documento.pdf', 'I');

        if (config('database.default') === 'pgsql') {
            $pdfContent = ob_get_contents();
            $pdfContent = base64_encode($pdfContent);
        } else {
            $pdfContent = ob_get_contents();
        }

        ob_end_clean();


        try {
            DB::beginTransaction();


            $listaDocumentosId = $this->getListaDeDocumentosId();
            $alunoId = Auth::id();

            $documentoExistente = DocumentoEstagio::where('lista_documentos_obrigatorios_id', $listaDocumentosId)
                ->where('aluno_id', $alunoId)
                ->first();

            if (!$documentoExistente) {
                $documento = new DocumentoEstagio();
                $documento->aluno_id = $alunoId;
                $documento->pdf = $pdfContent;
                $documento->lista_documentos_obrigatorios_id = $listaDocumentosId;
                $documento->dados = json_encode($dados);
                $estagio = new EstagioController();
                $documento->estagio_id = $estagio->getEstagioAtual()->id;
                $documento->save();
            } else {
                $documentoExistente->dados = json_encode($dados);
                $documentoExistente->pdf = $pdfContent;
                $documentoExistente->save();
            }

            DB::commit();
        } catch (\Exception $e) {
            //dd($e);
            //DB::rollBack();
        }

        // Renderizar o PDF no navegador
        //$pdf->Output('documento.pdf', 'I');

        //unlink($tmpImagePath);

        $pdf->close();

        return $pdfContent;
    }

    public function viewPDF($id)
    {
        $documento = DocumentoEstagio::findOrFail($id);

        $documentoObrigatorio = ListaDocumentosObrigatorios::find($documento->lista_documentos_obrigatorios_id);

        $aluno = Auth::user();


        // if ($documento->aluno_id != Auth::id()) {
        //     return redirect()->back()->with('error', 'Você não tem permissão para visualizar este documento.');
        // }

        $pdf = $documento->pdf;

        if (config('database.default') === 'pgsql') {
            $pdf = stream_get_contents($pdf);
            $pdf = base64_decode($pdf);
        }


        $nome_arquivo = $documentoObrigatorio->titulo . '_' . $aluno->name;
        $nome_arquivo = (str_replace(' ', '_', $nome_arquivo));
        $nome_arquivo = strtolower($nome_arquivo);

        $headers = [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => "inline; filename=\"$nome_arquivo.pdf\"",
        ];

        return Response::make($pdf, 200, $headers);
    }

    private function editTermoCompromisso($documentPaths, $dados)
    {
        $image1 = Image::make($documentPaths[0]);

        //INSTITUIÇÃO DE ENSINO
        $image1->text($dados['professorComponenteCurricular'], 730, 915, function ($font) {
            $font->file(resource_path(self::FONT));
            $font->size(37);
            $font->color(self::AZUL);
        });

        $image1->text($dados['instituicaoEmail'], 300, 960, function ($font) {
            $font->file(resource_path(self::FONT));
            $font->size(37);
            $font->color(self::AZUL);
        });

        $image1->text($dados['orientador'], 530, 1000, function ($font) {
            $font->file(resource_path(self::FONT));
            $font->size(37);
            $font->color(self::AZUL);
        });

        $image1->text($dados['emailOrientador'], 295, 1050, function ($font) {
            $font->file(resource_path(self::FONT));
            $font->size(37);
            $font->color(self::AZUL);
        });

        //UNIDADE CONCEDENTE
        $image1->text($dados['instituicaoUnidadeConcedente'], 360, 1146, function ($font) {
            $font->file(resource_path(self::FONT));
            $font->size(37);
            $font->color(self::AZUL);
        });

        $image1->text($dados['cnpj'], 290, 1190, function ($font) {
            $font->file(resource_path(self::FONT));
            $font->size(37);
            $font->color(self::AZUL);
        });

        $image1->text($dados['localEstagio'], 460, 1237, function ($font) {
            $font->file(resource_path(self::FONT));
            $font->size(37);
            $font->color(self::AZUL);
        });

        $image1->text($dados['endereco'], 350, 1282, function ($font) {
            $font->file(resource_path(self::FONT));
            $font->size(37);
            $font->color(self::AZUL);
        });

        $image1->text($dados['numero'], 230, 1325, function ($font) {
            $font->file(resource_path(self::FONT));
            $font->size(37);
            $font->color(self::AZUL);
        });

        $image1->text($dados['complemento'], 797, 1325, function ($font) {
            $font->file(resource_path(self::FONT));
            $font->size(37);
            $font->color(self::AZUL);
        });

        $image1->text($dados['cep'], 267, 1372, function ($font) {
            $font->file(resource_path(self::FONT));
            $font->size(37);
            $font->color(self::AZUL);
        });

        $image1->text($dados['bairro'], 900, 1372, function ($font) {
            $font->file(resource_path(self::FONT));
            $font->size(37);
            $font->color(self::AZUL);
        });

        $image1->text($dados['cidade'], 1473, 1372, function ($font) {
            $font->file(resource_path(self::FONT));
            $font->size(37);
            $font->color(self::AZUL);
        });

        $image1->text($dados['estado'], 2000, 1372, function ($font) {
            $font->file(resource_path(self::FONT));
            $font->size(37);
            $font->color(self::AZUL);
        });

        $image1->text($dados['representanteLegal'], 525, 1420, function ($font) {
            $font->file(resource_path(self::FONT));
            $font->size(37);
            $font->color(self::AZUL);
        });

        $image1->text($dados['cargoRepresentante'], 1610, 1420, function ($font) {
            $font->file(resource_path(self::FONT));
            $font->size(37);
            $font->color(self::AZUL);
        });

        $image1->text($dados['supervisor'], 555, 1465, function ($font) {
            $font->file(resource_path(self::FONT));
            $font->size(37);
            $font->color(self::AZUL);
        });

        $image1->text($dados['cargoSupervisor'], 1605, 1465, function ($font) {
            $font->file(resource_path(self::FONT));
            $font->size(37);
            $font->color(self::AZUL);
        });

        $image1->text($dados['formacaoSupervisor'], 357, 1512, function ($font) {
            $font->file(resource_path(self::FONT));
            $font->size(37);
            $font->color(self::AZUL);
        });

        $image1->text($dados['cpfSupervisor'], 1173, 1512, function ($font) {
            $font->file(resource_path(self::FONT));
            $font->size(37);
            $font->color(self::AZUL);
        });

        $image1->text($dados['emailSupervisor'], 295, 1558, function ($font) {
            $font->file(resource_path(self::FONT));
            $font->size(37);
            $font->color(self::AZUL);
        });

        $image1->text($dados['telefoneSupervisor'], 1397, 1558, function ($font) {
            $font->file(resource_path(self::FONT));
            $font->size(37);
            $font->color(self::AZUL);
        });

        //ESTAGIÁRIO
        $image1->text($dados['nomeAluno'], 288, 1651, function ($font) {
            $font->file(resource_path(self::FONT));
            $font->size(37);
            $font->color(self::AZUL);
        });

        $image1->text($dados['cpfAluno'], 263, 1697, function ($font) {
            $font->file(resource_path(self::FONT));
            $font->size(37);
            $font->color(self::AZUL);
        });

        $image1->text($dados['curso'], 958, 1697, function ($font) {
            $font->file(resource_path(self::FONT));
            $font->size(37);
            $font->color(self::AZUL);
        });

        $image1->text($dados['periodo'], 1705, 1697, function ($font) {
            $font->file(resource_path(self::FONT));
            $font->size(37);
            $font->color(self::AZUL);
        });

        $image1->text($dados['enderecoAluno'], 350, 1742, function ($font) {
            $font->file(resource_path(self::FONT));
            $font->size(37);
            $font->color(self::AZUL);
        });

        $image1->text($dados['numeroEnderecoAluno'], 230, 1790, function ($font) {
            $font->file(resource_path(self::FONT));
            $font->size(37);
            $font->color(self::AZUL);
        });

        $image1->text($dados['complementoAluno'], 800, 1790, function ($font) {
            $font->file(resource_path(self::FONT));
            $font->size(37);
            $font->color(self::AZUL);
        });

        $image1->text($dados['cepAluno'], 265, 1835, function ($font) {
            $font->file(resource_path(self::FONT));
            $font->size(37);
            $font->color(self::AZUL);
        });

        $image1->text($dados['bairroAluno'], 875, 1835, function ($font) {
            $font->file(resource_path(self::FONT));
            $font->size(37);
            $font->color(self::AZUL);
        });

        $image1->text($dados['cidadeAluno'], 1473, 1835, function ($font) {
            $font->file(resource_path(self::FONT));
            $font->size(37);
            $font->color(self::AZUL);
        });

        $image1->text($dados['estadoAluno'], 2020, 1835, function ($font) {
            $font->file(resource_path(self::FONT));
            $font->size(37);
            $font->color(self::AZUL);
        });

        $image1->text($dados['telefoneAluno'], 393, 1880, function ($font) {
            $font->file(resource_path(self::FONT));
            $font->size(37);
            $font->color(self::AZUL);
        });

        $image1->text($dados['emailAluno'], 1187, 1880, function ($font) {
            $font->file(resource_path(self::FONT));
            $font->size(37);
            $font->color(self::AZUL);
        });

        $image2 = Image::make($documentPaths[1]);


        $images = [$image1, $image2];
        $this->toPDF($images, $dados);
        Session::flash('pdf_generated_success', 'Documento preenchido com sucesso!');
        $estagio = new EstagioController();

        return redirect()->to(route('estagio.documentos', ['id' => $estagio->getEstagioAtual()]));
    }

    private function editTermoEncaminhamento($documentPaths, $dados)
    {
        $image1 = Image::make($documentPaths[0]);

        /*$dados[0] = 'Universidade de Pernambuco';

        $image->text($dados[], 280, 695, function ($font) {
            $font->file(resource_path(self::FONT));
            $font->size(42);
            $font->color(self::AZUL);

        }); */

        $image1->text($dados['instituicao'], 300, 695, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(42);
            $font->color(self::AZUL);
        });

        $image1->text($dados['nome'], 280, 1060, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(42);
            $font->color(self::AZUL);
        });

        $image1->text($dados['periodo'], 700, 1153, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(42);
            $font->color(self::AZUL);
        });

        $image1->text($dados['curso'], 260, 1245, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(42);
            $font->color(self::AZUL);
        });

        $image1->text($dados['ano_etapa'], 500, 1340, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(42);
            $font->color(self::AZUL);
        });

        $image1->text($dados['versao_estagio'], 1360, 1430, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(42);
            $font->color(self::AZUL);
        });

        $image1->text($dados['data_inicio'], 2000, 1430, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(42);
            $font->color(self::AZUL);
        });

        $image1->text($dados['data_fim'], 290, 1520, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(42);
            $font->color(self::AZUL);
        });

        $image1->text($dados['ano'], 667, 1519, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(42);
            $font->color(self::AZUL);
        });

        $image2 = Image::make($documentPaths[1]);

        $image2->text($dados['nome_supervisor'], 472, 325, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(23);
            $font->color(self::AZUL);
        });

        $image2->text($dados['cpf_supervisor'], 147, 364, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(23);
            $font->color(self::AZUL);
        });

        $image2->text($dados['formação_supervisor'], 584, 364, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(23);
            $font->color(self::AZUL);
        });

        $image2->text($dados['instituicao_estagio'], 190, 450, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(23);
            $font->color(self::AZUL);
        });

        $image2->text($dados['telefone_supervisor'], 187, 490, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(23);
            $font->color(self::AZUL);
        });

        $image2->text($dados['email_supervisor'], 598, 490, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(23);
            $font->color(self::AZUL);
        });

        $image2->text($dados['nome'], 194, 575, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(23);
            $font->color(self::AZUL);
        });

        $image2->text($dados['versao_estagio'], 350, 617, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(23);
            $font->color(self::AZUL);
        });

        $image2->text($dados['cidade_estágio'], 540, 700, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(23);
            $font->color(self::AZUL);
        });

        $image2->text($dados['dia_atual'], 740, 700, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(23);
            $font->color(self::AZUL);
        });

        $image2->text($dados['mes_atual'], 860, 700, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(23);
            $font->color(self::AZUL);
        });

        $image2->text($dados['ano'], 1045, 702, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(23);
            $font->color(self::AZUL);
        });

        $image2->text($dados['instituicao'], 220, 1220, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(23);
            $font->color(self::AZUL);
        });

        $image2->text($dados['cnpj_estagio'], 170, 1275, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(23);
            $font->color(self::AZUL);
        });

        $image2->text($dados['local_estagio'], 270, 1332, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(23);
            $font->color(self::AZUL);
        });

        $image2->text($dados['endereco_estagio'], 200, 1389, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(23);
            $font->color(self::AZUL);
        });

        $image2->text($dados['n_estagio'], 145, 1443, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(23);
            $font->color(self::AZUL);
        });

        $image2->text($dados['complemento_estagio'], 446, 1443, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(23);
            $font->color(self::AZUL);
        });

        $image2->text($dados['cep_estagio'], 157, 1500, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(23);
            $font->color(self::AZUL);
        });

        $image2->text($dados['bairro_estagio'], 480, 1500, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(23);
            $font->color(self::AZUL);
        });

        $image2->text($dados['cidade_estagio'], 780, 1500, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(23);
            $font->color(self::AZUL);
        });

        $image2->text($dados['estado_estagio'], 1040, 1500, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(23);
            $font->color(self::AZUL);
        });

        $image2->text($dados['representantelegal_estagio'], 310, 1555, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(23);
            $font->color(self::AZUL);
        });

        $image2->text($dados['cargo_representantelegal'], 870, 1555, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(23);
            $font->color(self::AZUL);
        });

        $image2->text($dados['horario_estagio'], 296, 1612, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(23);
            $font->color(self::AZUL);
        });


        $images = [$image1, $image2];
        $this->toPDF($images, $dados);
        Session::flash('pdf_generated_success', 'Documento preenchido com sucesso!');
        $estagio = new EstagioController();

        return redirect()->to(route('estagio.documentos', ['id' => $estagio->getEstagioAtual()]));
    }

    private function editFichaFrequencia($documentPaths, $dados)
    {
        $image = Image::make($documentPaths[0]);

        $image->text($dados['campus'], 345, 477, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(42);
            $font->color(self::AZUL);
        });

        $image->text($dados['periodo'], 1900, 477, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(42);
            $font->color(self::AZUL);
        });

        $image->text($dados['nome_estagiario'], 410, 568, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(42);
            $font->color(self::AZUL);
        });

        $image->text($dados['periodo'], 1797, 568, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(42);
            $font->color(self::AZUL);
        });

        $image->text($dados['curso'], 300, 653, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(42);
            $font->color(self::AZUL);
        });

        $image->text($dados['componente_curricular'], 1360, 653, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(42);
            $font->color(self::AZUL);
        });

        $image->text($dados['prof_componente_curricular'], 840, 745, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(42);
            $font->color(self::AZUL);
        });

        $image->text($dados['prof_orientador'], 630, 833, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(42);
            $font->color(self::AZUL);
        });

        $image->text($dados['local_estagio'], 470, 925, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(42);
            $font->color(self::AZUL);
        });

        $image->text($dados['supervisor_estagio'], 620, 1012, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(42);
            $font->color(self::AZUL);
        });

        $image->text($dados['data1'], 170, 1265, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(32);
            $font->color(self::AZUL);
        });

        // Linha 1
        $image->text($dados['data1'], 170, 1265, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(32);
            $font->color(self::AZUL);
        });

        $image->text($dados['atividade1'], 420, 1265, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(42);
            $font->color(self::AZUL);
        });

        $image->text($dados['ch1'], 1610, 1265, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(42);
            $font->color(self::AZUL);
        });

        // Linha 2
        $image->text($dados['data2'], 170, 1335, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(32);
            $font->color(self::AZUL);
        });

        $image->text($dados['atividade2'], 420, 1335, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(42);
            $font->color(self::AZUL);
        });

        $image->text($dados['ch2'], 1610, 1335, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(42);
            $font->color(self::AZUL);
        });

        // Linha 3
        $image->text($dados['data3'], 170, 1410, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(32);
            $font->color(self::AZUL);
        });

        $image->text($dados['atividade3'], 420, 1410, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(42);
            $font->color(self::AZUL);
        });

        $image->text($dados['ch3'], 1610, 1410, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(42);
            $font->color(self::AZUL);
        });

        // Linha 4
        $image->text($dados['data4'], 170, 1485, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(32);
            $font->color(self::AZUL);
        });

        // Linha 5
        $image->text($dados['data5'], 170, 1560, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(32);
            $font->color(self::AZUL);
        });

        $image->text($dados['atividade5'], 420, 1560, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(42);
            $font->color(self::AZUL);
        });

        $image->text($dados['ch5'], 1610, 1560, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(42);
            $font->color(self::AZUL);
        });

        // Linha 6
        $image->text($dados['data6'], 170, 1635, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(32);
            $font->color(self::AZUL);
        });

        $image->text($dados['atividade6'], 420, 1635, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(42);
            $font->color(self::AZUL);
        });

        $image->text($dados['ch6'], 1610, 1635, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(42);
            $font->color(self::AZUL);
        });

        // Linha 7
        $image->text($dados['data7'], 170, 1710, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(32);
            $font->color(self::AZUL);
        });

        $image->text($dados['atividade7'], 420, 1710, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(42);
            $font->color(self::AZUL);
        });

        $image->text($dados['ch7'], 1610, 1710, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(42);
            $font->color(self::AZUL);
        });

        // Linha 8
        $image->text($dados['data8'], 170, 1785, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(32);
            $font->color(self::AZUL);
        });

        $image->text($dados['atividade8'], 420, 1785, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(42);
            $font->color(self::AZUL);
        });

        $image->text($dados['ch8'], 1610, 1785, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(42);
            $font->color(self::AZUL);
        });

        // Linha 9
        $image->text($dados['data9'], 170, 1860, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(32);
            $font->color(self::AZUL);
        });

        $image->text($dados['atividade9'], 420, 1860, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(42);
            $font->color(self::AZUL);
        });

        $image->text($dados['ch9'], 1610, 1860, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(42);
            $font->color(self::AZUL);
        });

        // Linha 10
        $image->text($dados['data10'], 170, 1935, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(32);
            $font->color(self::AZUL);
        });

        $image->text($dados['atividade10'], 420, 1935, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(42);
            $font->color(self::AZUL);
        });

        $image->text($dados['ch10'], 1610, 1935, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(42);
            $font->color(self::AZUL);
        });


        // Linha 11
        $image->text($dados['data11'], 170, 2010, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(32);
            $font->color(self::AZUL);
        });

        $image->text($dados['atividade11'], 420, 2010, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(42);
            $font->color(self::AZUL);
        });

        $image->text($dados['ch11'], 1610, 2010, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(42);
            $font->color(self::AZUL);
        });

        // Linha 12
        $image->text($dados['data12'], 170, 2085, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(32);
            $font->color(self::AZUL);
        });

        $image->text($dados['atividade12'], 420, 2085, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(42);
            $font->color(self::AZUL);
        });

        $image->text($dados['ch12'], 1610, 2085, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(42);
            $font->color(self::AZUL);
        });

        // Linha 13
        $image->text($dados['data13'], 170, 2160, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(32);
            $font->color(self::AZUL);
        });

        $image->text($dados['atividade13'], 420, 2160, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(42);
            $font->color(self::AZUL);
        });

        $image->text($dados['ch13'], 1610, 2160, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(42);
            $font->color(self::AZUL);
        });

        // Linha 14
        $image->text($dados['data14'], 170, 2235, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(32);
            $font->color(self::AZUL);
        });

        $image->text($dados['atividade14'], 420, 2235, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(42);
            $font->color(self::AZUL);
        });

        $image->text($dados['ch14'], 1610, 2235, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(42);
            $font->color(self::AZUL);
        });

        // Linha 15
        $image->text($dados['data15'], 170, 2310, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(32);
            $font->color(self::AZUL);
        });

        $image->text($dados['atividade15'], 420, 2310, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(42);
            $font->color(self::AZUL);
        });

        $image->text($dados['ch15'], 1610, 2310, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(42);
            $font->color(self::AZUL);
        });

        // Linha 16
        $image->text($dados['data16'], 170, 2385, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(32);
            $font->color(self::AZUL);
        });

        $image->text($dados['atividade16'], 420, 2385, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(42);
            $font->color(self::AZUL);
        });

        $image->text($dados['ch16'], 1610, 2385, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(42);
            $font->color(self::AZUL);
        });

        // Linha 17
        $image->text($dados['data17'], 170, 2460, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(32);
            $font->color(self::AZUL);
        });

        $image->text($dados['atividade17'], 420, 2460, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(42);
            $font->color(self::AZUL);
        });

        $image->text($dados['ch17'], 1610, 2460, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(42);
            $font->color(self::AZUL);
        });

        // Linha 18
        $image->text($dados['data18'], 170, 2535, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(32);
            $font->color(self::AZUL);
        });

        $image->text($dados['atividade18'], 420, 2535, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(42);
            $font->color(self::AZUL);
        });

        $image->text($dados['ch18'], 1610, 2535, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(42);
            $font->color(self::AZUL);
        });

        // Linha 19
        $image->text($dados['data19'], 170, 2610, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(32);
            $font->color(self::AZUL);
        });

        $image->text($dados['atividade19'], 420, 2610, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(42);
            $font->color(self::AZUL);
        });

        $image->text($dados['ch19'], 1610, 2610, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(42);
            $font->color(self::AZUL);
        });

        // Linha 20
        $image->text($dados['data20'], 170, 2685, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(32);
            $font->color(self::AZUL);
        });

        $image->text($dados['atividade20'], 420, 2685, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(42);
            $font->color(self::AZUL);
        });

        $image->text($dados['ch20'], 1610, 2685, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(42);
            $font->color(self::AZUL);
        });

        // Linha 21
        $image->text($dados['data21'], 170, 2760, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(32);
            $font->color(self::AZUL);
        });

        $image->text($dados['atividade21'], 420, 2760, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(42);
            $font->color(self::AZUL);
        });

        $image->text($dados['ch21'], 1610, 2760, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(42);
            $font->color(self::AZUL);
        });

        // Linha 22
        $image->text($dados['data22'], 170, 2835, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(32);
            $font->color(self::AZUL);
        });

        $image->text($dados['atividade22'], 420, 2835, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(42);
            $font->color(self::AZUL);
        });

        $image->text($dados['ch22'], 1610, 2835, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(42);
            $font->color(self::AZUL);
        });

        $image->text($dados['ch_total'], 720, 2920, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(42);
            $font->color(self::AZUL);
        });

        $images = [$image];
        $this->toPDF($images, $dados);
        Session::flash('pdf_generated_success', 'Documento preenchido com sucesso!');
        $estagio = new EstagioController();

        return redirect()->to(route('estagio.documentos', ['id' => $estagio->getEstagioAtual()]));
    }

    private function editPlanoDeAtividades($documentPath, $dados)
    {
        $image = Image::make($documentPath);
        //ESTAGIARIO
        $image->text($dados['nome'], 305, 657, function ($font) {
            $font->file(resource_path(self::FONT));
            $font->size(37);
            $font->color(self::AZUL);
        });

        $image->text($dados['email'], 1551, 658, function ($font) {
            $font->file(resource_path(self::FONT));
            $font->size(37);
            $font->color(self::AZUL);
        });

        $image->text($dados['curso'], 309, 749, function ($font) {
            $font->file(resource_path(self::FONT));
            $font->size(37);
            $font->color(self::AZUL);
        });

        $image->text($dados['periodo'], 1385, 752, function ($font) {
            $font->file(resource_path(self::FONT));
            $font->size(37);
            $font->color(self::AZUL);
        });
        //CAMPO DE ESTÁGIO
        $image->text($dados['instituicao'], 381, 989, function ($font) {
            $font->file(resource_path(self::FONT));
            $font->size(37);
            $font->color(self::AZUL);
        });

        $image->text($dados['endereco'], 924, 1079, function ($font) {
            $font->file(resource_path(self::FONT));
            $font->size(37);
            $font->color(self::AZUL);
        });

        $image->text($dados['numCasa'], 253, 1168, function ($font) {
            $font->file(resource_path(self::FONT));
            $font->size(37);
            $font->color(self::AZUL);
        });

        $image->text($dados['complemento'], 821, 1166, function ($font) {
            $font->file(resource_path(self::FONT));
            $font->size(37);
            $font->color(self::AZUL);
        });

        $image->text($dados['fone'], 1623, 1169, function ($font) {
            $font->file(resource_path(self::FONT));
            $font->size(37);
            $font->color(self::AZUL);
        });

        $image->text($dados['cep'], 298, 1262, function ($font) {
            $font->file(resource_path(self::FONT));
            $font->size(37);
            $font->color(self::AZUL);
        });

        $image->text($dados['bairro'], 915, 1257, function ($font) {
            $font->file(resource_path(self::FONT));
            $font->size(37);
            $font->color(self::AZUL);
        });

        $image->text($dados['cidade'], 1490, 1254, function ($font) {
            $font->file(resource_path(self::FONT));
            $font->size(37);
            $font->color(self::AZUL);
        });

        $image->text($dados['estado'], 2012, 1254, function ($font) {
            $font->file(resource_path(self::FONT));
            $font->size(37);
            $font->color(self::AZUL);
        });

        $image->text($dados['pontoReferencia'], 532, 1346, function ($font) {
            $font->file(resource_path(self::FONT));
            $font->size(37);
            $font->color(self::AZUL);
        });

        $image->text($dados['supervisorEstagio'], 568, 1432, function ($font) {
            $font->file(resource_path(self::FONT));
            $font->size(37);
            $font->color(self::AZUL);
        });

        $image->text($dados['FoneSupervisor'], 434, 1524, function ($font) {
            $font->file(resource_path(self::FONT));
            $font->size(37);
            $font->color(self::AZUL);
        });

        $image->text($dados['emailSup'], 1022, 1524, function ($font) {
            $font->file(resource_path(self::FONT));
            $font->size(37);
            $font->color(self::AZUL);
        });

        $image->text($dados['cargo'], 1628, 1524, function ($font) {
            $font->file(resource_path(self::FONT));
            $font->size(37);
            $font->color(self::AZUL);
        });

        $image->text($dados['educacaoEscolar'], 544, 1616, function ($font) {
            $font->file(resource_path(self::FONT));
            $font->size(37);
            $font->color(self::AZUL);
        });

        $image->text($dados['educacaoNaoEscolar'], 1232, 1616, function ($font) {
            $font->file(resource_path(self::FONT));
            $font->size(37);
            $font->color(self::AZUL);
        });

        $image->text($dados['modalidade'], 441, 1890, function ($font) {
            $font->file(resource_path(self::FONT));
            $font->size(37);
            $font->color(self::AZUL);
        });

        //PROGRAMA DE ESTÁGIO
        $image->text($dados['semestreLetivo'], 464, 2122, function ($font) {
            $font->file(resource_path(self::FONT));
            $font->size(37);
            $font->color(self::AZUL);
        });

        $image->text($dados['componenteCurricular'], 1173, 2125, function ($font) {
            $font->file(resource_path(self::FONT));
            $font->size(37);
            $font->color(self::AZUL);
        });

        $image->text($dados['professorComponenteCurricular'], 796, 2218, function ($font) {
            $font->file(resource_path(self::FONT));
            $font->size(37);
            $font->color(self::AZUL);
        });

        $image->text($dados['professorOrientador'], 544, 2308, function ($font) {
            $font->file(resource_path(self::FONT));
            $font->size(37);
            $font->color(self::AZUL);
        });

        $image->text($dados['cargaHorariaSemanal'], 1114, 2398, function ($font) {
            $font->file(resource_path(self::FONT));
            $font->size(37);
            $font->color(self::AZUL);
        });

        $image->text($dados['diasRealizacao'], 510, 2490, function ($font) {
            $font->file(resource_path(self::FONT));
            $font->size(37);
            $font->color(self::AZUL);
        });

        $image->text($dados['horario'], 1388, 2486, function ($font) {
            $font->file(resource_path(self::FONT));
            $font->size(37);
            $font->color(self::AZUL);
        });

        $images = [$image];

        $this->toPDF($images, $dados);
        Session::flash('pdf_generated_success', 'Documento preenchido com sucesso!');
        $estagio = new EstagioController();

        return redirect()->to(route('estagio.documentos', ['id' => $estagio->getEstagioAtual()]));
    }

    private function editFrequenciaResidente($documentPaths, $dados)
    {

        $image1 = Image::make($documentPaths[0]);

        $image1->text($dados['residente'], 158, 465, function ($font) {
            $font->file(resource_path(self::FONT));
            $font->size(39);
            $font->color(self::AZUL);
        });

        $image1->text($dados['curso'], 315, 533, function ($font) {
            $font->file(resource_path(self::FONT));
            $font->size(39);
            $font->color(self::AZUL);
        });

        $image1->text($dados['unidade'], 1878, 533, function ($font) {
            $font->file(resource_path(self::FONT));
            $font->size(39);
            $font->color(self::AZUL);
        });

        $image1->text($dados['nomeConcedente'], 158, 721, function ($font) {
            $font->file(resource_path(self::FONT));
            $font->size(39);
            $font->color(self::AZUL);
        });

        $image1->text($dados['etapaEducacaoBasica'], 1694, 721, function ($font) {
            $font->file(resource_path(self::FONT));
            $font->size(39);
            $font->color(self::AZUL);
        });

        $image1->text($dados['ano'], 2321, 721, function ($font) {
            $font->file(resource_path(self::FONT));
            $font->size(39);
            $font->color(self::AZUL);
        });

        $image1->text($dados['nomeProf'], 162, 857, function ($font) {
            $font->file(resource_path(self::FONT));
            $font->size(39);
            $font->color(self::AZUL);
        });

        $image1->text($dados['numMatricula'], 1707, 857, function ($font) {
            $font->file(resource_path(self::FONT));
            $font->size(39);
            $font->color(self::AZUL);
        });

        $image2 = Image::make($documentPaths[1]);

        $images = [$image1, $image2];
        $this->toPDF($images, $dados);

        Session::flash('pdf_generated_success', 'Documento preenchido com sucesso!');
        $estagio = new EstagioController();

        return redirect()->to(route('estagio.documentos', ['id' => $estagio->getEstagioAtual()]));
    }

    private function editRelatorioCampo($documentPaths, $dados)
    {
        $image1 = Image::make($documentPaths[0]);

        $image1->text('X', 676, 425, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(42);
            $font->color(self::AZUL);
        });

        $image1->text($dados['curso'], 420, 519, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(42);
            $font->color(self::AZUL);
        });

        $image1->text($dados['semestre'], 2100, 519, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(42);
            $font->color(self::AZUL);
        });

        $image1->text($dados['orientador'], 702, 610, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(42);
            $font->color(self::AZUL);
        });

        $image1->text($dados['instituicao'], 430, 839, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(42);
            $font->color(self::AZUL);
        });

        if ($dados['natureza'] === "publica") {
            $image1->text('X', 520, 940, function ($font) {
                $font->file(resource_path('fonts/Arial.ttf'));
                $font->size(42);
                $font->color(self::AZUL);
            });
        } elseif ($dados['natureza'] === "privada") {
            $image1->text('X', 860, 940, function ($font) {
                $font->file(resource_path('fonts/Arial.ttf'));
                $font->size(42);
                $font->color(self::AZUL);
            });
        }

        $image1->text($dados['endereco'], 975, 1033, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(42);
            $font->color(self::AZUL);
        });

        $image1->text($dados['num'], 300, 1125, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(42);
            $font->color(self::AZUL);
        });

        $image1->text($dados['complemento'], 860, 1125, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(42);
            $font->color(self::AZUL);
        });

        $image1->text($dados['fone1'], 1520, 1125, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(42);
            $font->color(self::AZUL);
        });

        $image1->text($dados['cep'], 330, 1220, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(42);
            $font->color(self::AZUL);
        });

        $image1->text($dados['bairro'], 920, 1220, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(42);
            $font->color(self::AZUL);
        });

        $image1->text($dados['cidade'], 1500, 1220, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(42);
            $font->color(self::AZUL);
        });

        $image1->text($dados['estado'], 2020, 1220, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(42);
            $font->color(self::AZUL);
        });

        $image1->text($dados['representante'], 510, 1315, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(42);
            $font->color(self::AZUL);
        });

        $image1->text($dados['cargo_representante'], 1630, 1315, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(42);
            $font->color(self::AZUL);
        });

        $image1->text($dados['supervisor'], 620, 1415, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(42);
            $font->color(self::AZUL);
        });

        $image1->text($dados['cargo_supervisor'], 1720, 1415, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(42);
            $font->color(self::AZUL);
        });

        $image1->text($dados['formacao_supervisor'], 440, 1510, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(42);
            $font->color(self::AZUL);
        });

        $image1->text($dados['fone2'], 340, 1610, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(42);
            $font->color(self::AZUL);
        });

        $image1->text($dados['email_supervisor'], 1300, 1610, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(42);
            $font->color(self::AZUL);
        });

        if ($dados['educacao'] === "escolar") {
            $image1->text('X', 590, 1710, function ($font) {
                $font->file(resource_path('fonts/Arial.ttf'));
                $font->size(42);
                $font->color(self::AZUL);
            });
        } elseif ($dados['educacao'] === "nao_escolar") {
            $image1->text('X', 1280, 1710, function ($font) {
                $font->file(resource_path('fonts/Arial.ttf'));
                $font->size(42);
                $font->color(self::AZUL);
            });
        }

        $image1->text($dados['modalidade'], 450, 1805, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(42);
            $font->color(self::AZUL);
        });

        if ($dados['etapa'] === "infantil") {
            $image1->text('X', 680, 1905, function ($font) {
                $font->file(resource_path('fonts/Arial.ttf'));
                $font->size(42);
                $font->color(self::AZUL);
            });
        } elseif ($dados['etapa'] === "fundamental") {
            $image1->text('X', 1300, 1905, function ($font) {
                $font->file(resource_path('fonts/Arial.ttf'));
                $font->size(42);
                $font->color(self::AZUL);
            });
        } elseif ($dados['etapa'] === "medio") {
            $image1->text('X', 1810, 1905, function ($font) {
                $font->file(resource_path('fonts/Arial.ttf'));
                $font->size(42);
                $font->color(self::AZUL);
            });
        }

        $image1->text($dados['entrevistados'], 770, 2000, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(42);
            $font->color(self::AZUL);
        });

        $image1->text($dados['complementares'], 760, 2100, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(42);
            $font->color(self::AZUL);
        });

        $image1->text($dados['estag1'], 305, 2480, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(42);
            $font->color(self::AZUL);
        });

        $image1->text($dados['turma1'], 1660, 2480, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(42);
            $font->color(self::AZUL);
        });

        $image1->text($dados['turno1'], 2010, 2480, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(42);
            $font->color(self::AZUL);
        });

        $image1->text($dados['estag2'], 305, 2580, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(42);
            $font->color(self::AZUL);
        });

        $image1->text($dados['turma2'], 1660, 2580, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(42);
            $font->color(self::AZUL);
        });

        $image1->text($dados['turno2'], 2010, 2580, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(42);
            $font->color(self::AZUL);
        });

        $image1->text($dados['estag3'], 305, 2680, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(42);
            $font->color(self::AZUL);
        });

        $image1->text($dados['turma3'], 1660, 2680, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(42);
            $font->color(self::AZUL);
        });

        $image1->text($dados['turno3'], 2010, 2680, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(42);
            $font->color(self::AZUL);
        });

        $image1->text($dados['estag4'], 305, 2780, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(42);
            $font->color(self::AZUL);
        });

        $image1->text($dados['turma4'], 1660, 2780, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(42);
            $font->color(self::AZUL);
        });

        $image1->text($dados['turno4'], 2010, 2780, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(42);
            $font->color(self::AZUL);
        });

        $image1->text($dados['estag5'], 305, 2860, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(42);
            $font->color(self::AZUL);
        });

        $image1->text($dados['turma5'], 1660, 2860, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(42);
            $font->color(self::AZUL);
        });

        $image1->text($dados['turno5'], 2010, 2860, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(42);
            $font->color(self::AZUL);
        });

        $image1->text($dados['estag6'], 305, 2960, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(42);
            $font->color(self::AZUL);
        });

        $image1->text($dados['turma6'], 1660, 2960, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(42);
            $font->color(self::AZUL);
        });

        $image1->text($dados['turno6'], 2010, 2960, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(42);
            $font->color(self::AZUL);
        });

        $image1->text($dados['estag7'], 305, 3040, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(42);
            $font->color(self::AZUL);
        });

        $image1->text($dados['turma7'], 1660, 3040, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(42);
            $font->color(self::AZUL);
        });

        $image1->text($dados['turno7'], 2010, 3040, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(42);
            $font->color(self::AZUL);
        });

        $image1->text($dados['estag8'], 305, 3120, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(42);
            $font->color(self::AZUL);
        });

        $image1->text($dados['turma8'], 1660, 3120, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(42);
            $font->color(self::AZUL);
        });

        $image1->text($dados['turno8'], 2010, 3120, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(42);
            $font->color(self::AZUL);
        });

        $image1->text($dados['estag9'], 305, 3210, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(42);
            $font->color(self::AZUL);
        });

        $image1->text($dados['turma9'], 1660, 3210, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(42);
            $font->color(self::AZUL);
        });

        $image1->text($dados['turno9'], 2010, 3210, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(42);
            $font->color(self::AZUL);
        });

        $image1->text($dados['estag10'], 305, 3300, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(42);
            $font->color(self::AZUL);
        });

        $image1->text($dados['turma10'], 1660, 3300, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(42);
            $font->color(self::AZUL);
        });

        $image1->text($dados['turno10'], 2010, 3300, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(42);
            $font->color(self::AZUL);
        });

        $image2 = Image::make($documentPaths[1]);

        if ($dados['opc1'] === "sim") {
            $image2->text('X', 300, 590, function ($font) {
                $font->file(resource_path('fonts/Arial.ttf'));
                $font->size(42);
                $font->color(self::AZUL);
            });
        } elseif ($dados['opc1'] === "parcialmente") {
            $image2->text('X', 550, 590, function ($font) {
                $font->file(resource_path('fonts/Arial.ttf'));
                $font->size(42);
                $font->color(self::AZUL);
            });
        } elseif ($dados['opc1'] === "nao") {
            $image2->text('X', 900, 590, function ($font) {
                $font->file(resource_path('fonts/Arial.ttf'));
                $font->size(42);
                $font->color(self::AZUL);
            });
        }

        if ($dados['opc2'] === "sim") {
            $image2->text('X', 300, 680, function ($font) {
                $font->file(resource_path('fonts/Arial.ttf'));
                $font->size(42);
                $font->color(self::AZUL);
            });
        } elseif ($dados['opc2'] === "parcialmente") {
            $image2->text('X', 550, 680, function ($font) {
                $font->file(resource_path('fonts/Arial.ttf'));
                $font->size(42);
                $font->color(self::AZUL);
            });
        } elseif ($dados['opc2'] === "nao") {
            $image2->text('X', 900, 680, function ($font) {
                $font->file(resource_path('fonts/Arial.ttf'));
                $font->size(42);
                $font->color(self::AZUL);
            });
        }

        if ($dados['opc3'] === "sim") {
            $image2->text('X', 300, 880, function ($font) {
                $font->file(resource_path('fonts/Arial.ttf'));
                $font->size(42);
                $font->color(self::AZUL);
            });
        } elseif ($dados['opc3'] === "parcialmente") {
            $image2->text('X', 550, 880, function ($font) {
                $font->file(resource_path('fonts/Arial.ttf'));
                $font->size(42);
                $font->color(self::AZUL);
            });
        } elseif ($dados['opc3'] === "nao") {
            $image2->text('X', 900, 880, function ($font) {
                $font->file(resource_path('fonts/Arial.ttf'));
                $font->size(42);
                $font->color(self::AZUL);
            });
        }

        if ($dados['opc4'] === "sim") {
            $image2->text('X', 300, 990, function ($font) {
                $font->file(resource_path('fonts/Arial.ttf'));
                $font->size(42);
                $font->color(self::AZUL);
            });
        } elseif ($dados['opc4'] === "parcialmente") {
            $image2->text('X', 550, 990, function ($font) {
                $font->file(resource_path('fonts/Arial.ttf'));
                $font->size(42);
                $font->color(self::AZUL);
            });
        } elseif ($dados['opc4'] === "nao") {
            $image2->text('X', 900, 990, function ($font) {
                $font->file(resource_path('fonts/Arial.ttf'));
                $font->size(42);
                $font->color(self::AZUL);
            });
        }

        if ($dados['opc5'] === "sim") {
            $image2->text('X', 300, 1090, function ($font) {
                $font->file(resource_path('fonts/Arial.ttf'));
                $font->size(42);
                $font->color(self::AZUL);
            });
        } elseif ($dados['opc5'] === "parcialmente") {
            $image2->text('X', 550, 1090, function ($font) {
                $font->file(resource_path('fonts/Arial.ttf'));
                $font->size(42);
                $font->color(self::AZUL);
            });
        } elseif ($dados['opc5'] === "nao") {
            $image2->text('X', 900, 1090, function ($font) {
                $font->file(resource_path('fonts/Arial.ttf'));
                $font->size(42);
                $font->color(self::AZUL);
            });
        }

        $image2->text($dados['3_l1'], 235, 1360, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(42);
            $font->color(self::AZUL);
        });

        $image2->text($dados['3_l2'], 235, 1440, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(42);
            $font->color(self::AZUL);
        });

        $image2->text($dados['3_l3'], 235, 1510, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(42);
            $font->color(self::AZUL);
        });

        $image2->text($dados['4_l1'], 235, 1740, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(42);
            $font->color(self::AZUL);
        });

        $image2->text($dados['4_l2'], 235, 1810, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(42);
            $font->color(self::AZUL);
        });

        $image2->text($dados['4_l3'], 235, 1880, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(42);
            $font->color(self::AZUL);
        });

        $image2->text($dados['4_l4'], 235, 1950, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(42);
            $font->color(self::AZUL);
        });

        $image2->text($dados['5_l1'], 235, 2180, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(42);
            $font->color(self::AZUL);
        });

        $image2->text($dados['5_l2'], 235, 2250, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(42);
            $font->color(self::AZUL);
        });

        $image2->text($dados['5_l3'], 235, 2320, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(42);
            $font->color(self::AZUL);
        });

        $image2->text($dados['5_l4'], 235, 2395, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(42);
            $font->color(self::AZUL);
        });

        $image2->text($dados['6_l1'], 235, 2620, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(42);
            $font->color(self::AZUL);
        });

        $image2->text($dados['6_l2'], 235, 2690, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(42);
            $font->color(self::AZUL);
        });

        $image2->text($dados['6_l3'], 235, 2760, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(42);
            $font->color(self::AZUL);
        });

        $image2->text($dados['6_l4'], 235, 2835, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(42);
            $font->color(self::AZUL);
        });

        $images = [$image1, $image2];
        $this->toPDF($images, $dados);
        Session::flash('pdf_generated_success', 'Documento preenchido com sucesso!');
        $estagio = new EstagioController();

        return redirect()->to(route('estagio.documentos', ['id' => $estagio->getEstagioAtual()]));
    }

    public function getListaDeDocumentosId()
    {
        $listaDocumentosObrigatorios = new ListaDocumentosObrigatorios();
        $document = $listaDocumentosObrigatorios->where('id', $this->documentType)->first();
        return $document->id;
    }
}
