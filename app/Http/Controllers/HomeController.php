<?php

namespace App\Http\Controllers;

use App\Models\Programa;
use Illuminate\Http\Request;
use App\Models\Edital;

class HomeController extends Controller {

    public function index() {
        $user = auth()->user()->typage;
        $programas = [];
        if(auth()->user()->typage_type != 'App\Models\Orientador' && auth()->user()->typage_type != 'App\Models\Aluno'){
            if($user->tipo_servidor == 'adm'){
                $programas = Programa::all();
            } else{
                $programas = $user->programas()->get();
            }
        }
        return view('home', compact('programas'));
    }
}