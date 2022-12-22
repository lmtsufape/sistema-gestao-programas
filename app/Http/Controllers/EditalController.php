<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Edital;
use App\Models\Curso;
use App\Models\Programa;
use App\Models\Orientador;
use App\Models\Edital_orientador;
use App\Http\Requests\EditalStoreFormRequest;

class EditalController extends Controller
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
        $cursos = Curso::all();
        $programas = Programa::all();
        $orientadores = Orientador::all();
        return view("Edital.cadastrar", compact("cursos", "programas", "orientadores"));
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
            $edital->semestre = $request->semestre;
            $edital->id_curso = $request->curso;
            $edital->id_programa = $request->curso;
            $edital->save();

            foreach($request->orientadores as $id_orientador){
                $edital_orientador = new Edital_orientador();
                $edital_orientador->id_edital = $edital->id;
                $edital_orientador->id_orientador = $id_orientador;
                $edital_orientador->save();
            }

            DB::commit();

            return redirect('/editals/create')->with('sucesso', 'Edital cadastrado com sucesso.');

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
