<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MeuPerfilController extends Controller {
    public function profile() {
        return view('Perfil.meu-perfil');
    }
}
