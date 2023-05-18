<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DisciplinaStoreFormRequest extends FormRequest
{
    public function authorize() {
        return true;
    }

    public function rules() {
        return [
            "nome" => "max:50",
            "nome" => 'required',
            "curso" => 'required'
        ];
    }

    public function messages(){
        return [
            "nome.max" => "O campo nome não pode ter mais que 50 caracteres.",
        ];
    }
}
