<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MeusAlunosController extends Controller
{
    public function index() {
        return view('orientador.listar_alunos');
    }
}