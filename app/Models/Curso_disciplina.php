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

    public function curso()
    {
        return $this->belongsTo(Curso::class, "id_curso");
    }

    public function disciplina(){
        return $this->belongsTo(Disciplina::class, "id_disciplina");
    }
}
