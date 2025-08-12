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
        $typage = $user->typage;

        if ($user->hasAnyRole(['coordenador_programas', 'tecnico_programas'])) {
            $programas = $typage?->programas;
            $cursos = collect();
        }
        if ($user->hasAnyRole(['coordenador_estagios', 'tecnico_estagios'])) {
            $programas = collect();
            $cursos = Curso::all();
        } else {
            $programas = Programa::all();
            $cursos = Curso::all();
        }
        return view('home', compact('programas', 'cursos'));
    }
}