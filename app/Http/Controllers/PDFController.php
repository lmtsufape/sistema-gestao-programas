<?php

namespace App\Http\Controllers;

use App\Models\Aluno;
use App\Models\Curso;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Models\DocumentoEstagio;
use App\Models\ListaDocumentosObrigatorios;
use App\Models\Estagio;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Route;
use TCPDF;
use PhpOffice\PhpWord\TemplateProcessor;
use PhpOffice\PhpWord\Settings;
use App\Services\DocService;
use Carbon\Carbon;

class PDFController extends Controller
{
    private const AZUL = '#00009C';
    private const FONT = 'fonts/Arial.ttf';
    private $documentType = 6;
    private $estagio;

    public function __construct()
    {
        Settings::setZipClass(Settings::PCLZIP);
        $estagioId = Route::current()->parameter('id');
        $this->estagio = Estagio::find($estagioId);
    }

    public function editImage($documentType, $dados)
    {
        $this->documentType = $documentType;

        // terá um método para cada documento, esse switchcase servirá para selecionar o método especifico de cada documento.
        switch ($this->documentType) {
                //termo de encaminhamento
            case 1:
                $path = storage_path('app/docs/UPE/eo/termo_encaminhamento.docx');
                return $this->editTermoEncaminhamento($path, $dados);
                break;
                //termo de compromisso
            case 2:
                $path = storage_path('app/docs/UPE/eo/termo_compromisso.docx');
                return $this->editTermoCompromisso($path, $dados);
                break;
                //plano de atividades
            case 3:
                return $this->editPlanoDeAtividades($dados);
                break;
                //ficha de frequência
            case 4:
                $path = storage_path('app/docs/UPE/eo/ficha_frequencia.docx');
                return $this->editFichaFrequencia($path, $dados);
                break;
                // Relatório de Acompanhamento do Campo de Estágio
            case 5:
                $documentPath1 = storage_path('app/docs/relatorio_acompanhamento_campo/0.png');
                $documentPath2 = storage_path('app/docs/relatorio_acompanhamento_campo/1.png');
                return $this->editRelatorioCampo([$documentPath1, $documentPath2], $dados);
                break;
            case 7:
                $path = storage_path('app/docs/UPE/eo/frequencia_residente.docx');
                return $this->editFrequenciaResidente($path, $dados);
                break;
            case 9:
                $path = storage_path('app/docs/UFAPE/termo_compromisso_ufape_bach.docx');
                return $this->editTermoCompromissoUFAPE($path, $dados);
                break;
            case 10:
                $path = storage_path('app/docs/UFAPE/carta_aceite_supervisor.docx');
                return $this->edit_carta_aceite_supervisor_ufape($path, $dados);
            case 11:
                $path = storage_path('app/docs/UFAPE/ficha_frequencia.docx');
                return $this->edit_ficha_frequencia_ufape($path, $dados);
                break;
            case 12:
                $path = storage_path('app/docs/UFAPE/termo_aditivo.docx');
                return $this->edit_termo_aditivo_ufape($path, $dados);
                break;
            case 13:
                $path = storage_path('app/docs/UFAPE/declaracao_ch_eso.docx');
                return $this->edit_declaracao_ch($path, $dados);
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
        $pdfContent = ob_get_contents();
        $pdfContent = base64_encode($pdfContent);
        ob_end_clean();


        try {
            DB::beginTransaction();


            $listaDocumentosId = $this->getListaDeDocumentosId();
            $aluno = $this->estagio->aluno;
            $alunoId = $aluno->id;

            $documentoExistente = DocumentoEstagio::where('lista_documentos_obrigatorios_id', $listaDocumentosId)
                ->where('aluno_id', $alunoId)
                ->where('estagio_id', $this->estagio->id)
                ->first();


            if (!$documentoExistente) {
                $documento = new DocumentoEstagio();
                $documento->aluno_id = $alunoId;
                $documento->pdf = $pdfContent;
                $documento->lista_documentos_obrigatorios_id = $listaDocumentosId;
                $documento->dados = json_encode($dados);
                $estagio = new EstagioController();
                $documento->estagio_id = $this->estagio->id;
                $documento->save();
            } else {
                $documentoExistente->dados = json_encode($dados);
                $documentoExistente->pdf = $pdfContent;
                $documentoExistente->save();
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
        }

        // Renderizar o PDF no navegador
        //$pdf->Output('documento.pdf', 'I');

        //unlink($tmpImagePath);

        $pdf->close();

        return $pdfContent;
    }

    private function salvar_no_banco($path, $dados)
    {
        $blobData = file_get_contents($path);

        try {

            DB::beginTransaction();

            $listaDocumentosId = $this->getListaDeDocumentosId();
            $aluno = $this->estagio->aluno;
            $alunoId = $aluno->id;

            $documentoExistente = DocumentoEstagio::where('lista_documentos_obrigatorios_id', $listaDocumentosId)
                ->where('aluno_id', $alunoId)
                ->where('estagio_id', $this->estagio->id)
                ->first();


            if (!$documentoExistente) {
                $documento = new DocumentoEstagio();
                $documento->aluno_id = $alunoId;
                $documento->pdf = $blobData;
                $documento->lista_documentos_obrigatorios_id = $listaDocumentosId;
                $documento->dados = json_encode($dados);
                $estagio = new EstagioController();
                $documento->estagio_id = $this->estagio->id;
                $documento->save();
            } else {
                $documentoExistente->dados = json_encode($dados);
                $documentoExistente->pdf = $blobData;
                $documentoExistente->save();
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            // Tratar exceções, logar erros, etc.
        } finally {
            unlink($path);
        }
    }

    public function viewPDF($docId)
    {
        $documento = DocumentoEstagio::find($docId);

        $documentoObrigatorio = ListaDocumentosObrigatorios::find($documento->lista_documentos_obrigatorios_id);

        $aluno = Auth::user();


        // if ($documento->aluno_id != Auth::id()) {
        //     return redirect()->back()->with('error', 'Você não tem permissão para visualizar este documento.');
        // }

        $pdf = base64_decode($documento->pdf);

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

        if (Auth::user()->hasAnyRole('tecnico', 'coordenador', 'supervisor', 'diretor', 'pro-reitor', 'administrador')) {
            $documento->is_visualizado = true;
            $documento->save();
        }

        return Response::make($pdf, 200, $headers);
    }

    public function viewDoc($docId)
    {
        $documento = DocumentoEstagio::find($docId);
        $estagio = Estagio::find($documento->estagio_id);

        $doc = $documento->pdf;

        // Converte o conteúdo do arquivo em um array de bytes (Uint8Array)
        $conteudoArrayBytes = array_values(unpack('C*', $doc));

        return view('estagio.documentos.preview', ['conteudoArrayBytes' => $conteudoArrayBytes, 'documento' => $documento, 'estagio' => $estagio]);
    }

    public function downloadDoc($docId)
    {
        $documento = DocumentoEstagio::find($docId);
        $aluno = Aluno::find($documento->aluno_id);
        $docBlob = $documento->pdf;
        $nome_aluno = $aluno->nome_aluno;


        // Defina o nome do arquivo para download
        $nomeArquivo = $documento->lista_documentos_obrigatorios->titulo . '_' . $nome_aluno . '.docx';
        $nome_arquivo_formatado = str_replace(' ', '_', $nomeArquivo);
        $nome_arquivo_formatado = strtolower($nome_arquivo_formatado);
        // Configurar os headers para o download do arquivo
        $headers = [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            'Content-Disposition' => 'attachment; filename="' . $nome_arquivo_formatado . '"',
        ];

        // Retornar a resposta com o conteúdo do arquivo e os headers configurados
        return Response::make($docBlob, 200, $headers);
    }

    private function editTermoCompromisso($path, $dados)
    {
        $tp = new TemplateProcessor($path);

        $tp->setValue('quant_semanas', $dados['quant_semanas'] . 'h');
        $tp->setValues($dados);


        $temp_path = DocService::tmpdoc();

        $tp->saveAs($temp_path);

        $this->salvar_no_banco($temp_path, $dados);

        Session::flash('pdf_generated_success', 'Documento preenchido com sucesso!');

        return redirect()->to(route('estagio.documentos', ['id' => $this->estagio->id]));
    }

    private function editTermoEncaminhamento($path, $dados)
    {

        $templateProcessor = new TemplateProcessor($path);
        $templateProcessor->setValues($dados);
        $temp_path = DocService::tmpdoc();

        $templateProcessor->saveAs($temp_path);

        $this->salvar_no_banco($temp_path, $dados);

        Session::flash('pdf_generated_success', 'Documento preenchido com sucesso!');

        return redirect()->to(route('estagio.documentos', ['id' => $this->estagio->id]));
    }

    private function editFichaFrequencia($path, $dados)
    {
        $tp = new TemplateProcessor($path);
        $tp->setValues($dados);
        $temp_path = DocService::tmpdoc();

        $tp->saveAs($temp_path);

        $this->salvar_no_banco($temp_path, $dados);

        Session::flash('pdf_generated_success', 'Documento preenchido com sucesso!');

        return redirect()->to(route('estagio.documentos', ['id' => $this->estagio->id]));
    }

    private function editPlanoDeAtividades($dados)
    {
        $tp = new TemplateProcessor(storage_path('app/docs/UPE/eo/plano_atividades.docx'));

        if ($dados['educacaoEscolar'] == "Sim"){
            $tp->setValue('educacaoEscolar', "X");
        } else {
            $tp->setValue('educacaoEscolar', "");
        }

        if ($dados['educacaoNaoEscolar'] == "Sim"){
            $tp->setValue('educacaoNaoEscolar', "X");
        } else {
            $tp->setValue('educacaoNaoEscolar', "");
        }
        
        $tp->setValues($dados);

        $temp_path = DocService::tmpdoc();

        $tp->saveAs($temp_path);

        $this->salvar_no_banco($temp_path, $dados);

        Session::flash('pdf_generated_success', 'Documento preenchido com sucesso!');

        return redirect()->to(route('estagio.documentos', ['id' => $this->estagio->id]));
    }

    private function editFrequenciaResidente($path, $dados)
    {
        $tp = new TemplateProcessor($path);
        $tp->setValues($dados);
        $temp_path = DocService::tmpdoc();

        $tp->saveAs($temp_path);
        $this->salvar_no_banco($temp_path, $dados);

        Session::flash('pdf_generated_success', 'Documento preenchido com sucesso!');

        return redirect()->to(route('estagio.documentos', ['id' => $this->estagio->id]));
    }

    private function editRelatorioCampo($documentPaths, $dados)
    {
        $image1 = Image::make($documentPaths[0]);

        $image1->text('X', 676, 440, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(42);
            $font->color(self::AZUL);
        });

        $image1->text($dados['curso'], 420, 535, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(42);
            $font->color(self::AZUL);
        });

        $image1->text($dados['semestre'], 2050, 535, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(42);
            $font->color(self::AZUL);
        });

        $image1->text($dados['orientador'], 702, 625, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(42);
            $font->color(self::AZUL);
        });

