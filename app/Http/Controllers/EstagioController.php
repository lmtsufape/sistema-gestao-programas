<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EstagioController extends Controller
{
    public function index()
    {
        return view('Estagio.index');
    }

    public function create()
    {
        return view('Estagio.cadastrar');
    }
}
