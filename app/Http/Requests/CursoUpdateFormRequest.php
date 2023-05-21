<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CursoUpdateFormRequest extends FormRequest
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
            'nome'=>'string',
            'disciplina'=>'array'
        ];
    }
    public function messages()
    {
        return [
            "string" => "O campo :attribute deve ser uma string.",
            "array" => "O campo :attribute deve ser um array"
        ];
    }
}
