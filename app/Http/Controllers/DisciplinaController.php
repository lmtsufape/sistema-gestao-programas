<?php

namespace App\Http\Controllers;

use App\Http\Requests\DisciplinaStoreFormRequest;
use Illuminate\Http\Request;
use App\Models\Disciplina;
use App\Http\Requests\DisciplinaUpdateFormRequest;

class DisciplinaController extends Controller
{
    public function index(Request $request) {
        if (sizeof($request-> query()) > 0){
            $campo = $request->query('campo');
            $valor = $request->query('valor');

            if ($valor == null){
                return redirect()->back()->withErrors( "Deve ser informado algum valor para o filtro." );
            }

            $disciplinas = Disciplina::where(function ($query) use ($valor) {
                if ($valor) {
                    $query->orWhere("disciplinas.nome", "LIKE", "%{$valor}%");
                }
            })->orderBy('disciplinas.created_at', 'desc')->select("disciplinas.*")->get();


            return view("Disciplina.index", compact("disciplinas"));
        } else {
            $disciplinas = Disciplina::all();
            return view("Disciplina.index", compact("disciplinas"));
        }
    }

    public function store(DisciplinaStoreFormRequest $request){
       $request -> validated();
        return redirect(route("disciplinas.index"));

    }

    public function create(){
        return view('disciplinas.cadastrar');
    }


    public function delete($id) {
        $disciplina = Disciplina::findOrFail($id);
        return view('disciplinas.delete');
    }

    public function destroy(Request $request) {
        $id = $request->only(['id']);
        $disciplina = Disciplina::findOrFail($id)->first();

        if ($disciplina->delete()) {
            return redirect(route("disciplinas.index"));
        }
    }

    public function edit($id) {
        $disciplina = Disciplina::find($id);
        return view("disciplina.editar", compact('disciplina'));
    }

    public function update(DisciplinaUpdateFormRequest $request, $id) {
        $disciplina = Disciplina::find($id);

        $disciplina->nome = $request->nome;

        if ($disciplina->save()){
            if ($disciplina->update()){
                $mensagem_sucesso = "Disciplina cadastrada com sucesso.";
                return redirect('/disciplinas/'. $disciplina->id .'/edit')->with('sucesso', 'Disciplina Atualizada com sucesso.');
            } else {
                return redirect()->back()->withErrors( "Falha ao cadastrar disciplina. tente novamente mais tarde." );
            }

        } else {
            return redirect()->back()->withErrors( "Falha ao cadastrar disciplina. tente novamente mais tarde." );
        }
    }
}
