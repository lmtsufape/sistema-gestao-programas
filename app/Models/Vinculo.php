<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vinculo extends Model
{
    use HasFactory;

    protected $fillable = [
        'bolsa',
        'programa',
        'valor_bolsa',
        'disciplina',
        'curso',
        'semestre',
        'data_inicio',
        'data_fim',
        'aluno_id',
        'professor_id',
        'relatorio'
    ];

    public function aluno()
    {
        return $this->belongsTo(Aluno::class);
    }

    public function professor()
    {
        return $this->belongsTo(Professor::class);
    }

    public function frenquenciasMensais()
    {
        return $this->hasMany(Frequencia_mensal::class);
    }
}
