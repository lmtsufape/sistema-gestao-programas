<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditalUpdateFormRequest extends FormRequest
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
                "disciplina"=>"required",
                "titulo_edital"=>"required",
                "valor_bolsa"=>"required|numeric",
                "semestre"=>"required",
                //"descricao"=>"required",
            ];
        }


    public function messages(){
        return [
            "date" => "O campo :attribute deve ser um date.",
            "numeric" => "O campo :attribute deve ser um número.",
            "required" => "O campo :attribute é obrigatório."
        ];
    }
}