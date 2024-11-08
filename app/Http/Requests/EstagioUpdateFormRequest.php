<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Aluno;
use Illuminate\Validation\ValidationException;

class EstagioUpdateFormRequest extends FormRequest
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

    public function prepareForValidation() {
            $aluno = Aluno::Where('cpf', $this->cpf_aluno)->first();

            if (!$aluno) {
                throw ValidationException::withMessages([
                    'cpf_aluno' => 'Aluno não encontrado com o CPF fornecido.',
                ]);
            }

            $this->merge(['aluno_id' => $aluno->id]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
        {
            return [
                "descricao" => "required|string",
                "data_inicio" => "required|date",
                "data_fim" => "required|date",
                'status' => 'required|boolean',
                'tipo' => 'required|string|in:eo,eno',
                'orientador_id' => 'required|integer|exists:orientadors,id',
                'curso_id' => 'required|integer|exists:cursos,id',
                'supervisor' => 'required|string',
                'disciplina_id' => 'required|integer|exists:disciplinas,id',
                'aluno_id' => 'required|integer|exists:alunos,id',
            ];
        }


    public function messages(){
        return [
            "date" => "O campo :attribute deve ser um date.",
            "required" => "O campo :attribute é obrigatório.",
        ];
    }
}
