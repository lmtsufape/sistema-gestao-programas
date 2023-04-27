<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Projeto extends Model
{
    use HasFactory;

    protected  $fillable = [
        'valorBolsa',
        'bolsista',


    ];

    public function alunos() {
        return $this->belongsToMany(Aluno::class, 'aluno_projeto');
    }

    // public function inserirAlunoProjeto($projeto_id, $aluno_id) {

    //     $projeto_id->alunos()->attach($aluno_id);
    // }

}
