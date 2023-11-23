<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Curso;
use App\Models\Disciplina;
use App\Models\Estagio;
use Illuminate\Support\Facades\DB;
use Exception;
use App\Http\Requests\CursoStoreFormRequest;
use App\Http\Requests\CursoUpdateFormRequest;

class CursoController extends Controller
{

    public function index(Request $request) {
        if (sizeof($request-> query()) > 0){
            $campo = $request->query('campo');
            $valor = $request->query('valor');

            if ($valor == null){
                return redirect()->back()->withErrors( "Deve ser informado algum valor para o filtro." );
            }

            $cursos = Curso::where(function ($query) use ($valor) {
                if ($valor) {
                    $query->orWhere("cursos.nome", "LIKE", "%{$valor}%");
                }
            })->orderBy('cursos.created_at', 'desc')->select("cursos.*")->get();
            $disciplinas = Disciplina::all();
            return view("Curso.index", compact("cursos", "disciplinas"));
        } else {
            $cursos = Curso::all();
            $disciplinas = Disciplina::all();
            return view("Curso.index", compact("cursos", "disciplinas"));
        }
    }

    public function create()
    {
        #$disciplinas = Disciplina::all();
        return view("Curso.cadastrar");

    }

    public function store(CursoStoreFormRequest $request)
    {
        DB::beginTransaction();
        try{
            $curso = new Curso();
            $curso-> nome = $request->nome;
            $curso->save();
            // if($request->disciplinas){
            //     foreach($request->disciplinas as $disciplina_id){
            //         $curso_disciplina = new Curso_disciplina();
            //         $curso_disciplina->curso_id = $curso->id;
            //         $curso_disciplina->disciplina_id = $disciplina_id;
            //         $curso_disciplina->save();
            //     }
            // }
            DB::commit();
            return redirect('/cursos')->with('sucesso', 'Curso cadastrado com sucesso.');
        } catch(exception $e){
            DB::rollback();
            return redirect()->back()->withErrors( "Falha ao cadastrar Curso. tente novamente mais tarde.");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $curso = Curso::find($id);
        // $disciplinas = Disciplina::all();
        // $idsDisciplinasDoCurso = [];

        // foreach($curso->disciplinas as $disciplinas){
        //     $idsDisciplinasDoCurso[] = $disciplinas->disciplina_id;
        // }
        return view("Curso.editar", compact("curso"));
    }

    public function update(CursoUpdateFormRequest $request, $id)
    {
        DB::beginTransaction();
        try{
            $curso = Curso::find($id);
            $curso->nome = $request->nome ? $request->nome : $curso->nome;
            $curso->update();

            // Curso_disciplina::where("curso_id", $curso->id)->delete();

            // if($request->disciplinas){
            //     foreach($request->disciplinas as $disciplina_id){
            //         $curso_disciplina = new Curso_disciplina();
            //         $curso_disciplina->curso_id = $curso->id;
            //         $curso_disciplina->disciplina_id = $disciplina_id;
            //         $curso_disciplina->save();
            //     }
            // }
            DB::commit();
            
            return redirect("/cursos")->with('sucesso', 'Curso editado com sucesso');
        } catch(exception $e){
            DB::rollBack();
            return redirect()->back()->withErrors("Falha ao editar curso.");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::beginTransaction();
        try{
            
            Disciplina::where("curso_id", $id)->delete();

            Curso::where("id", $id)->delete();

            DB::commit();

            return redirect("/cursos")->with('sucesso', 'Curso deletado com sucesso.');

        } catch(exception $e){
            DB::rollback();
            return redirect()->back()->withErrors( "Falha ao deletar curso. tente novamente mais tarde." );
        }
    }

    public function listar_estagio_curso($id)
    {
        $curso = Curso::find($id);
        $cursos = Curso::all();
        $estagios = Estagio::where("curso_id", $id)->orderBy('created_at', 'desc')->paginate(10);

        return view("Estagio.index", compact("estagios", "cursos"));
    }
}
