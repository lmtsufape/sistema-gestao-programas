<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\ProgramaStoreFormRequest;
use App\Models\Servidor;
use App\Models\Programa;
use App\Models\Programa_servidor;

class ProgramaController extends Controller
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
        $servidores = Servidor::all();
        return view("Programa.cadastrar", compact('servidores'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProgramaStoreFormRequest $request)
    {
        DB::beginTransaction();
        try{

            $programa = new Programa();
            $programa->nome = $request->nome;
            $programa->save();

            foreach($request->servidores as $id_servidor){
                $programa_servidor = new Programa_servidor();
                $programa_servidor->id_programa = $programa->id;
                $programa_servidor->id_servidor = $id_servidor;
                $programa_servidor->save();
            }

            DB::commit();

            return redirect('/programas/create')->with('sucesso', 'Programa cadastrado com sucesso.');

        } catch(exception $e){
            dd("sfd");
            DB::rollback();
            return redirect()->back()->withErrors( "Falha ao cadastrar Programa. tente novamente mais tarde." );
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
