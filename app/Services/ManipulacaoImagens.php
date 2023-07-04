<?php

namespace App\Services;

class ManipulacaoImagens {    
    
    public static function salvarImagem($image){

        $requestImage = $image;

        $extension = $requestImage->extension();

        //Vamos criar um novo nome para a imagem, gerando um hash md5 com o nome da imagem e a data-hora do upload
        $imageName = md5($requestImage->getClientOriginalName() . strtotime("now")) . "." . $extension;

        //Colocamos essas imagens dos eventos na pasta public/images/fotos-perfil
        $requestImage->move(public_path('images/fotos-perfil'), $imageName);

        //Retornamos o nome da imagem para salvar no banco e poder acessa-la depois
        return $imageName;
    }


}

