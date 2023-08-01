<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estagio extends Model
{
    use HasFactory;

    protected $fillable = [
        'descricao',
        'data_inicio',
        'data_fim',
        'data_solicitacao',
        'tipo_estagio',
        'status'
    ];

    protected $dates = [
        'data_inicio',
        'data_fim',
        'data_solicitacao'
    ];
    

    public function aluno()
    {
        return $this->hasMany(Aluno::class, "aluno_id");
    }

    public function orientador()
    {
        return $this->belongsTo(Orientador::class, "orientador_id");
    }

    public function disciplina()
    {
        return $this->belongsTo(Disciplina::class, "disciplina_id");
    }

    public function servidor()
    {
        return $this->belongsTo(Servidor::class, "supervisor_id");
    }

    /*public function supervisor()
    {
        return 0;
    }
    */
}
