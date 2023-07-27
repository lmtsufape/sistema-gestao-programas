<?php

namespace App\Http\Controllers;

use App\Http\Requests\EstagioStoreFormRequest;
use App\Models\Estagio;
use Exception;
use Illuminate\Support\Facades\DB;

class EstagioController extends Controller
{
    public function index()
    {
        $estagios = Estagio::all(); // Recupera todos os estágios do banco de dados

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
