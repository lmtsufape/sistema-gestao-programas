<?php

namespace App\Services;

use Exception;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ManipulacaoImagens {

    public static function salvarImagem($image){

        $path = $image->storeAs('images/fotos-perfil', Str::uuid() . '.' . $image->extension(), 'public');

        return $path;
    }

    public static function deletarImagem($path){
        Storage::disk('public')->delete($path);
    }
}

