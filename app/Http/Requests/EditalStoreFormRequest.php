<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
                "data_inicio"=>"required|date",
                "data_fim"=>"required|date",
                "programa"=>"required",
                "disciplinas"=>"",
                "titulo_edital"=>"required",
                "valor_bolsa"=>"nullable|numeric",
                "semestre"=>"required|regex:/^\d{4}\.\d$/",
                "checkDisciplina" => "required",
                "checkBolsa" => "required"
                //"descricao"=>"required",
            ];
        }


    public function messages(){
        return [
            "required" => "O campo :attribute é obrigatório.",
            "date" => "O campo :attribute deve ser um date.",
            "numeric" => "O campo :attribute deve ser um número.",
            "regex" => "O campo :attribute deve seguir o exemplo: 2023.3"             
        ];
    }
}
