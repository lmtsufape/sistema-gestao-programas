<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    public function authorize()
    {
        // Add your authorization logic here
        // Only allow users with 'admin' or 'servidor' role to access this route
        return true;
    }

    public function rules()
    {
        return [
            "nome" => "required|max:50",
            "nome_social" => "max:50",
            "email" => "required|email|unique:users,email",
            "tipoUser" => 'required',
            "senha" => "required|min:4|max:8",
            "cpf" => "required|formato_cpf|unique:servidors|unique:alunos|unique:orientadors",
            "matricula" => "required|unique:orientadors,matricula|unique:servidors,matricula"
        ];
    }

    public function messages()
    {
        return [
            "required" => "O campo :attribute é obrigatório.",
            "email" => "O email está no formato incorreto.",
            "nome.max" => "O campo nome não pode ter mais que 50 caracteres.",
            "senha.max" => "A senha não pode ter mais que 8 dígitos.",
            "senha.min" => "A senha não pode ter menos que 4 dígitos.",
            "unique" => "O valor do campo :attribute já está em uso.",
            "formato_cpf" => "O campo :attribute está no formato incorreto.",
        ];
    }
}
