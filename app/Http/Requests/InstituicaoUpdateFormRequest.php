<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InstituicaoUpdateFormRequest extends FormRequest
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
            "instituicao" => "required",
            "sigla" => "required",
            "cnpj" => "required",
            "natureza_juridica" => "required",
            "endereco" => "required",
            "numero" => "required",
            "complemento" => "required",
            "CEP" => "required",
            "bairro" => "required",
            "cidade" => "required",
            "estado" => "required",
            "representante" => "required",
            "cargo_representante" => "required"
        ];
    }
}
