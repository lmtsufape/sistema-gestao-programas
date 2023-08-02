<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Orientador;
class EstagioController extends Controller
{
    public function index()
    {
        return view('Estagio.index');
    }

    public function create()
    {
        $orientadors = Orientador::all();

        return view('Estagio.cadastrar', compact('orientadors'));
    }

    public function store()
    {

    }

    public function edit()
    {
    
    }

    public function update()
    {
    
    }

    public function destroy()
    {
    
    }
    
}
