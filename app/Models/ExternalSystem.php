<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExternalSystem extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'api_token',
        'api_token_last4',
    ];

    protected $casts = [
        'api_token' => 'encrypted', // Laravel faz encrypt/decrypt automático
        'last_used_at' => 'datetime',
        'rotated_at' => 'datetime'
    ];
}
