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
                "data_inicio"=>"date",
                "data_fim"=>"date",
                "programa"=>"numeric",
                'disciplina'=>'array'
            ];
        }


    public function messages(){
        return [
            "date" => "O campo :atribute deve ser um date.",
            "numeric" => "O campo :atribute deve ser um número."
        ];
    }
}
