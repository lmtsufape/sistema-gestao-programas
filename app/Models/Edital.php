<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Edital extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'descricao',
        'semestre',
        'data_inicio',
        'data_fim',
    ];


    protected $dates = [
        'data_inicio',
        'data_fim'
    ];

    public function programa()
    {
        return $this->belongsTo(Programa::class, "programa_id");
    }

    public function alunos()
    {
        return $this->belongsToMany(Aluno::class, 'edital_alunos')
            ->withPivot([
                'nome_aluno', 
                'titulo_edital', 
                'data_inicio', 
                'data_fim', 
                'valor_bolsa', 
                'bolsa', 
                'info_complementares', 
                'disciplina_id',
                'aluno_id',
                'edital_id'
            ]);
    }

}
