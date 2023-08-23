<?php

namespace App\Http\Controllers;

use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Models\DocumentoEstagio;
use Illuminate\Support\Facades\DB;
use TCPDF;
use FPDF;

class PDFController extends Controller
{

    protected const AZUL = '#00009C';

    public function editImage($documentType, $dados)
    {

        $documentType = 'termo_encaminhamento';

        // terá um método para cada documento, esse switchcase servirá para selecionar o método especifico de cada documento.
        switch ($documentType) {
            case 'termo_encaminhamento':
                $documentPath = storage_path('app/docs/termo_encaminhamento/0.png');
                return $this->editTermoCompromisso($documentPath, $dados);
                break;
            default:
                return redirect()->back()->with('error', 'Tipo de documento desconhecido.');
        }
    }

    private function toPDF($image)
    {
        $pdf = new TCPDF();
        $pdf->SetMargins(0, 0, 0);
        $pdf->SetPrintHeader(false);
        $pdf->setPrintFooter(false);

        $pdf->AddPage();

        // Salvar a imagem editada temporariamente
        $tmpImagePath = tempnam(sys_get_temp_dir(), 'documento') . '.jpg';
        $image->save($tmpImagePath, 100);

        // Incorporar a imagem no PDF
        $pdf->Image($tmpImagePath, 7, 0, 200);

        // Capturar a saída PDF em uma variável
        ob_start();
        $pdf->Output('documento.pdf', 'D');
        $pdfContent = ob_get_contents();
        ob_end_clean();

        $generatedPdf = new DocumentoEstagio();
        DB::beginTransaction();
        $generatedPdf->aluno_id = Auth::id();
        $generatedPdf->pdf = $pdfContent;
        $generatedPdf->lista_documentos_obrigatorios_id = 1; //1 por enquanto, pq eu não sei uma forma de pegar o id do estagio atual
        $generatedPdf->save();
        DB::commit();

        // Renderizar o PDF no navegador
        //$pdf->Output('documento.pdf', 'I');

        unlink($tmpImagePath);

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

        /*$dados[0] = 'Universidade de Pernambuco';

        $image->text($dados[], 280, 695, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(42);
            $font->color(self::AZUL);

        }); */

        $image->text($dados['nome'], 280, 1060, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(42);
            $font->color(self::AZUL);
        });

        $image->text($dados['periodo'], 700, 1153, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(42);
            $font->color(self::AZUL);
        });

        $image->text($dados['curso'], 260, 1245, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(42);
            $font->color(self::AZUL);
        });
        $pdfContent = $this->toPDF($image);
        Session::flash('pdf_generated_success', 'Documento preenchido com sucesso!');
        $estagio = new EstagioController();

        return redirect()->to(route('estagio.documentos', ['id' => $estagio->getEstagioAtual()]));
    }
}
