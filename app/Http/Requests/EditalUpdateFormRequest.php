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
                "semestre"=>"string",
                "data_inicio"=>"date",
                "data_fim"=>"date",
                "curso"=>"numeric",
                "programa"=>"numeric",
                "orientadores"=>"array",
            ];
        }


    public function messages(){
        return [
            "string" => "O campo :atribute deve ser uma string.",
            "date" => "O campo :atribute deve ser um date.",
            "numeric" => "O campo :atribute deve ser um número.",
            "array" => "O campo :atribute deve ser um array."
        ];
    }
}
