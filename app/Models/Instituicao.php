<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Instituicao extends Model
{
    use HasFactory;

    protected $fillable = [
        'instituicao',
        'sigla',
        'cnpj',
        'natureza_juridica',
        'endereco',
        'numero',
        'complemento',
        'CEP',
        'bairro',
        'cidade',
        'estado',
        'representante',
        'cargo_representante'
    ];
}
