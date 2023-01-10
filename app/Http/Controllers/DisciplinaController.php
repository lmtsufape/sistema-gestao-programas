<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Disciplina;

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

}
