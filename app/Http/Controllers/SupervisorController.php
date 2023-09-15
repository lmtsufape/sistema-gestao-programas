<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Supervisor;
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Database\QueryException;
use App\Http\Requests\SupervisorStoreFormRequest;
use App\Http\Requests\SupervisorUpdateFormRequest;

class SupervisorController extends Controller
{
    //

    public function index(Request $request)
    {

        if (sizeof($request-> query()) > 0){
            $campo = $request->query('campo');
            $valor = $request->query('valor');

            if ($valor == null){
                return redirect()->back()->withErrors( "Deve ser informado algum valor para o filtro." );
            }

            $supervisors = Supervisor::where(function ($query) use ($valor) {
                if ($valor) {
                    $query->orWhere("supervisors.nome", "LIKE", "%{$valor}%");
                    $query->orWhere("supervisors.email", "LIKE", "%{$valor}%");
                    $query->orWhere("supervisors.cpf", "LIKE", "%{$valor}%");
                    $query->orWhere("supervisors.telefone", "LIKE", "%{$valor}%");
                    $query->orWhere("supervisors.formacao", "LIKE", "%{$valor}%");
                }
            })->orderBy('supervisors.created_at', 'desc')->select("supervisors.*")->get();


            return view("Supervisor.index", compact("supervisors"));
        } else {
            $supervisors = Supervisor::all();
            return view("Supervisor.index", compact("supervisors"));
        }

    }

    public function create(){
        return view("Supervisor.cadastrar");
    }


    public function store(SupervisorStoreFormRequest $request){
        DB::beginTransaction();
        try {
            $supervisor = new Supervisor();
            $supervisor->nome = $request->nome;
            $supervisor->cpf = $request->cpf;
            $supervisor->email = $request->email;
            $supervisor->telefone = $request->telefone;
            $supervisor->formacao = $request->formacao;

            if ($supervisor->save()) {

                DB::commit();

                return redirect('/supervisor')->with('sucesso', 'Supervisor cadastrado com sucesso.');
            } else {
                return redirect()->back()->withErrors("Falha ao cadastrar Supervisor. Tente novamente mais tarde.");
            }
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors("Falha ao cadastrar Supervisor. Tente novamente mais tarde.");
        }
    }

    public function edit($id){
        $supervisor = Supervisor::find($id);

        return view("Supervisor.editar", compact('supervisor'));
    }

    public function update(SupervisorUpdateFormRequest $request, $id)
    {
        DB::beginTransaction();
        try{
            $supervisor = Supervisor::find($id);
            $supervisor->nome = $request->nome ? $request->nome : $supervisor->nome;
            $supervisor->cpf = $request->cpf ? $request->cpf : $supervisor->cpf;
            $supervisor->email = $request->email ? $request->email : $supervisor->email;
            $supervisor->telefone = $request->telefone ? $request->telefone : $supervisor->telefone;
            $supervisor->formacao = $request->formacao ? $request->formacao : $supervisor->formacao;

            $supervisor->update();

            DB::commit();

            return redirect()->route('supervisor.index')
            ->with('sucesso', 'Supervisor editado com sucesso.');

        } catch(Exception $e){
            DB::rollback();
            return redirect()->back()->withErrors( "Falha ao editar Supervisor. tente novamente mais tarde." );
        }
    }

    public function delete($id)
    {
        $supervisor = Supervisor::findOrFail($id);
        return view('Supervisor.delete', ['supervisor' => $supervisor]);
    }

    public function destroy(Request $request)
    {
        try{
            DB::beginTransaction();

            $id = $request->only(['id']);
            $supervisor = Supervisor::findOrFail($id)->first();

            $supervisor->delete();
            DB::commit();
            return redirect(route("supervisor.index"))->with('sucesso', 'Supervisor Deletado com Sucesso!');


        } catch(QueryException $e){
            DB::rollback();
            //dd($e);
            return redirect()->back()->withErrors( "Falha ao deletar Supervisor. O Supervisor está vinculado em algum Estágio." );
        }catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors("Falha ao deletar Supervisor. Tente novamente mais tarde.");
        }
    }

}
