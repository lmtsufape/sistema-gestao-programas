<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Curso_disciplina;
use App\Models\Curso;
use App\Models\Disciplina;
use Illuminate\Support\Facades\DB;
use Exception;
use App\Http\Requests\CursoStoreFormRequest;

class CursoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $disciplinas = Disciplina::all();
        return view("Curso.cadastrar", compact("disciplinas"));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CursoStoreFormRequest $request)
    {
        DB::beginTransaction();
        try{
            $curso = new Curso();
            $curso-> nome = $request->nome;
            $curso->save();

            // foreach($request->disciplina as $id_disciplina){
            //     $curso_disciplina = new Curso_disciplina();
            //     $curso_disciplina->id_curso = $curso->id;
            //     $curso_disciplina->id_disciplina = $id_disciplina;
            //     $curso_disciplina->save();
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
