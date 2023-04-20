<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MeusProgramasController extends Controller {
    public function index() {
        return view('Programa.index_aluno');
    }
}
