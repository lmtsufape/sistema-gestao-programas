<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Projeto extends Model
{
    use HasFactory;

    protected  $fillable = [
        'nome',
        'disciplina',
        'informacoes_complementares',
        'valorBolsa',
        'bolsista',
        'data_inicio',
        'data_fim',


    ];
    protected $dates = ['data_inicio', 'data_fim'];

    public function alunos() {
        return $this->belongsToMany(Aluno::class, 'edital_aluno');
    }

    public function edital() {
        return $this->belongsTo(Edital::class, 'edital_aluno');
    }

}
