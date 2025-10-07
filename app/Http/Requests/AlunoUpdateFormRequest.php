<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AlunoUpdateFormRequest extends FormRequest
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
            "name" => ["max:50"],
            'cpf'   => ['required', 'cpf', Rule::unique('users', 'cpf')->ignore($this->route('aluno')->user->id),],
            'name_social'   => ['nullable', 'string', 'max:255'],
            "email" => ["email"],
            'password' => ['nullable', 'string', 'min:8'],
            'image' => ['nullable','image','mimes:jpg,jpeg,png,webp','max:2048'],
            'semestre_entrada' =>['required'],
            'curso_id'  => []
        ];
    }

    public function messages(){
        return [
            "email" => "O email está no formato incorreto.",
            "nome.max" => "O campo nome não pode ter mais que 50 caracteres.",
            "senha.max" => "A senha não pode ter mais que 30 dígitos.",
            "senha.min" => "A senha não pode ter menos que 4 dígitos.",
            "unique" => "CPF já está em uso."
        ];
    }
}
