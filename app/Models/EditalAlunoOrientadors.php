<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EditalAlunoOrientadors extends Model
{
    use HasFactory;
    protected $fillable = [
        'titulo',
        'data_inicio',
        'data_fim',
        'bolsa',
        'plano_projeto',
        'bolsista',
        'info_complementares',
        'termo_compromisso_aluno',
        'aluno_id',
        'edital_id',
        'disciplina_id',
        'orientador_id',
    ];


}
