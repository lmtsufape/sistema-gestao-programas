<?php

namespace App\Http\Controllers;

use App\Models\Programa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\ProgramaStoreFormRequest;
use App\Http\Requests\ProgramaUpdateFormRequest;
use App\Models\Servidor;
use App\Models\Programa_servidor;
use App\Models\Edital;
use App\Models\Orientador;
use App\Models\Disciplina;
use App\Models\User;
use App\Http\Controllers\EditalController;
use Exception;

class ProgramaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $programa_servidor = Programa_servidor::all();
        $servidors = Servidor::all();
        $users = User::all();

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


        return view("Programa.index", compact("programas", "servidors", "users"));
        } else {
            $programas = Programa::all();
            return view("Programa.index", compact("programas", "servidors", "users"));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $servidors = Servidor::all();
        #dd($servidors);
        return view("Programa.cadastrar", compact('servidors'));
    }

    /**
     * Store a newly created resource in storage.
     *********
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

            $servidors_id = $request->servidors;
            foreach ($servidors_id as $servidor_id) {
                $programa->servidores()->attach($servidor_id);
            }

            // if ($request->servidor){
            //     $programa_servidor = new Programa_servidor();
            //     $programa_servidor->programa_id = $programa->id;
            //     $programa_servidor->servidor_id = $request->servidor;
            //     $programa_servidor->save();
            // }

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
        $servidors = Servidor::all();
        $idsservidorsDoPrograma = [];
        $servidoresSelecionados = $programa->servidores->pluck('id')->toArray();

        // foreach ($programa->programa_servidors as $programa_servidor){
        //     $idsservidorsDoPrograma[] = $programa_servidor->servidor_id;
        // }

        return view("Programa.editar", compact('programa', 'servidors', 'servidoresSelecionados'));
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

            // if ($request->servidor){
            //         $programa_servidor = Programa_servidor::where("programa_id", $programa->id)->first();
            //         $programa_servidor->programa_id = $programa->id;
            //         $programa_servidor->servidor_id = $request->servidor;
            //         $programa_servidor->update();
            // }

            $programa->servidores()->sync($request->servidors);


            DB::commit();

            return redirect('/programas')->with('sucesso', 'Programa editado com sucesso.');

        } catch(exception $e){
            DB::rollback();
            return redirect()->back()->withErrors( "Falha ao editar Programa. Tente novamente mais tarde." );
        }
    }

    // public function delete($id)
    // {
    //     $programa = Programa::findOrFail($id);
        
    //     return view('programas.delete');
    // }

    public function destroy(Request $request)
    {
        try{
            $edital = Edital::where("programa_id", $request->id)->first();
            if ($edital)
            {
                return redirect()->back()->withErrors( "Falha ao deletar Programa. Existem editais vinculados a ele." );
            } else{
            
        
                DB::beginTransaction();
                try{
                    $id = $request->only(['id']);
                    $programa = Programa::findOrFail($id)->first();
                    
                    $programa->servidores()->detach($request->servidors); 

                    // Programa_servidor::where("programa_id", $programa->id)->delete();

                    $programa->delete();


                    DB::commit();

                    return redirect('/programas')->with('sucesso', 'Programa deletado com sucesso.');
                } catch(exception $e){
                    DB::rollback();
                    return redirect()->back()->withErrors( "Falha ao deletar um Programa. tente novamente mais tarde." );
                }
            }
        } catch (Exception $e) {
            return redirect()->back()->withErrors("Falha ao cadastrar aluno. Tente novamente mais tarde.");
        }
    }

    public function listar_editais($id)
    {
        $programa = Programa::find($id);
        $orientadors = Orientador::all();

        $editais = $programa->editais;
        
        return view("Edital.index", compact("editais", "orientadors"));

                // if (sizeof($request-> query()) > 0){
        //     $campo = $request->query('campo');
        //     $valor = $request->query('valor');

        //     if ($valor == null){
        //         return redirect()->back()->withErrors( "Deve ser informado algum valor para o filtro." );
        //     }

        //     $editals = Edital::join("programas", "programas.id", ";=", "editals.programa_id");
        //     $editals = $editals->where("editals.programa_id", $id);
        //     $editals = $editals->where(function ($query) use ($valor) {
        //         if ($valor) {
        //             $query->orWhere("programas.nome", "LIKE", "%{$valor}%");
        //             $query->orWhere("editals.data_inicio", "LIKE", "%{$valor}%");
        //             $query->orWhere("editals.data_fim", "LIKE", "%{$valor}%");
        //         }
        //     })->select("editals.*")->get();

        //     return view("Programa.listar_editais", compact("editals", "programa"));
        // } else {
        //     $editals = Edital::where("editals.programa_id", $id)->get();
        //     return view("Programa.listar_editais", compact('editals', "programa"));
        // }
    }

    public function deletar_edital($id)
    {
        // $edital->EditalController->destroy($id);
        // // return redirect()->route('programas.index')->with('sucesso', 'Edital deletado com sucesso.');
        // //$programa_id = 1;

        // $edital = EditalController->destroy($id);

        // return redirect()->route('programas.index')->with('sucesso', 'Edital deletado com sucesso.');

        DB::beginTransaction();
        try{
            $edital = Edital::find($id);

            Edital::where("id", $id)->delete();

            DB::commit();

            return redirect("programas.index")->with('sucesso', 'Edital deletado com sucesso.');

        } catch(exception $e){
            DB::rollback();
            return redirect()->back()->withErrors( "Falha ao editar Edital. tente novamente mais tarde." );
        }
    }

    public function criar_edital($id)
    {
        $disciplina = Disciplina::all();
        return view("Edital.cadastrar", compact("programas", "disciplina"));
    }

    // public function store_edital(EditalStoreFormRequest $request)
    // {
    //     DB::beginTransaction();
    //     try{

    //         $edital = new Edital();
    //         $edital->data_inicio = $request->data_inicio;
    //         $edital->data_fim = $request->data_fim;
    //         $edital->programa_id = $request->programa;
    //         $edital->save();

    //         DB::commit();

    //         return redirect("/programas/$edital->programa_id/editals")->with('sucesso', 'Edital cadastrado com sucesso.');

    //     } catch(exception $e){
    //         DB::rollback();
    //         return redirect()->back()->withErrors( "Falha ao cadastrar Edital. tente novamente mais tarde." );
    //     }
    // }

    public function editar_edital($id)
    {
        $edital = Edital::Where('id', $id)->first();
        //dd($edital);
        $programas = Programa::all();
        
        return view("Edital.editar", compact("edital", "programas"));
    }

    // public function update_edital($id, EditalUpdateFormRequest $request)
    // {
    //     DB::beginTransaction();
    //     try{
    //         $edital = Edital::find($id);
    //         $edital->data_inicio = $request->data_inicio ? $request->data_inicio : $edital->data_inicio;
    //         $edital->data_fim = $request->data_fim ? $request->data_fim : $edital->data_fim;
    //         $edital->programa_id = $request->programa ? $request->programa : $edital->programa_id;
    //         $edital->update();

    //         DB::commit();

    //         return redirect("/programas/$edital->programa_id/editals")->with('sucesso', 'Edital editado com sucesso.');

    //     } catch(exception $e){
    //         DB::rollback();
    //         return redirect()->back()->withErrors( "Falha ao editar Edital. tente novamente mais tarde." );
    //     }
    // }
    public function listar_alunos($id, Request $request){
        $programa = Programa::find($id);

        return view("Programa.listar_alunos", compact("programa"));
    }
}