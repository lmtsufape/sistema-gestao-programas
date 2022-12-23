<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Edital extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_curso',
        'id_programa',
        'data_fim',
        'data_inicio',
        'semestre'
    ];

    public function programa()
    {
        return $this->belongsTo(Programa::class, "id_programa");
    }

    public function edital_orientadors()
    {
        return $this->hasMany(Edital_orientador::class, "id_edital");
    }

    public function edital_alunos()
    {
        return $this->hasMany(Edital_aluno::class, "id_edital");
    }
}
