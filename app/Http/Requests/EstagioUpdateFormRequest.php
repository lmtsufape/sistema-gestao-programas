<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EstagioUpdateFormRequest extends FormRequest
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
                "descricao" => "required",
                "data_inicio" => "required|date",
                "data_fim" => "required|date",
                "data_solicitacao" => "required|date",
            ];
        }


    public function messages(){
        return [
            "date" => "O campo :attribute deve ser um date.",
            "required" => "O campo :attribute é obrigatório.",
        ];
    }
}
