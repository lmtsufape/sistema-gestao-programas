<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Disciplina extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome'
    ];

    public function curso() {
        return $this->belongsTo(Curso::class, "curso_id");
    }

    // public function disciplina()
    // {
    //     return $this->belongsTo(Edital::class, "edital_id");
    // }

    public function editais(){
        return $this->belongsToMany(Edital::class, 'edital_disciplinas');
    
    }
}
