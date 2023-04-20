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
use App\Models\Edital;
use App\Models\Frequencia_mensal;
use App\Http\Requests\EditalStoreFormRequest;
use App\Http\Requests\EditalUpdateFormRequest;

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
                    $query->orWhere("programas.descricao", "LIKE", "%{$valor}%");
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
            $programa->descricao = $request->descricao;
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
            $programa->descricao = $request->descricao ? $request->descricao : $programa->descricao;
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

    public function listar_editais($id, Request $request)
    {
        $programa = Programa::find($id);
        if (sizeof($request-> query()) > 0){
            $campo = $request->query('campo');
            $valor = $request->query('valor');

            if ($valor == null){
                return redirect()->back()->withErrors( "Deve ser informado algum valor para o filtro." );
            }

            $editals = Edital::join("programas", "programas.id", "=", "editals.id_programa");
            $editals = $editals->where("editals.id_programa", $id);
            $editals = $editals->where(function ($query) use ($valor) {
                if ($valor) {
                    $query->orWhere("programas.nome", "LIKE", "%{$valor}%");
                    $query->orWhere("editals.data_inicio", "LIKE", "%{$valor}%");
                    $query->orWhere("editals.data_fim", "LIKE", "%{$valor}%");
                }
            })->select("editals.*")->get();

            return view("Programa.listar_editais", compact("editals", "programa"));
        } else {
            $editals = Edital::where("editals.id_programa", $id)->get();
            return view("Programa.listar_editais", compact('editals', "programa"));
        }
    }

    public function deletar_edital($id, $id_edital, Request $request)
    {
        DB::beginTransaction();
        try{
            $edital = Edital::find($id_edital);

            Edital::where("id", $id_edital)->delete();

            DB::commit();

            return redirect("programas/$id/editals")->with('sucesso', 'Edital deletado com sucesso.');

        } catch(exception $e){
            DB::rollback();
            return redirect()->back()->withErrors( "Falha ao editar Edital. tente novamente mais tarde." );
        }
    }

    public function criar_edital($id)
    {
        $programa = Programa::find($id);
        return view("Programa.criar_edital", compact("programa"));
    }

    public function store_edital(EditalStoreFormRequest $request)
    {
        DB::beginTransaction();
        try{

            $edital = new Edital();
            $edital->data_inicio = $request->data_inicio;
            $edital->data_fim = $request->data_fim;
            $edital->id_programa = $request->programa;
            $edital->save();

            DB::commit();

            return redirect("/programas/$edital->id_programa/editals")->with('sucesso', 'Edital cadastrado com sucesso.');

        } catch(exception $e){
            DB::rollback();
            return redirect()->back()->withErrors( "Falha ao cadastrar Edital. tente novamente mais tarde." );
        }
    }

    public function editar_edital($id)
    {
        $edital = Edital::find($id);
        $programas = Programa::all();
        return view("Programa.editar_edital", compact("edital", "programas"));
    }

    public function update_edital($id, EditalUpdateFormRequest $request)
    {
        DB::beginTransaction();
        try{
            $edital = Edital::find($id);
            $edital->data_inicio = $request->data_inicio ? $request->data_inicio : $edital->data_inicio;
            $edital->data_fim = $request->data_fim ? $request->data_fim : $edital->data_fim;
            $edital->id_programa = $request->programa ? $request->programa : $edital->id_programa;
            $edital->update();

            DB::commit();

            return redirect("/programas/$edital->id_programa/editals")->with('sucesso', 'Edital editado com sucesso.');

        } catch(exception $e){
            DB::rollback();
            return redirect()->back()->withErrors( "Falha ao editar Edital. tente novamente mais tarde." );
        }
    }
    public function listar_alunos($id, Request $request){
        $programa = Programa::find($id);

        return view("Programa.listar_alunos", compact("programa"));
    }
}
