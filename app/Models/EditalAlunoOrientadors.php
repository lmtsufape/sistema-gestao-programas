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
        'outros_documentos',
        'bolsista',
        'info_complementares',
        'termo_compromisso_aluno',
        'aluno_id',
        'edital_id',
        #'disciplina_id',
        'orientador_id',
    ];

    public function edital()
    {
        return $this->belongsTo(Edital::class, "edital_id");
    }

    public function aluno()
    {
        return $this->belongsTo(Aluno::class, "aluno_id");
    }

    public function orientador()
    {
        return $this->belongsTo(Orientador::class, "orientador_id");
    }
}
