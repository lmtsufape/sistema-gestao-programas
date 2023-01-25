<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CadastrarSeController extends Controller
{
    public function cadastrarSe(){
        return view('CadastrarSe.cadastrarSe');
    }
}
