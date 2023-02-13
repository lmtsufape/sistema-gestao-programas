<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Edital_disciplina extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'id_edital',
        'id_disciplina'
    ];

    public function edital()
    {
        return $this->belongsTo(Edital::class, "id_edital");
    }

    public function disciplinas(){
        return $this->belongsTo(Disciplina::class, "id_disciplina");
    }

}
