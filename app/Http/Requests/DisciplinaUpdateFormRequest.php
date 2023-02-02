<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DisciplinaUpdateFormRequest extends FormRequest
{
    public function authorize() {
        return true;
    }

    public function rules() {
        return [
            "nome" => "max:50",
        ];
    }

    public function messages(){
        return [
            "nome.max" => "O campo nome não pode ter mais que 50 caracteres.",
        ];
    }
}
