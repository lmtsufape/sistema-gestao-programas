<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;


class Servidor extends Model
{
    protected $fillable = [
        'cpf',
        'tipo_servidor',
        'instituicaoVinculo',
        'matricula'
    ];

    public function user(){
        return $this->morphOne(User::class, "typage");
    }

    public function programas(){
        return $this->belongsToMany(Programa::class, 'programa_servidors');
    
    }

    public static $rules = [
        'cpf' => 'bail|required|formato_cpf|cpf|unique:servidors|unique:alunos|unique:professors',

    ];

    public static $messages = [
        'cpf.required' => 'CPF é obrigatório',
        'cpf.formato_cpf' => 'Padrão deve ser 999.999.999-99',
        'cpf.cpf' => 'CPF inválido',
        'cpf.unique' => 'CPF já cadastrado',
        'tipo_servidor.required' => 'Setor é obrigatório'
    ];


}
