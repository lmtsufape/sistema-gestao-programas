<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome'
    ];

    public function alunos()
    {
        return $this->hasMany(Aluno::class, "id_curso");
    }
}
