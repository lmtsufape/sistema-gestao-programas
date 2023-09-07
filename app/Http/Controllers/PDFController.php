<?php

namespace App\Http\Controllers;

use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Models\DocumentoEstagio;
use App\Models\ListaDocumentosObrigatorios;
use Illuminate\Support\Facades\DB;
use TCPDF;

class PDFController extends Controller
{
    private const AZUL = '#00009C';
    private const FONT = 'fonts/Arial.ttf';
    private $documentType = 0;

    public function editImage($documentType, $dados)
    {
        $this->documentType = $documentType;

        // terá um método para cada documento, esse switchcase servirá para selecionar o método especifico de cada documento.
        switch ($this->documentType) {
            //termo de encaminhamento
            case 1:
                $documentPath1 = storage_path('app/docs/termo_encaminhamento/0.png');
                $documentPath2 = storage_path('app/docs/termo_encaminhamento/1.png');
                return $this->editTermoEncaminhamento([$documentPath1,$documentPath2], $dados);
                break;
            //termo de compromisso
            case 2:
                $documentPath = storage_path('app/docs/termo_compromisso/0.png');
                return $this->editTermoCompromisso($documentPath, $dados);
                break;
            
            case 4:
                $documentPath = storage_path('app/docs/ficha-frequencia/0.png');
                return $this->editFichaFrequencia([$documentPath], $dados);
                break;

            default:
                return redirect()->back()->with('error', 'Tipo de documento desconhecido.');
        }
    }
    
    

