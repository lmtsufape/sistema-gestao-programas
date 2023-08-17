<?php

namespace App\Http\Controllers;

use Intervention\Image\Facades\Image;

class PDFController extends Controller
{
    public function editImage($documentPath, $documentType)
    {
        $documentPath = storage_path('app/docs/termo_compromisso/0.png');
        $documentType = 'termo_compromisso';

        // terá um método para cada documento, esse switchcase servirá para selecionar o método especifico de cada documento.
        switch ($documentType) {
            case 'termo_compromisso':
                return $this->editTermoCompromisso($documentPath);
                break;
            default:
                return redirect()->back()->with('error', 'Tipo de documento desconhecido.');
        }
    }

    private function editTermoCompromisso($documentPath)
    {
        $image = Image::make($documentPath);

        $image->text('Seu Texto Aqui', 100, 100, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(36);
            $font->color('#FFFFFF');
            $font->align('center');
            $font->valign('top');
        });

        $newDocumentPath = storage_path('app/pdf_images/termo.png');
        $image->save($newDocumentPath);

        $headers = [
            'Content-Type' => 'image/png',
        ];

        return response()->download($newDocumentPath, 'termo.png', $headers);
    }

    public function index()
    {
        return view("pdf.index");
    }
}
