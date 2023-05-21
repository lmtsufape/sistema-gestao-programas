<?php

namespace App\Http\Controllers;

use App\Models\Aluno;
use App\Models\Curso;
use App\Models\Servidor;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function register() {
        $tipo_servidors = Servidor::all();
        $cursos = Curso::all();
        return view('auth.register', compact('tipo_servidors', 'cursos'));
    }

    public function store(Request $request) {

        $existingCpf = User::where('cpf', $request->cpf)->first();
        if($existingCpf) {
            return response()->json(['error' => 'CPF já cadastrado'], 400);
        }

        switch ($request->tipoUser){
            case('aluno'):
                $aluno = new Aluno();
                $aluno->nome_aluno = $request->nome;
                $aluno->cpf = $request->cpf;
                $aluno->curso_id = $request->curso;
                $aluno->semestre_entrada = $request->semestre_entrada;

                if ($aluno->save()){
                    if (
                        $aluno->user()->create([
                            'name' => $request->nome,
                            'cpf' => $request->cpf,
                            'name_social' => $request->nome_social == null ? "-": $request->nome_social,
                            'email' => $request->email,
                            'password' => Hash::make($request->senha)
                        ])->givePermissionTo('aluno')
                    ){
                        $user = $aluno->user;
                        Auth::login($user);
                        return redirect('/home')->with('sucesso', 'Cadastro com sucesso.');

                    } else {
                        return redirect()->back()->withErrors( "Falha ao se cadastrar." );
                    }
                }


            case('servidor'):
                break;
            case('orientador'):
                break;
        }
    }

    // $aluno->user()->create([
    //     'name' => $request->nome,
    //     'name_social' => $request->nome_social == null ? "-": $request->nome_social,
    //     'email' => $request->email,
    //     'password' => Hash::make($request->senha)
    // ])->givePermissionTo('aluno')

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
