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
                $documentPath1 = storage_path('app/docs/termo_encaminhamento/0.png');
                $documentPath2 = storage_path('app/docs/termo_encaminhamento/1.png');
                return $this->editTermoCompromisso([$documentPath1, $documentPath2], $dados);
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
        $pdf = new FPDF();
        $pdf->AddPage();

        // Primeira Imagem
        $image1 = Image::make($documentPath['documentPath1']);

        // Edições específicas para a primeira imagem
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

        // Salvar a imagem editada temporariamente
        $tmpImagePath1 = tempnam(sys_get_temp_dir(), 'documento') . '.jpg';
        $image1->save($tmpImagePath1, 100);

        // Incorporar a primeira imagem no PDF
        $pdf->Image($tmpImagePath1, 10, 10, 190); // Ajuste as coordenadas e dimensões conforme necessário

        // Remover o arquivo temporário da primeira imagem
        unlink($tmpImagePath1);

        // Adicionar uma nova página ao PDF para a próxima imagem
        $pdf->AddPage();

        // Segunda Imagem
         $image2 = Image::make($documentPath['documentPath2']);

         // Edições específicas para a segunda imagem
         $image2->text('oioioi', 300, 695, function ($font) {
                $font->file(resource_path('fonts/Arial.ttf'));    
                $font->size(42);
                $font->color(self::AZUL);
            });
        
         // ... Outras edições para a segunda imagem
        
        // Salvar a imagem editada temporariamente
        $tmpImagePath2 = tempnam(sys_get_temp_dir(), 'documento') . '.jpg';
        $image2->save($tmpImagePath2, 100);
        
        // Incorporar a segunda imagem no PDF
        $pdf->Image($tmpImagePath2, 10, 10, 190); // Ajuste as coordenadas e dimensões conforme necessário
        // Remover o arquivo temporário da segunda imagem
        unlink($tmpImagePath2);

        
        // $pdfContent = $this->toPDF($image);
        Session::flash('pdf_generated_success', 'Documento preenchido com sucesso!');
        $estagio = new EstagioController();

        return redirect()->to(route('estagio.documentos', ['id' => $estagio->getEstagioAtual()]));
    }
}
