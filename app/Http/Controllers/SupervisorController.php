<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Supervisor;
use Illuminate\Support\Facades\DB;

class SupervisorController extends Controller
{
    //

    public function index(Request $request)
    {
        
        $supervisors = Supervisor::all();
        return view("Supervisor.index", compact("supervisors"));
    
    }

    public function create(){
        return view("Supervisor.cadastrar");
    }


    public function store(Request $request){
        DB::beginTransaction();
        try {
            $supervisor = new Supervisor();
            $supervisor->nome = $request->nome;
            $supervisor->cpf = $request->cpf;
            $supervisor->email = $request->email;
            $supervisor->telefone = $request->telefone;
            $supervisor->formacao = $request->formacao;
            
            if ($supervisor->save()) {
                
                DB::commit();

                return redirect('/supervisor')->with('sucesso', 'Supervisor cadastrado com sucesso.');
            } else {
                return redirect()->back()->withErrors("Falha ao cadastrar Supervisor. Tente novamente mais tarde.");
            }
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors("Falha ao cadastrar Supervisor. Tente novamente mais tarde.");
        }
    }
}
