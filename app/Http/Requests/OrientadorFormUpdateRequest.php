<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrientadorFormUpdateRequest extends FormRequest
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
            "nome" => "max:50",
            "email" => "email",
            "senha" => "min:4|max:30",
            "cpf" => "formato_cpf|cpf|unique:servidors|unique:alunos",
            "matricula" => "required",
            "cursos" => 'required|array|min:1'
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
