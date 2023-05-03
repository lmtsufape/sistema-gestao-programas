<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MeusProgramasController extends Controller
{
    public function index() {
        return view('Programa.programas_orientadores');
    }

    public function index_aluno() {
        return view('Programa.index_aluno');
    }
}

