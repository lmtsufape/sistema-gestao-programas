<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Edital extends Model
{
    use HasFactory;

    protected $fillable = [
        'programa_id',
        'data_fim',
        'data_inicio'
    ];

    public function programa()
    {
        return $this->belongsTo(Programa::class, "programa_id");
    }

    // public function edital_alunos()
    // {
    //     return $this->hasMany(Edital_aluno::class, "edital_id");
    // }

    public function edital_disciplina()
    {
        return $this->hasMany(Edital_disciplina::class, "edital_id");
    }

    public function projetos() {
        return $this->hasMany(Projeto::class, 'edital_projeto');
    }
}
