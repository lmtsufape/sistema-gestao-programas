<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curso_disciplina extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_curso',
        'id_disciplina'
    ];
}
