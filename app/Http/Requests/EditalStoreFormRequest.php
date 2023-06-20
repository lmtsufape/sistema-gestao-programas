<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Carbon\Carbon;

class EditalStoreFormRequest extends FormRequest
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
                "data_inicio"=>"required|date|after:" . Carbon::createFromDate(2001, 1, 1)->format('Y-m-d'),
                "data_fim"=>"required|date|after:data_inicio",
                "programa"=>"required",
                "disciplinas"=>"",
                "titulo_edital"=>"required",
                "valor_bolsa"=>"nullable|numeric",
                "semestre"=>"required|regex:/^\d{4}\.\d$/",
                "checkDisciplina" => "required"
                //"descricao"=>"required",
            ];
        }


    public function messages(){
        return [
            "required" => "O campo :attribute é obrigatório.",
            "date" => "O campo :attribute deve ser uma data válida: DD/MM/AAAA.",
            "data_inicio.after" => "O campo :attribute deve ser uma data válida: DD/MM/AAAA.",
            "data_fim.after" => 'A data final deve ser posterior à data de início.',
            "numeric" => "O campo :attribute deve ser um número.",
            "regex" => "O campo :attribute deve seguir o exemplo: 2023.3"             
        ];
    }
}
