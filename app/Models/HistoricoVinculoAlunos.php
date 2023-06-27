<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoricoVinculoAlunos extends Model
{
    use HasFactory;

    protected $fillable = [
        'vinculo_id',
        'data_inicio',
        'data_fim',
    ];
}
