<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CadastreSeStoreFormRequest extends FormRequest
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
            "nome" => "required|string|max:50",
            "email" => "required|email",
            "cpf" => "required|formato_cpf|cpf|unique:servidors|unique:orientadors",
            "senha" => "required|min:4|max:30",
            'tipoUser' => ['required', Rule::in(['servidor', 'orientador', 'aluno'])],
        ];
    }

    public function messages(){
        return [
            "required" => "O campo :attribute é obrigatório.",
            "email" => "O email está no formato incorreto.",
            "nome.max" => "O campo nome não pode ter mais que 50 caracteres.",
            "senha.max" => "A senha não pode ter mais que 30 dígitos.",
            "senha.min" => "A senha não pode ter menos que 4 dígitos.",
            "unique" => "CPF já está em uso."
        ];
    }
}
