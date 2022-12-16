<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProgramaStoreFormRequest extends FormRequest
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
                "nome"=>"required|max:25",
                "servidores"=>"required"
            ];
        }


    public function messages(){
        return [
            "required" => "O campo :attribute é obrigatório.",
            "nome.max" => "O campo nome não pode ter mais que 50 caracteres."
        ];
    }
}
