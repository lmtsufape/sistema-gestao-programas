<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Aluno extends Model
{
    protected $fillable = [
        'cpf',
        'nome',
        'curso',
        'semestre_entrada',
    ];

    public function user()
    {
        return $this->morphOne(User::class, "typage");
    }

    public function curso()
    {
        return $this->belongsTo(Curso::class, "curso_id");
    }

    public function editais() 
    {
        return $this->hasMany(Edital::class);
    }

    public function edital_alunos()
    {
        return $this->hasMany(Edital_Aluno::class);
    }

    public static $rules = [
        'cpf' => 'bail|required|formato_cpf|cpf|unique:servidors|unique:alunos',
        'curso' => 'bail|required|min:2|max:100',
        'semestre_entrada' => 'bail|required|min:6|max:6|regex: /^[0-9][0-9][0-9][0-9].[0-9]/',
    ];

    public static $messages = [
        'cpf.required' => 'CPF é obrigatório',
        'cpf.formato_cpf' => 'Padrão deve ser 999.999.999-99',
        'cpf.cpf' => 'CPF inválido',
        'cpf.unique' => 'CPF já cadastrado',
        'curso.required' => 'Curso é obrigatório',
        'curso.min' => 'Curso deve possuir no mínimo 2 caracteres',
        'curso.max' => 'Curso deve possuir no máximo 100 caracteres',
        'semestre_entrada.required' => 'Semestre de entrada é obrigatório',
        'semestre_entrada.regex' => 'Formato deve ser 9999.9',
        'semestre_entrada.min' => 'Formato deve ser 9999.9',
        'semestre_entrada.max' => 'Formato deve ser 9999.9',
    ];
}
