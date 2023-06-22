<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Edital;
use App\Models\Aluno;
use App\Models\Disciplina;
use App\Models\Programa;
use App\Models\Orientador;
class MeusProgramasController extends Controller
{
    public function index() {
        return view('Programa.programas_orientadores');
    }
   
    public function index_aluno() {

        return view('Programa.index_aluno');
    }
}

