<?php

namespace App\Http\Controllers;

use App\Models\Programa;
use Illuminate\Http\Request;
use App\Models\Edital;
use App\Models\Estagio;
use App\Models\Curso;

class HomeController extends Controller {

    public function index() {
        $user = auth()->user()->typage;
        $programas = [];
        if (auth()->user()->cannot(['orientador', 'aluno'])){
            if (auth()->user()->can('admin')) {
                $programas = Programa::all();
            } else {
                $programas = $user->programas()->get();
            }
        }
        $cursos = Curso::all();
        return view('home', compact('programas', 'cursos'));
    }
}