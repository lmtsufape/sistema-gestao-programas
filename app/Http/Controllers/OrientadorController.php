<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrientadorFormRequest;
use App\Models\Orientador;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class OrientadorController extends Controller
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

            $orientadors = Orientador::join("users", "users.typage_id", "=", "orientadors.id")->join("cursos", "cursos.id", "=", "orientadors.id");
            $orientadors = $orientadors->where(function ($query) use ($valor) {
                if ($valor) {
                    $query->orWhere("users.name", "LIKE", "%{$valor}%");
                    $query->orWhere("users.email", "LIKE", "%{$valor}%");
                    $query->orWhere("orientadors.nome", "LIKE", "%{$valor}%");
                    $query->orWhere("orientadors.cpf", "LIKE", "%{$valor}%");
                    $query->orWhere("orientadors.matricula", "LIKE", "%{$valor}%");
                }
            })->orderBy('orientadors.created_at', 'desc')->select("orientadors.*")->get();


            return view("Orientadors.index", compact("orientadors"));
        } else {
            $orientador = Orientador::all();
            return view("Orientadors.index", compact("orientadors"));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("Orientador.cadastrar");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OrientadorFormRequest $request)
    {
        $orientador = new Orientador();
        $orientador->cpf = $request->cpf;
        $orientador->matricula = $request->matricula;

        if ($orientador->save()){

            if ( 
                $orientador->user()->create([
                    'name' => $request->nome,
                    'email' => $request->email,
                    'password' => Hash::make($request->senha)
                ])->givePermissionTo('orientador') 
            ){

                $mensagem_sucesso = "Orientador cadastrado com sucesso.";
                return redirect('/orientadors/create')->with('sucesso', 'Orientador cadastrado com sucesso.');

            } else {
                return redirect()->back()->withErrors( "Falha ao cadastrar orientador. tente novamente mais tarde." );
            }
        }else{
            return redirect()->back()->withErrors( "Falha ao cadastrar orientador. tente novamente mais tarde." );
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
