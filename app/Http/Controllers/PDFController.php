<?php

namespace App\Http\Controllers;

use Intervention\Image\Facades\Image;

class PDFController extends Controller
{
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

    private function editTermoCompromisso($documentPath, $dados)
    {
        $image = Image::make($documentPath);
        
        /*$dados[0] = 'Universidade de Pernambuco';

        $image->text($dados[], 280, 695, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(42);
            $font->color('#00009C');

        }); */

        $image->text($dados['nome'], 280, 1060, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(42);
            $font->color('#00009C');

        });

        $image->text($dados['periodo'], 700, 1153, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(42);
            $font->color('#00009C');

        });

        $image->text($dados['curso'], 260, 1245, function ($font) {
            $font->file(resource_path('fonts/Arial.ttf'));
            $font->size(42);
            $font->color('#00009C');

        });

        return $image->response('png');
    }

    public function index()
    {
        return view("pdf.index");
    }
}
