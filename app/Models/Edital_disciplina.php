<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Edital_disciplina extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'edital_id',
        'disciplina_id'
    ];

    public function edital()
    {
        return $this->belongsTo(Edital::class, "edital_id");
    }

    public function disciplinas(){
        return $this->belongsTo(Disciplina::class, "disciplina_id");
    }

}
