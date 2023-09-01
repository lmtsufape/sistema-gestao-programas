<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentoEstagio extends Model
{
    use HasFactory;

    protected $table = "documentos_estagios";

    protected $fillable = [
        'pdf',
        'data_envio',
        'data_limite',
    ];

    public function aluno()
    {
        return $this->belongsTo(Aluno::class, "aluno_id");
    }

    public function lista_documentos_obrigatorios()
    {
        return $this->belongsTo(ListaDocumentosObrigatorios::class, "lista_documentos_obrigatorios_id");
    }
}