        $image1->text($dados['instituicao'], 430, 855, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(42);
            $font->color(self::AZUL);
        });

        if ($dados['natureza'] === "publica") {
            $image1->text('X', 520, 955, function ($font) {
                $font->file(resource_path('fonts/Arial.ttf'));
                $font->size(42);
                $font->color(self::AZUL);
            });
        } elseif ($dados['natureza'] === "privada") {
            $image1->text('X', 860, 955, function ($font) {
                $font->file(resource_path('fonts/Arial.ttf'));
                $font->size(42);
                $font->color(self::AZUL);
            });
        }

        $image1->text($dados['endereco'], 975, 1050, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(42);
            $font->color(self::AZUL);
        });

        $image1->text($dados['num'], 300, 1140, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(42);
            $font->color(self::AZUL);
        });

        $image1->text($dados['complemento'], 860, 1140, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(42);
            $font->color(self::AZUL);
        });

        $image1->text($dados['fone1'], 1520, 1140, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(42);
            $font->color(self::AZUL);
        });

        $image1->text($dados['cep'], 330, 1235, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(42);
            $font->color(self::AZUL);
        });

        $image1->text($dados['bairro'], 920, 1235, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(42);
            $font->color(self::AZUL);
        });

        $image1->text($dados['cidade'], 1490, 1235, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(42);
            $font->color(self::AZUL);
        });

        $image1->text($dados['estado'], 2020, 1235, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(42);
            $font->color(self::AZUL);
        });

        $image1->text($dados['representante'], 510, 1330, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(42);
            $font->color(self::AZUL);
        });

        $image1->text($dados['cargo_representante'], 1630, 1330, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(42);
            $font->color(self::AZUL);
        });

        $image1->text($dados['supervisor'], 620, 1430, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(42);
            $font->color(self::AZUL);
        });

        $image1->text($dados['cargo_supervisor'], 1720, 1430, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(42);
            $font->color(self::AZUL);
        });

        $image1->text($dados['formacao_supervisor'], 440, 1525, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(42);
            $font->color(self::AZUL);
        });

        $image1->text($dados['fone2'], 340, 1625, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(42);
            $font->color(self::AZUL);
        });

        $image1->text($dados['email_supervisor'], 1300, 1625, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(42);
            $font->color(self::AZUL);
        });

        if ($dados['educacao'] === "escolar") {
            $image1->text('X', 600, 1725, function ($font) {
                $font->file(resource_path('fonts/Arial.ttf'));
                $font->size(42);
                $font->color(self::AZUL);
            });
        } elseif ($dados['educacao'] === "nao_escolar") {
            $image1->text('X', 1275, 1725, function ($font) {
                $font->file(resource_path('fonts/Arial.ttf'));
                $font->size(42);
                $font->color(self::AZUL);
            });
        }

        $image1->text($dados['modalidade'], 450, 1820, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(42);
            $font->color(self::AZUL);
        });

        if ($dados['etapa'] === "infantil") {
            $image1->text('X', 690, 1920, function ($font) {
                $font->file(resource_path('fonts/Arial.ttf'));
                $font->size(42);
                $font->color(self::AZUL);
            });
        } elseif ($dados['etapa'] === "fundamental") {
            $image1->text('X', 1495, 1920, function ($font) {
                $font->file(resource_path('fonts/Arial.ttf'));
                $font->size(42);
                $font->color(self::AZUL);
            });
        } elseif ($dados['etapa'] === "medio") {
            $image1->text('X', 1805, 1920, function ($font) {
                $font->file(resource_path('fonts/Arial.ttf'));
                $font->size(42);
                $font->color(self::AZUL);
            });
        }

        $image1->text($dados['entrevistados'], 770, 2015, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(42);
            $font->color(self::AZUL);
        });

        $image1->text($dados['complementares'], 760, 2115, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(42);
            $font->color(self::AZUL);
        });

        $image1->text($dados['estag1'], 305, 2505, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(42);
            $font->color(self::AZUL);
        });

        $image1->text($dados['turma1'], 1660, 2505, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(42);
            $font->color(self::AZUL);
        });

        $image1->text($dados['turno1'], 2010, 2505, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(42);
            $font->color(self::AZUL);
        });

        $image1->text($dados['estag2'], 305, 2605, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(42);
            $font->color(self::AZUL);
        });

        $image1->text($dados['turma2'], 1660, 2605, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(42);
            $font->color(self::AZUL);
        });

        $image1->text($dados['turno2'], 2010, 2605, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(42);
            $font->color(self::AZUL);
        });

        $image1->text($dados['estag3'], 305, 2695, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(42);
            $font->color(self::AZUL);
        });

        $image1->text($dados['turma3'], 1660, 2695, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(42);
            $font->color(self::AZUL);
        });

        $image1->text($dados['turno3'], 2010, 2695, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(42);
            $font->color(self::AZUL);
        });

        $image1->text($dados['estag4'], 305, 2795, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(42);
            $font->color(self::AZUL);
        });

        $image1->text($dados['turma4'], 1660, 2795, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(42);
            $font->color(self::AZUL);
        });

        $image1->text($dados['turno4'], 2010, 2795, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(42);
            $font->color(self::AZUL);
        });

        $image1->text($dados['estag5'], 305, 2875, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(42);
            $font->color(self::AZUL);
        });

        $image1->text($dados['turma5'], 1660, 2875, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(42);
            $font->color(self::AZUL);
        });

        $image1->text($dados['turno5'], 2010, 2875, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(42);
            $font->color(self::AZUL);
        });

        $image1->text($dados['estag6'], 305, 2975, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(42);
            $font->color(self::AZUL);
        });

        $image1->text($dados['turma6'], 1660, 2975, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(42);
            $font->color(self::AZUL);
        });

        $image1->text($dados['turno6'], 2010, 2975, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(42);
            $font->color(self::AZUL);
        });

        $image1->text($dados['estag7'], 305, 3055, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(42);
            $font->color(self::AZUL);
        });

        $image1->text($dados['turma7'], 1660, 3055, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(42);
            $font->color(self::AZUL);
        });

        $image1->text($dados['turno7'], 2010, 3055, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(42);
            $font->color(self::AZUL);
        });

        $image1->text($dados['estag8'], 305, 3135, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(42);
            $font->color(self::AZUL);
        });

        $image1->text($dados['turma8'], 1660, 3135, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(42);
            $font->color(self::AZUL);
        });

        $image1->text($dados['turno8'], 2010, 3135, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(42);
            $font->color(self::AZUL);
        });

        $image1->text($dados['estag9'], 305, 3225, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(42);
            $font->color(self::AZUL);
        });

        $image1->text($dados['turma9'], 1660, 3225, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(42);
            $font->color(self::AZUL);
        });

        $image1->text($dados['turno9'], 2010, 3225, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(42);
            $font->color(self::AZUL);
        });

        $image1->text($dados['estag10'], 305, 3315, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(42);
            $font->color(self::AZUL);
        });

        $image1->text($dados['turma10'], 1660, 3315, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(42);
            $font->color(self::AZUL);
        });

        $image1->text($dados['turno10'], 2010, 3315, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(42);
            $font->color(self::AZUL);
        });

        $image2 = Image::make($documentPaths[1]);

        if ($dados['opc1'] === "sim") {
            $image2->text('X', 300, 605, function ($font) {
                $font->file(resource_path('fonts/Arial.ttf'));
                $font->size(42);
                $font->color(self::AZUL);
            });
        } elseif ($dados['opc1'] === "parcialmente") {
            $image2->text('X', 550, 605, function ($font) {
                $font->file(resource_path('fonts/Arial.ttf'));
                $font->size(42);
                $font->color(self::AZUL);
            });
        } elseif ($dados['opc1'] === "nao") {
            $image2->text('X', 900, 605, function ($font) {
                $font->file(resource_path('fonts/Arial.ttf'));
                $font->size(42);
                $font->color(self::AZUL);
            });
        }

        if ($dados['opc2'] === "sim") {
            $image2->text('X', 300, 695, function ($font) {
                $font->file(resource_path('fonts/Arial.ttf'));
                $font->size(42);
                $font->color(self::AZUL);
            });
        } elseif ($dados['opc2'] === "parcialmente") {
            $image2->text('X', 550, 695, function ($font) {
                $font->file(resource_path('fonts/Arial.ttf'));
                $font->size(42);
                $font->color(self::AZUL);
            });
        } elseif ($dados['opc2'] === "nao") {
            $image2->text('X', 900, 695, function ($font) {
                $font->file(resource_path('fonts/Arial.ttf'));
                $font->size(42);
                $font->color(self::AZUL);
            });
        }

        if ($dados['opc3'] === "sim") {
            $image2->text('X', 300, 890, function ($font) {
                $font->file(resource_path('fonts/Arial.ttf'));
                $font->size(42);
                $font->color(self::AZUL);
            });
        } elseif ($dados['opc3'] === "parcialmente") {
            $image2->text('X', 550, 890, function ($font) {
                $font->file(resource_path('fonts/Arial.ttf'));
                $font->size(42);
                $font->color(self::AZUL);
            });
        } elseif ($dados['opc3'] === "nao") {
            $image2->text('X', 900, 890, function ($font) {
                $font->file(resource_path('fonts/Arial.ttf'));
                $font->size(42);
                $font->color(self::AZUL);
            });
        }

        if ($dados['opc4'] === "sim") {
            $image2->text('X', 300, 1005, function ($font) {
                $font->file(resource_path('fonts/Arial.ttf'));
                $font->size(42);
                $font->color(self::AZUL);
            });
        } elseif ($dados['opc4'] === "parcialmente") {
            $image2->text('X', 550, 1005, function ($font) {
                $font->file(resource_path('fonts/Arial.ttf'));
                $font->size(42);
                $font->color(self::AZUL);
            });
        } elseif ($dados['opc4'] === "nao") {
            $image2->text('X', 900, 1005, function ($font) {
                $font->file(resource_path('fonts/Arial.ttf'));
                $font->size(42);
                $font->color(self::AZUL);
            });
        }

        if ($dados['opc5'] === "sim") {
            $image2->text('X', 300, 1105, function ($font) {
                $font->file(resource_path('fonts/Arial.ttf'));
                $font->size(42);
                $font->color(self::AZUL);
            });
        } elseif ($dados['opc5'] === "parcialmente") {
            $image2->text('X', 550, 1105, function ($font) {
                $font->file(resource_path('fonts/Arial.ttf'));
                $font->size(42);
                $font->color(self::AZUL);
            });
        } elseif ($dados['opc5'] === "nao") {
            $image2->text('X', 900, 1105, function ($font) {
                $font->file(resource_path('fonts/Arial.ttf'));
                $font->size(42);
                $font->color(self::AZUL);
            });
        }

        // comentarios
        $image2->text($dados['3_l1'], 235, 1360, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(42);
            $font->color(self::AZUL);
        });

        //desafio implementacao
        $image2->text($dados['4_l1'], 235, 1740, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(42);
            $font->color(self::AZUL);
        });

        //aspecto existosos
        $image2->text($dados['5_l1'], 235, 2180, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(42);
            $font->color(self::AZUL);
        });

        //sugestoes
        $image2->text($dados['6_l1'], 235, 2625, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(42);
            $font->color(self::AZUL);
        });

        $images = [$image1, $image2];
        $this->toPDF($images, $dados);
        Session::flash('pdf_generated_success', 'Documento preenchido com sucesso!');
        //$estagio = new EstagioController();

        return redirect()->to(route('estagio.documentos', ['id' => $this->estagio->id]));
    }

    public function gerarPDF_Supervisor_UPE($path, $aluno, $curso, $disciplina, $tipo)
    {
        $pdf = new TCPDF();
        $pdf->SetMargins(0, 0, 0);
        $pdf->SetPrintHeader(false);
        $pdf->setPrintFooter(false);

        $pdf->AddPage();

        $tmpImagePath = tempnam(sys_get_temp_dir(), 'documento') . '.jpg';
        $image = Image::make($path);

        $image->text($aluno, 750, 625, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(37);
            $font->color('#00009C');
        });

        $image->text($disciplina . "/" . $curso, 1350, 695, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(37);
            $font->color('#00009C');
        });

        $image->text($tipo, 400, 837, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(37);
            $font->color('#00009C');
        });

        $image->save($tmpImagePath, 100);

        $pdf->Image($tmpImagePath, 7, 0, 200);

        unlink($tmpImagePath);
        $pdfFilePath = tempnam(sys_get_temp_dir(), 'pdf') . '.pdf';

        $pdf->Output($pdfFilePath, 'F');
        $pdf->close();

        return $pdfFilePath;
    }

    public function editTermoCompromissoUFAPE($path, $dados)
    {
        Settings::setZipClass(Settings::PCLZIP);

        if ($dados['tipo_curso'] == "Bacharelado") {
            $dados = array_slice($dados, 0, -1);

            $templateProcessor = new TemplateProcessor($path);

            if ($dados['segunda_ufape']) {
                $templateProcessor->setValue('segunda_ufape', 'X');
            } else {
                $templateProcessor->setValue('segunda_ufape', '');
            }

            if ($dados['terca_ufape']) {
                $templateProcessor->setValue('terca_ufape', 'X');
            } else {
                $templateProcessor->setValue('terca_ufape', '');
            }

            if ($dados['quarta_ufape']) {
                $templateProcessor->setValue('quarta_ufape', 'X');
            } else {
                $templateProcessor->setValue('quarta_ufape', '');
            }

            if ($dados['quinta_ufape']) {
                $templateProcessor->setValue('quinta_ufape', 'X');
            } else {
                $templateProcessor->setValue('quinta_ufape', '');
            }

            if ($dados['sexta_ufape']) {
                $templateProcessor->setValue('sexta_ufape', 'X');
            } else {
                $templateProcessor->setValue('sexta_ufape', '');
            }

            $templateProcessor->setValues($dados);

            $temp_path = DocService::tmpdoc();

            $templateProcessor->saveAs($temp_path);

            $this->salvar_no_banco($temp_path, $dados);

            return redirect()->to(route('estagio.documentos', ['id' => $this->estagio->id]));
        } elseif ($dados['tipo_curso'] == "Licenciatura") {

            $dados = array_slice($dados, 0, -1);

            $templateProcessor = new TemplateProcessor(storage_path('app/docs/UFAPE/termo_compromisso_ufape_lic.docx'));

            if ($dados['segunda_ufape']) {
                $templateProcessor->setValue('segunda_ufape', 'X');
            } else {
                $templateProcessor->setValue('segunda_ufape', '');
            }

            if ($dados['terca_ufape']) {
                $templateProcessor->setValue('terca_ufape', 'X');
            } else {
                $templateProcessor->setValue('terca_ufape', '');
            }

            if ($dados['quarta_ufape']) {
                $templateProcessor->setValue('quarta_ufape', 'X');
            } else {
                $templateProcessor->setValue('quarta_ufape', '');
            }

            if ($dados['quinta_ufape']) {
                $templateProcessor->setValue('quinta_ufape', 'X');
            } else {
                $templateProcessor->setValue('quinta_ufape', '');
            }

            if ($dados['sexta_ufape']) {
                $templateProcessor->setValue('sexta_ufape', 'X');
            } else {
                $templateProcessor->setValue('sexta_ufape', '');
            }

            if ($dados['segunda_estagio']) {
                $templateProcessor->setValue('segunda_estagio', 'X');
            } else {
                $templateProcessor->setValue('segunda_estagio', '');
            }

            if ($dados['terca_estagio']) {
                $templateProcessor->setValue('terca_estagio', 'X');
            } else {
                $templateProcessor->setValue('terca_estagio', '');
            }

            if ($dados['quarta_estagio']) {
                $templateProcessor->setValue('quarta_estagio', 'X');
            } else {
                $templateProcessor->setValue('quarta_estagio', '');
            }

            if ($dados['quinta_estagio']) {
                $templateProcessor->setValue('quinta_estagio', 'X');
            } else {
                $templateProcessor->setValue('quinta_estagio', '');
            }

            if ($dados['sexta_estagio']) {
                $templateProcessor->setValue('sexta_estagio', 'X');
            } else {
                $templateProcessor->setValue('sexta_estagio', '');
            }

            $templateProcessor->setValues($dados);

            $temp_path = DocService::tmpdoc();

            $templateProcessor->saveAs($temp_path);

            $this->salvar_no_banco($temp_path, $dados);

            return redirect()->to(route('estagio.documentos', ['id' => $this->estagio->id]));
        }
    }

    public function edit_ficha_frequencia_ufape($path, $dados)
    {
        $tp = new TemplateProcessor($path);
        $tp->setValues($dados);
        if ($dados['tipo'] == 'eo') {
            $tp->setValue('eo', 'X');
            $tp->setValue('eno', ' ');
        } else {
            $tp->setValue('eno', 'X');
            $tp->setValue('eo', ' ');
        }

        $temp_path = DocService::tmpdoc();
        $tp->saveAs($temp_path);

        $this->salvar_no_banco($temp_path, $dados);

        return redirect()->to(route('estagio.documentos', ['id' => $this->estagio->id]));
    }

    public function edit_termo_aditivo_ufape($path, $dados)
    {
        $tp = new TemplateProcessor($path);
        $tp->setValues($dados);

        $temp_path = DocService::tmpdoc();
        $tp->saveAs($temp_path);

        $this->salvar_no_banco($temp_path, $dados);

        return redirect()->to(route('estagio.documentos', ['id' => $this->estagio->id]));
    }

    public function edit_declaracao_ch($path, $dados)
    {
        $tp = new TemplateProcessor($path);
        $tp->setValues($dados);
        if ($dados['tipo_curso'] == 'bach') {
            $tp->setValue('tipo_curso', 'bacharelado');
        } else {
            $tp->setValue('tipo_curso', 'licenciatura');
        }

        //dd($dados['logomarca_empresa']);

        $img_path = storage_path('app/docs/UFAPE/logomarca_tmp/' . $dados['logomarca_empresa']);

        $tp->setImageValue('logomarca_empresa', $img_path);
        unlink($img_path);

        $temp_path = DocService::tmpdoc();

        $tp->saveAs($temp_path);

        $this->salvar_no_banco($temp_path, $dados);

        return redirect()->to(route('estagio.documentos', ['id' => $this->estagio->id]));
    }

    public function edit_carta_aceite_supervisor_ufape($path, $dados)
    {
        $tp = new TemplateProcessor($path);
        $tp->setValue('aluno', $dados['aluno']);
        $tp->setValue('curso', $dados['curso']);
        $tp->setValue('data_inicio', $dados['data_inicio']);
        $tp->setValue('data_fim', $dados['data_fim']);

        $temp_path = DocService::tmpdoc();
        $tp->saveAs($temp_path);


        $doc = file_get_contents($temp_path);

        $estagio = Estagio::find($this->estagio->id);

        $conteudoArrayBytes = array_values(unpack('C*', $doc));

        $documento = null;

        return view('estagio.documentos.preview', ['conteudoArrayBytes' => $conteudoArrayBytes, 'documento' => $documento, 'estagio' => $estagio]);
        // return redirect()->to(route('estagio.documentos', ['id' => $this->estagio->id]));
    }

    public function downloadModeloDoc($estagioId, $docId)
    {
        $path = storage_path('app/docs/UFAPE/carta_aceite_supervisor.docx');
        $estagio = Estagio::findOrFail($estagioId);
        $aluno = Aluno::findOrFail($estagio->aluno_id);
        $curso = Curso::findOrFail($estagio->curso_id);

        $tp = new TemplateProcessor($path);
        $tp->setValue('aluno', $aluno->nome_aluno);
        $tp->setValue('curso', $curso->nome);

        $dataInicio = Carbon::parse($estagio->data_inicio);
        $dataInicioFormatada = $dataInicio->locale('pt_BR')->isoFormat('LL');

        $dataFim = Carbon::parse($estagio->data_fim);
        $dataFimFormatada = $dataFim->locale('pt_BR')->isoFormat('LL');

        $tp->setValue('data_inicio', $dataInicioFormatada);
        $tp->setValue('data_fim', $dataFimFormatada);

        $temp_path = DocService::tmpdoc();
        $tp->saveAs($temp_path);


        $docBlob = file_get_contents($temp_path);

        $nome_aluno = $aluno->nome_aluno;


        // Defina o nome do arquivo para download
        $nomeArquivo = 'carta_de_aceite_supervisor' . '_' . $nome_aluno . '.docx';
        $nome_arquivo_formatado = str_replace(' ', '_', $nomeArquivo);
        $nome_arquivo_formatado = strtolower($nome_arquivo_formatado);
        // Configurar os headers para o download do arquivo
        $headers = [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            'Content-Disposition' => 'attachment; filename="' . $nome_arquivo_formatado . '"',
        ];

        // Retornar a resposta com o conteúdo do arquivo e os headers configurados
        return Response::make($docBlob, 200, $headers);
    }

    public function getListaDeDocumentosId()
    {
        $listaDocumentosObrigatorios = new ListaDocumentosObrigatorios();
        $document = $listaDocumentosObrigatorios->where('id', $this->documentType)->first();
        return $document->id;
    }
}
