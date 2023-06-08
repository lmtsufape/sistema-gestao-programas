<?php

namespace App\Http\Controllers;

use App\Models\Aluno;
use App\Models\Curso;
use App\Models\Orientador;
use App\Models\Servidor;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function register() {
        $tipo_servidors = Servidor::all();
        $cursos = Curso::all();
        return view('auth.register', compact('tipo_servidors', 'cursos'));
    }

    public function reset_password() {
        return view('auth.forgot-password');
    }

    public function store(Request $request) {

        $existingCpf = User::where('cpf', $request->cpf)->first();
        if($existingCpf) {
            return redirect()->back()->withErrors( "CPF já existe." );
        }
        //dd($request);
        // DB::beginTransaction();
        // try {
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
                            DB::commit();
                            return redirect('/home')->with('sucesso', 'Cadastro com sucesso.');

                        } else {
                            return redirect()->back()->withErrors( "Falha ao se cadastrar." );
                        }
                    }
                    break;

                case('servidor'):
                    $servidor = Servidor::Create([
                        'cpf' => $request->input('cpf'),
                        'tipo_servidor' => $request->tipoUser,
                        'instituicaoVinculo' => $request->input('instituicaoVinculo'),
                        'matricula' => $request->input('matricula')
                    ]);

                    if(
                        $servidor->user()->create([
                            'name' => $request->input('nome'),
                            'email' => $request->input('email'),
                            'cpf' => $request->input('cpf'),
                            'password' => Hash::make($request->input('senha'))
                        ])->givePermissionTo('servidor')
                    ){
                        $user = $servidor->user;
                        Auth::login($user);
                        DB::commit();
                        return redirect('/home')->with('Sucesso', 'Cadastro com sucesso.');

                    } else {
                        return redirect()->back()->withErrors( "Falha ao se cadastrar." );
                    }

                    break;
                case('orientador'):
                    // dd($request);
                    $orientador = new Orientador([
                        'cpf' => $request->cpf,
                        'instituicaoVinculo' => $request->instituicaoVinculo,
                        //'curso' => $request->curso,
                        'matricula' => $request->matricula,
                    ]);
                    //dd($orientador);
                    if($orientador->save()) {
                        $user = $orientador->user()->create([
                            'name'=> $request->nome,
                            'name_social' => $request->name_social == null ? "-" : $request->name_social,
                            'email' => $request->email,
                            'cpf' => $request->cpf,
                            'password' => Hash::make($request->senha),
                        ]);
                        $orientador->cursos()->attach($request->cursos);
                        // dd($user);
                        $user->givePermissionTo('orientador');
                        $user->save();
                        Auth::login($user);
                        //dd($user);
                        return redirect('/home')->with('Sucesso', 'Cadastro com sucesso.');
                    } else {
                        return redirect()->back()->withErrors( "Falha ao se cadastrar." );
                    }

                    break;
                }
        // } catch (Exception $e) {
        //     DB::rollback();
        //     return redirect()->back()->withErrors( "Falha ao se cadastrar." );
        // }
    }
}
