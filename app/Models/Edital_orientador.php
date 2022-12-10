<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Edital_orientador extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_edital',
        'id_orientador'
    ];

    public function edital()
    {
        return $this->belongsTo(Edital::class);
    } 

    public function orientador()
    {
        return $this->belongsTo(Orientador::class);
    } 
}
