<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SupervisorStoreFormRequest extends FormRequest
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
            "nome"=>"required|max:50",
            "email"=>"required|email",
            "formacao"=>"required|min:4|max:100",
            "cpf" => "required|formato_cpf|cpf|unique:supervisors",
            "telefone" => "required|max:13"
        ];
    }


    public function messages(){
        return [
            "required" => "O campo :attribute é obrigatório.",
            "email" => "O email está no formato incorreto.",
            "nome.max" => "O campo nome não pode ter mais que 50 caracteres.",
            "unique" => "CPF já está em uso."
        ];
    }
}
