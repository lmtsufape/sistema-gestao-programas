<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Relatorio extends Model
{
    use HasFactory;

    protected $fillable = [
        'status',
        'observacao',
        'tipo',
        'relatorio',
        'edital_aluno_orientadors_id',
    ];

    public function edital_aluno_orientador()
    {
        return $this->belongsTo(Edital_Aluno_Orientador::class);
    }
}
