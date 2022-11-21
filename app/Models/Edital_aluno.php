<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Edital_aluno extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_edital',
        'id_aluno',
        'bolsa',
        'valor_bolsa'
    ];

    public function edital()
    {
        return $this->belongsTo(Edital::class);
    }

    public function aluno()
    {
        return $this->belongsTo(Aluno::class);
    }
}
