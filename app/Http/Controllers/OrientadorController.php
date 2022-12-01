<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrientadorFormRequest;
use App\Models\Orientador;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class OrientadorController extends Controller
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
