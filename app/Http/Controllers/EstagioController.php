<?php

namespace App\Http\Controllers;

use App\Http\Requests\EstagioStoreFormRequest;
use App\Http\Requests\EstagioUpdateFormRequest;
use App\Models\Estagio;
use App\Models\Orientador;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

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
        #dd(auth()->user()->typage_type);
        $orientadors = Orientador::all();

        return view('Estagio.cadastrar', compact('orientadors'));
    }

    public function store(EstagioStoreFormRequest $request)
    {
        DB::beginTransaction();

        //dd($request);
        $estagio = new Estagio();
        $estagio->descricao = $request->descricao;
        $estagio->data_inicio = $request->data_inicio;
        $estagio->data_fim = $request->data_fim;
        $estagio->data_solicitacao = $request->data_solicitacao;
        $estagio->save();
        DB::commit();
        return redirect('/estagio')->with('sucesso', 'Estagio cadastrado com sucesso.');
    }

    public function edit($id)
    {
        $estagio = Estagio::Where('id', $id)->first();
        return view("Estagio.editar", compact('estagio'));
    }

    public function update(EstagioUpdateFormRequest $request, $id)
    {               
        DB::beginTransaction();
        try{    
            $estagio = Estagio::find($id);
            $estagio->descricao = $request->descricao ? $request->descricao : $estagio->descricao;
            $estagio->data_inicio = $request->data_inicio ? $request->data_inicio : $estagio->data_inicio;
            $estagio->data_fim = $request->data_fim ? $request->data_fim : $estagio->data_fim;
            $estagio->data_solicitacao = $request->data_solicitacao ? $request->data_solicitacao : $estagio->data_soliticao;
            
            $estagio->update();
    
            DB::commit();

            return redirect()->route('estagio.index')
            ->with('sucesso', 'Estágio editado com sucesso.');

        }catch (Exception $e) {
            DB::rollback();
            $errorMessage = "Falha ao editar Estágio. Tente novamente mais tarde.";
        
            // $errorMessage .= " " . $e->getMessage();
        
            return redirect()->back()->withErrors(['error' => $errorMessage]);
        }
    }


    public function destroy($id)
    {
        DB::beginTransaction();
        
        try{
            $estagio = Estagio::Where('id', $id)->first();

            $estagio->delete();

            DB::commit();
            return redirect()->route('estagio.index')->with('sucesso', 'Estágio deletado com sucesso.');

        }catch(exception $e){
            DB::rollback();
            return redirect()->back()->withErrors( "Falha ao deletar Estágio. tente novamente mais tarde." );
        }
    }
}
