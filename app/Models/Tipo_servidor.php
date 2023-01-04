<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tipo_servidor extends Model
{
    use HasFactory;

    public function servidores()
    {
        return $this->hasMany(Servidor::class, "id_tipo_servidor");
    }
}

