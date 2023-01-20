<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Edital;
use App\Models\Curso;
use App\Models\Programa;
use App\Models\Orientador;
use App\Models\Edital_orientador;
use App\Models\Edital_aluno;
use App\Models\Frequencia_mensal;
use App\Http\Requests\EditalStoreFormRequest;
use App\Http\Requests\EditalUpdateFormRequest;

class EditalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (sizeof($request-> query()) > 0){
            $campo = $request->query('campo');
            $valor = $request->query('valor');

            if ($valor == null){
                return redirect()->back()->withErrors( "Deve ser informado algum valor para o filtro." );
            }

            $editals = Edital::join("programas", "programas.id", "=", "editals.id_programa");
            $editals = $editals->where(function ($query) use ($valor) {
                if ($valor) {
                    $query->orWhere("programas.nome", "LIKE", "%{$valor}%");
                    $query->orWhere("editals.data_inicio", "LIKE", "%{$valor}%");
                    $query->orWhere("editals.data_fim", "LIKE", "%{$valor}%");
                }
            })->select("editals.*")->get();

            $orientadores = Orientador::all();
            return view("Edital.index", compact("editals", "orientadores"));
        } else {
            $orientadores = Orientador::all();
            $editals = Edital::all();
            return view("Edital.index", compact('editals', 'orientadores'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $programas = Programa::all();
        return view("Edital.cadastrar", compact("programas"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EditalStoreFormRequest $request)
    {
        DB::beginTransaction();
        try{

            $edital = new Edital();
            $edital->data_inicio = $request->data_inicio;
            $edital->data_fim = $request->data_fim;
            $edital->id_programa = $request->programa;
            $edital->save();

            DB::commit();

            return redirect('/editals')->with('sucesso', 'Edital cadastrado com sucesso.');

        } catch(exception $e){
            DB::rollback();
            return redirect()->back()->withErrors( "Falha ao cadastrar Edital. tente novamente mais tarde." );
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
        $edital = Edital::find($id);
        $programas = Programa::all();
        return view("Edital.editar", compact("edital", "programas"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditalUpdateFormRequest $request, $id)
    {
        DB::beginTransaction();
        try{
            $edital = Edital::find($id);
            $edital->data_inicio = $request->data_inicio ? $request->data_inicio : $edital->data_inicio;
            $edital->data_fim = $request->data_fim ? $request->data_fim : $edital->data_fim;
            $edital->id_programa = $request->programa ? $request->programa : $edital->id_programa;
            $edital->update();

            DB::commit();

            return redirect("/editals")->with('sucesso', 'Edital editado com sucesso.');

        } catch(exception $e){
            DB::rollback();
            return redirect()->back()->withErrors( "Falha ao editar Edital. tente novamente mais tarde." );
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
            $edital = Edital::find($id);

            Edital::where("id", $id)->delete();

            DB::commit();

            return redirect("/editals")->with('sucesso', 'Edital deletado com sucesso.');

        } catch(exception $e){
            DB::rollback();
            return redirect()->back()->withErrors( "Falha ao editar Edital. tente novamente mais tarde." );
        }
    }
}
