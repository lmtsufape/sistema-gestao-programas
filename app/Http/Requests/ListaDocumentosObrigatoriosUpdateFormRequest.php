<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ListaDocumentosObrigatoriosUpdateFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            // "termoDeEncaminhamentoDataLimite" => "required|date",
            // "termoDeCompromissoDataLimite" => "required|date",
            // "planoDeAtividadesDataLimite" => "required|date",
            // "fichaDeFrequenciaDataLimite" => "required|date",
            // "relatorioDeAcompanhamentoDataLimite" => "required|date",
            // "relatorioDeAvaliacaoDataLimite" => "required|date",
            // "formularioDeFrequenciaDataLimite" => "required|date"
        ];
    }
}
