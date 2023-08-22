<?php

namespace App\Http\Controllers;

use Intervention\Image\Facades\Image;
use TCPDF;

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

        // Renderizar o PDF no navegador
        $pdf->Output('documento.pdf', 'I');
        
        unlink($tmpImagePath);

        // Encerrar a criação do PDF
        $pdf->close();

        return $pdf->Output('documento.pdf', 'I');
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

        return $this->toPDF($image);
    }
}
