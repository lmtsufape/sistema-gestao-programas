<?php

namespace App\Http\Controllers;

use App\Models\Programa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\ProgramaStoreFormRequest;
use App\Http\Requests\ProgramaUpdateFormRequest;
use App\Models\Servidor;
use App\Models\Programa_servidor;

class ProgramaController extends Controller
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

            $programas = Programa::where(function ($query) use ($valor) {
                if ($valor) {
                    $query->orWhere("programas.nome", "LIKE", "%{$valor}%");
                }
            })->orderBy('programas.created_at', 'desc')->select("programas.*")->get();


            return view("Programa.index", compact("programas"));
        } else {
            $programas = Programa::all();
            return view("Programa.index", compact("programas"));
        }
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

            return redirect('/programas')->with('sucesso', 'Programa cadastrado com sucesso.');

        } catch(exception $e){
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
        $programa = Programa::find($id);
        $servidores = Servidor::all();
        $idsServidoresDoPrograma = [];

        foreach ($programa->programa_servidors as $programa_servidor){
            $idsServidoresDoPrograma[] = $programa_servidor->id_servidor;
        }

        return view("Programa.editar", compact('programa', 'servidores', 'idsServidoresDoPrograma'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProgramaUpdateFormRequest $request, $id)
    {
        DB::beginTransaction();
        try{
            $programa = Programa::find($id);
            $programa->nome = $request->nome ? $request->nome : $programa->nome;
            $programa->update();

            Programa_servidor::where("id_programa", $programa->id)->delete();

            if ($request->servidores){
                foreach($request->servidores as $id_servidor){
                    $programa_servidor = new Programa_servidor();
                    $programa_servidor->id_programa = $programa->id;
                    $programa_servidor->id_servidor = $id_servidor;
                    $programa_servidor->save();
                }
            }

            DB::commit();

            return redirect('/programas')->with('sucesso', 'Programa editado com sucesso.');

        } catch(exception $e){
            DB::rollback();
            return redirect()->back()->withErrors( "Falha ao editar Programa. tente novamente mais tarde." );
        }
    }

    public function delete($id)
    {
        $programa = Programa::findOrFail($id);
        return view('programas.delete');
    }

    public function destroy(Request $request)
    {
        DB::beginTransaction();
        try{
            $id = $request->only(['id']);
            $programa = Programa::findOrFail($id)->first();

            Programa_servidor::where("id_programa", $programa->id)->delete();

            $programa->delete();


            DB::commit();

            return redirect('/programas')->with('sucesso', 'Programa deletado com sucesso.');
        } catch(exception $e){
            DB::rollback();
            return redirect()->back()->withErrors( "Falha ao deletarm um Programa. tente novamente mais tarde." );
        }
    }
}
