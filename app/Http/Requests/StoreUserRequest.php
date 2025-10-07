<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            "name" => ["required", "max:50"],
            "name_social" => ["max:50"],
            "email" => ["required", "email", "unique:users,email"],
            "tipoUser" => ['required', 'in:servidor,orientado,aluno'],
            "password" => ["required", "min:8", "max:30"],
            "cpf" => ["required", "cpf", "unique:users"],
            'curso_id'  => ['required_if:tipoUser,aluno', 'exists:cursos,id',],
            'semestre_entrada' => ['required_if:tipoUser,aluno'],
            "matricula" => ["unique:orientadors,matricula", "unique:servidors,matricula"]
        ];
    }

    public function messages()
    {
        return [
            "required" => "O campo :attribute é obrigatório.",
            "email" => "O email está no formato incorreto.",
            "nome.max" => "O campo nome não pode ter mais que 50 caracteres.",
            "senha.max" => "A senha não pode ter mais que 30 dígitos.",
            "senha.min" => "A senha não pode ter menos que 4 dígitos.",
            "unique" => "O valor do campo :attribute já está em uso.",
            "formato_cpf" => "O campo :attribute está no formato incorreto.",
        ];
    }
}
