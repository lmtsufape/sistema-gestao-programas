<?php

namespace App\Http\Controllers;

use App\Http\Requests\DisciplinaStoreFormRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Disciplina;
use Exception;
use App\Http\Requests\DisciplinaUpdateFormRequest;
use App\Models\Curso;

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
        
        try{

            $disciplina = new Disciplina();
            $disciplina ->nome = $request->nome;
            $disciplina->curso_id = $request->curso;
            
            $disciplina->save();

            return redirect('/disciplinas')->with('sucesso', 'Disciplina cadastrada com sucesso.');

        }
        catch(exception $e){

            return redirect()->back()->withErrors( "Falha ao cadastrar Disciplina. tente novamente mais tarde." );
        }
    }


    public function create(){
        
        $cursos = Curso::all();

        return view("Disciplina.cadastrar", compact("cursos"));
    }

    public function create_disciplina_curso($id_curso){

        $curso = Curso::find($id_curso);

        return view("Disciplina.cadastrar_disciplina_curso", compact('curso'));

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
        $cursos = Curso::all();

        return view("disciplina.editar", compact('disciplina', 'cursos'));
    }

    public function update(DisciplinaUpdateFormRequest $request, $id) {
        DB::beginTransaction();
        // $disciplina = Disciplina::find($id);

        // $disciplina->nome = $request->nome;

        try{
            $disciplina = Disciplina::find($id);

            $disciplina->nome = $request->nome ? $request->nome :$disciplina->nome;
            $disciplina->curso_id = $request->curso ? $request->curso : $disciplina->curso_id;

            $disciplina->update();
            //dd($edital);

            DB::commit();

            return redirect()->route('disciplinas.index')
            ->with('sucesso', 'Disciplina editada com sucesso.');

        } catch(exception $e){
            //dd($e);
            DB::rollback();
            return redirect()->back()->withErrors( "Falha ao editar Disciplina. tente novamente mais tarde." );
        }

        // if ($disciplina->save()){
        //     if ($disciplina->update()){
        //         $mensagem_sucesso = "Disciplina cadastrada com sucesso.";
        //         return redirect('/disciplinas/'. $disciplina->id .'/edit')->with('sucesso', 'Disciplina Atualizada com sucesso.');
        //     } else {
        //         return redirect()->back()->withErrors( "Falha ao cadastrar disciplina. tente novamente mais tarde." );
        //     }

        // } else {
        //     return redirect()->back()->withErrors( "Falha ao cadastrar disciplina. tente novamente mais tarde." );
        // }
    }
}
