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
                "semestre"=>"required|string",
                "data_inicio"=>"required|date",
                "data_fim"=>"required|date",
                "curso"=>"required|numeric",
                "programa"=>"required|numeric",
                "orientadores"=>"required|array",
            ];
        }


    public function messages(){
        return [
            "required" => "O campo :attribute é obrigatório.",
            "string" => "O campo :atribute deve ser uma string.",
            "date" => "O campo :atribute deve ser um date.",
            "numeric" => "O campo :atribute deve ser um número.",
            "array" => "O campo :atribute deve ser um array."
        ];
    }
}
