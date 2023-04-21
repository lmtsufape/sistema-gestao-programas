<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome'
    ];

    public function alunos()
    {
        return $this->hasMany(Aluno::class, "curso_id");
    }
    public function curso_disciplinas()
    {
        return $this->hasMany(Curso_disciplina::class, "curso_id");
    }
}
