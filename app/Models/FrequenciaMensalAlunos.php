<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FrequenciaMensalAlunos extends Model
{
    use HasFactory;

    protected $fillable = [
        'edital_aluno_orientador_id',
        'frequencia_mensal',
        'data',

    ];

    public function edital_aluno_orientadors()
    {
        return $this->belongsTo(Edital_Aluno_Orientadors::class);
    }
}
