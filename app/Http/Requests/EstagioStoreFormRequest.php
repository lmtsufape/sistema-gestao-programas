<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Carbon\Carbon;

class EstagioStoreFormRequest extends FormRequest
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
            "checkStatus" => "required",
            "descricao" => "required",
            "data_inicio" => "required|date|after:" . Carbon::createFromDate(2001, 1, 1)->format('Y-m-d'),
            "data_fim" => "required|date|after:data_inicio",
            //"data_solicitacao" => "required|date|before:data_inicio",
            "cpf_aluno" => "required|formato_cpf|cpf",
            "checkTipo" => "required",
            "orientador" => "required",
            "supervisor" => "required",
            "curso" => "required"
        ];
    }

    public function messages()
    {
        return [
            "required" => "O campo :attribute é obrigatório.",
            "date" => "O campo :attribute deve ser uma data válida: DD/MM/AAAA.",
            "data_inicio.after" => "O campo :attribute deve ser uma data válida: DD/MM/AAAA.",
            "data_fim.after" => 'A data final deve ser posterior à data de início.'
        ];
    }
}
