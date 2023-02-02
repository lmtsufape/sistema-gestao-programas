<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Programa extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'descricao'
    ];

    public function programa_servidors()
    {
        return $this->hasMany(Programa_servidor::class, "id_programa");
    }

    public function editals()
    {
        return $this->hasMany(Edital::class, "id_programa");
    }
}
