<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VinculoUpdateFormRequest extends FormRequest
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
            'bolsa' => 'required',
            'bolsista' => 'required|in:True,False',
            'info_complementares' => 'required',
            'termo_compromisso_aluno' => 'nullable|mimes:pdf',
            'termo_compromisso_orientador' => 'nullable|mimes:pdf',
        ];
    }
    
}