    private function toPDF($images)
    {
        $pdf = new TCPDF();
        $pdf->SetMargins(0, 0, 0);
        $pdf->SetPrintHeader(false);
        $pdf->setPrintFooter(false);

        $pdf->AddPage();

        foreach($images as $index => $image)
        {
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
        ob_end_clean();

        $generatedPdf = new DocumentoEstagio();
        DB::beginTransaction();
        $generatedPdf->id = $this->getListaDeDocumentosId();
        $generatedPdf->aluno_id = Auth::id();
        $generatedPdf->pdf = $pdfContent;
        $generatedPdf->lista_documentos_obrigatorios_id = $this->getListaDeDocumentosId();
        $generatedPdf->save();

        $listaDocumentosObrigatorios = ListaDocumentosObrigatorios::find($this->getListaDeDocumentosId());
        $listaDocumentosObrigatorios->data_envio = now();
        $listaDocumentosObrigatorios->save();

        DB::commit();

        // Renderizar o PDF no navegador
        //$pdf->Output('documento.pdf', 'I');

        //unlink($tmpImagePath);

        $pdf->close();

        return $pdfContent;
    }

    public function viewPDF($id)
    {
        $documento = DocumentoEstagio::findOrFail($id);

        if ($documento->aluno_id != Auth::id()) {
            return redirect()->back()->with('error', 'Você não tem permissão para visualizar este documento.');
        }

        $pdfData = $documento->pdf;
        header("Content-type: application/pdf");
        echo $pdfData;
    }

    private function editTermoCompromisso($documentPath, $dados)
    {
        $image = Image::make($documentPath);

        //INSTITUIÇÃO DE ENSINO
        $image->text($dados['professorComponenteCurricular'], 730, 915, function ($font) {
            $font->file(resource_path(self::FONT));
            $font->size(37);
            $font->color(self::AZUL);
        });

        $image->text($dados['instituicaoEmail'], 300, 960, function ($font) {
            $font->file(resource_path(self::FONT));
            $font->size(37);
            $font->color(self::AZUL);
        });

        $image->text($dados['orientador'], 530, 1000, function ($font) {
            $font->file(resource_path(self::FONT));
            $font->size(37);
            $font->color(self::AZUL);
        });

        $image->text($dados['emailOrientador'], 295, 1050, function ($font) {
            $font->file(resource_path(self::FONT));
            $font->size(37);
            $font->color(self::AZUL);
        });

        //UNIDADE CONCEDENTE
        $image->text($dados['instituicaoUnidadeConcedente'], 360, 1146, function ($font) {
            $font->file(resource_path(self::FONT));
            $font->size(37);
            $font->color(self::AZUL);
        });

        $image->text($dados['cnpj'], 290, 1190, function ($font) {
            $font->file(resource_path(self::FONT));
            $font->size(37);
            $font->color(self::AZUL);
        });

        $image->text($dados['localEstagio'], 460, 1237, function ($font) {
            $font->file(resource_path(self::FONT));
            $font->size(37);
            $font->color(self::AZUL);
        });

        $image->text($dados['endereco'], 350, 1282, function ($font) {
            $font->file(resource_path(self::FONT));
            $font->size(37);
            $font->color(self::AZUL);
        });

        $image->text($dados['numero'], 230, 1325, function ($font) {
            $font->file(resource_path(self::FONT));
            $font->size(37);
            $font->color(self::AZUL);
        });

        $image->text($dados['complemento'], 797, 1325, function ($font) {
            $font->file(resource_path(self::FONT));
            $font->size(37);
            $font->color(self::AZUL);
        });

        $image->text($dados['cep'], 267, 1372, function ($font) {
            $font->file(resource_path(self::FONT));
            $font->size(37);
            $font->color(self::AZUL);
        });

        $image->text($dados['bairro'], 900, 1372, function ($font) {
            $font->file(resource_path(self::FONT));
            $font->size(37);
            $font->color(self::AZUL);
        });

        $image->text($dados['cidade'], 1473, 1372, function ($font) {
            $font->file(resource_path(self::FONT));
            $font->size(37);
            $font->color(self::AZUL);
        });

        $image->text($dados['estado'], 2000, 1372, function ($font) {
            $font->file(resource_path(self::FONT));
            $font->size(37);
            $font->color(self::AZUL);
        });

        $image->text($dados['representanteLegal'], 525, 1420, function ($font) {
            $font->file(resource_path(self::FONT));
            $font->size(37);
            $font->color(self::AZUL);
        });

        $image->text($dados['cargoRepresentante'], 1610, 1420, function ($font) {
            $font->file(resource_path(self::FONT));
            $font->size(37);
            $font->color(self::AZUL);
        });

        $image->text($dados['supervisor'], 555, 1465, function ($font) {
            $font->file(resource_path(self::FONT));
            $font->size(37);
            $font->color(self::AZUL);
        });

        $image->text($dados['cargoSupervisor'], 1605, 1465, function ($font) {
            $font->file(resource_path(self::FONT));
            $font->size(37);
            $font->color(self::AZUL);
        });

        $image->text($dados['formacaoSupervisor'], 357, 1512, function ($font) {
            $font->file(resource_path(self::FONT));
            $font->size(37);
            $font->color(self::AZUL);
        });

        $image->text($dados['cpfSupervisor'], 1173, 1512, function ($font) {
            $font->file(resource_path(self::FONT));
            $font->size(37);
            $font->color(self::AZUL);
        });

        $image->text($dados['emailSupervisor'], 295, 1558, function ($font) {
            $font->file(resource_path(self::FONT));
            $font->size(37);
            $font->color(self::AZUL);
        });

        $image->text($dados['telefoneSupervisor'], 1397, 1558, function ($font) {
            $font->file(resource_path(self::FONT));
            $font->size(37);
            $font->color(self::AZUL);
        });

        //ESTAGIÁRIO
        $image->text($dados['nomeAluno'], 288, 1651, function ($font) {
            $font->file(resource_path(self::FONT));
            $font->size(37);
            $font->color(self::AZUL);
        });

        $image->text($dados['cpfAluno'], 263, 1697, function ($font) {
            $font->file(resource_path(self::FONT));
            $font->size(37);
            $font->color(self::AZUL);
        });

        $image->text($dados['curso'], 958, 1697, function ($font) {
            $font->file(resource_path(self::FONT));
            $font->size(37);
            $font->color(self::AZUL);
        });

        $image->text($dados['periodo'], 1705, 1697, function ($font) {
            $font->file(resource_path(self::FONT));
            $font->size(37);
            $font->color(self::AZUL);
        });

        $image->text($dados['enderecoAluno'], 350, 1742, function ($font) {
            $font->file(resource_path(self::FONT));
            $font->size(37);
            $font->color(self::AZUL);
        });

        $image->text($dados['numeroEnderecoAluno'], 230, 1790, function ($font) {
            $font->file(resource_path(self::FONT));
            $font->size(37);
            $font->color(self::AZUL);
        });

        $image->text($dados['complementoAluno'], 800, 1790, function ($font) {
            $font->file(resource_path(self::FONT));
            $font->size(37);
            $font->color(self::AZUL);
        });

        $image->text($dados['cepAluno'], 265, 1835, function ($font) {
            $font->file(resource_path(self::FONT));
            $font->size(37);
            $font->color(self::AZUL);
        });

        $image->text($dados['bairroAluno'], 875, 1835, function ($font) {
            $font->file(resource_path(self::FONT));
            $font->size(37);
            $font->color(self::AZUL);
        });

        $image->text($dados['cidadeAluno'], 1473, 1835, function ($font) {
            $font->file(resource_path(self::FONT));
            $font->size(37);
            $font->color(self::AZUL);
        });

        $image->text($dados['estadoAluno'], 2020, 1835, function ($font) {
            $font->file(resource_path(self::FONT));
            $font->size(37);
            $font->color(self::AZUL);
        });

        $image->text($dados['telefoneAluno'], 393, 1880, function ($font) {
            $font->file(resource_path(self::FONT));
            $font->size(37);
            $font->color(self::AZUL);
        });

        $image->text($dados['emailAluno'], 1187, 1880, function ($font) {
            $font->file(resource_path(self::FONT));
            $font->size(37);
            $font->color(self::AZUL);
        });


        $this->toPDF($image);
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
        $this->toPDF($images);
        Session::flash('pdf_generated_success', 'Documento preenchido com sucesso!');
        $estagio = new EstagioController();

        return redirect()->to(route('estagio.documentos', ['id' => $estagio->getEstagioAtual()]));
    }

    private function editFichaFrequencia($documentPaths, $dados)
    {
        $image = Image::make($documentPaths[0]);

        $image->text($dados['campus'], 300, 695, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(42);
            $font->color(self::AZUL);
        });

        $images = [$image];
        $this->toPDF($images);
        Session::flash('pdf_generated_success', 'Documento preenchido com sucesso!');
        $estagio = new EstagioController();

        return redirect()->to(route('estagio.documentos', ['id' => $estagio->getEstagioAtual()]));
    }

    protected function getListaDeDocumentosId(){
        $listaDocumentosObrigatorios = new ListaDocumentosObrigatorios();
        $document = $listaDocumentosObrigatorios->where('id', $this->documentType)->first();
        return $document->id;
    }
}
