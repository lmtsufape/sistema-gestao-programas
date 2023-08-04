<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Estagio;

class EstagioController extends Controller
{
    public function index(Request $request)
    {
        if (sizeof($request-> query()) > 0){
            $campo = $request->query('campo');
            $valor = $request->query('valor');

            if ($valor == null){
                return redirect()->back()->withErrors( "Deve ser informado algum valor para o filtro." );
            }

            $estagios = Estagio::where(function ($query) use ($valor) {
                if ($valor) {
                    $query->orWhere("users.name", "LIKE", "%{$valor}%");
                    $query->orWhere("users.email", "LIKE", "%{$valor}%");
                    $query->orWhere("alunos.cpf", "LIKE", "%{$valor}%");
                    $query->orWhere("orientadors.cpf", "LIKE", "%{$valor}%");
                    $query->orWhere("orientadors.matricula", "LIKE", "%{$valor}%");
                    $query->orWhere("estagios.descricao", "LIKE", "%{$valor}%");
                }
            })->orderBy('estagios.created_at', 'desc')->select("estagios.*")->distinct()->get();

            return view('Estagio.index', compact('estagios'));
        } else {
            $estagios = Estagio::all();
            return view('Estagio.index', compact('estagios'));
        }

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
