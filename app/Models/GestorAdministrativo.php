<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GestorAdministrativo extends Model
{
    use HasFactory;

    protected $fillable = [
        'cpf',
        'instituicaoVinculo',
    ];


    public function user() {
        return $this->morphOne(User::class, 'typage');
    }

}
