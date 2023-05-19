<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use App\Models\Servidor;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function register() {
        $tipo_servidors = Servidor::all();
        $cursos = Curso::all();
        return view('auth.register', compact('tipo_servidors', 'cursos'));
    }

    // 'name',
    //     'name_social',
    //     'email',
    //     'password',
    //     'tipo_usuario',
    //     'status'
    // ];

    // public function store(CadastreSeStoreFormRequest $request)
    // {
    //     if ($request->tipoUser == "servidor"){
    //         $servidor = Servidor::Create([
    //             'cpf' => $request->input('cpf'),

    //         ]);

    //         if(
    //             $servidor->user()->create([
    //                 'name' => $request->input('nome'),
    //                 'email' => $request->input('email'),
    //                 'password' => Hash::make($request->input('senha'))
    //             ])
    //         ){
    //             return redirect('/')->with('sucesso', 'Usuário cadastrado com sucesso.');

    //         } else {
    //             return redirect()->back()->withErrors( "Falha ao cadastrar Usuário. tente novamente mais tarde." );
    //         }

    //     } else if ($request->tipoUser == "orientador"){
    //         $orientador = new Orientador();
    //         $orientador->cpf = $request->cpf;
    //         $orientador->matricula = $request->matriculaOrientador;

    //         if ($orientador->save()){

    //             if (
    //                 $orientador->user()->create([
    //                     'name' => $request->nome,
    //                     'email' => $request->email,
    //                     'password' => Hash::make($request->senha)
    //                 ])->givePermissionTo('orientador')
    //             ){

    //                 return redirect('/')->with('sucesso', 'Usuário cadastrado com sucesso.');

    //             } else {
    //                 return redirect()->back()->withErrors( "Falha ao cadastrar usuário. tente novamente mais tarde." );
    //             }
    //         }else{
    //             return redirect()->back()->withErrors( "Falha ao cadastrar usuário. tente novamente mais tarde." );
    //         }

    //     } else {
    //         $aluno = new Aluno();
    //         $aluno->cpf = $request->cpf;
    //         $aluno->curso_id = $request->curso;
    //         $aluno->semestre_entrada = $request->sementreEntradaAluno;

    //         if ($aluno->save()){

    //             if (
    //                 $aluno->user()->create([
    //                     'name' => $request->nome,
    //                     'email' => $request->email,
    //                     'password' => Hash::make($request->senha)
    //                 ])->givePermissionTo('aluno')
    //             ){
    //                 return redirect('/')->with('sucesso', 'Usuário cadastrado com sucesso.');

    //             } else {
    //                 return redirect()->back()->withErrors( "Falha ao cadastrar usuário. tente novamente mais tarde." );
    //             }
    //         }else{
    //             return redirect()->back()->withErrors( "Falha ao cadastrar usuário. tente novamente mais tarde." );
    //         }
    //     }
    // }
}
