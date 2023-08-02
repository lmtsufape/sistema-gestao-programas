<?php

namespace App\Http\Controllers;

use App\Http\Requests\EstagioStoreFormRequest;
use App\Http\Requests\EstagioUpdateFormRequest;
use App\Models\Estagio;
use Exception;
use Illuminate\Support\Facades\DB;

class EstagioController extends Controller
{
    public function index()
    {
        $estagios = Estagio::all();

        return view('Estagio.index', compact('estagios'));
    }

    public function create()
    {
        return view('Estagio.cadastrar');
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
