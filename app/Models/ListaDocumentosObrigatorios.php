<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListaDocumentosObrigatorios extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo',
        'descricao_documento',
        'prazo',
        'tipo_entrega',
        'tipo_estagio'
    ];
}
