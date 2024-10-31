<?php

namespace App\Http\Controllers;

use App\Models\Programa;
use Illuminate\Http\Request;
use App\Models\Edital;
use App\Models\Estagio;
use App\Models\Curso;

class HomeController extends Controller {

    public function index() {
        $user = auth()->user();
        $programas = [];
        if ($user) {
            if ($user->hasRole('administrador')) {
                $programas = Programa::all();
            }
            else if ($user->hasAnyRole(['orientador', 'estudante'])) {
                $programas = $user->typage->programas;
            }
        }
        $cursos = Curso::all();
        return view('home', compact('programas', 'cursos'));
    }
}