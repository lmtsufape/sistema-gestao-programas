<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
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
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\OrientadorFormRequest;
use App\Http\Requests\OrientadorFormUpdateRequest;
use App\Http\Requests\AlunoUpdateFormRequest;

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

    public function store(UserRequest $request) {

        //dd($request);
        // $existingCpf = User::where('cpf', $request->cpf)->first();
        // if($existingCpf) {
        //     return redirect()->back()->withErrors( "CPF já existe." );
        // }
        //dd($request);
        DB::beginTransaction();
        try {
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
                    //dd($request);
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
                        // dd($user);
                        $user->givePermissionTo('orientador');
                        $orientador->cursos()->attach($request->cursos);
                        $user->save();
                        Auth::login($user);
                        DB::commit();
                        //dd($user);
                        return redirect('/home')->with('Sucesso', 'Cadastro com sucesso.');
                    } else {
                        return redirect()->back()->withErrors( "Falha ao se cadastrar." );
                    }

                    break;
                }
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors( "Falha ao se cadastrar." );
        }
    }

    public function updateAluno(AlunoUpdateFormRequest $request, $id)
    {
        try{
            #dd($request);
            $aluno = Aluno::find($id);
            #dd($request);
            $aluno->cpf = $request->cpf == $aluno->cpf ? $aluno->cpf : $request->cpf;
            $aluno->semestre_entrada = $request->semestre_entrada;
            $aluno->curso_id = $request->curso;
            $aluno->nome_aluno = $request->nome;
            $aluno->user->name = $request->nome;
            $aluno->user->email = $request->email;
            $aluno->user->name_social = $request->nome_social;
            if ($request->senha && $request->senha != null){
                if (strlen($request->senha) > 3 && strlen($request->senha) < 30){
                    $aluno->user->password = Hash::make($request->password);
                } else {
                    return redirect()->back()->withErrors( "Senha deve ter entre 4 e 30 dígitos" );
                }
            }

            if ($aluno->save()){

                if ($aluno->user->update()){
                    return redirect('/meu-perfil-aluno')->with('sucesso', 'Aluno atualizado com sucesso.');
                } else {
                    return redirect()->back()->withErrors( "Falha ao editar Aluno. tente novamente mais tarde." );
                }

            }

        } catch(exception $e){
            return redirect()->back()->withErrors( "Falha ao editar aluno. tente novamente mais tarde." );

        }
    }

    public function updateOri(OrientadorFormUpdateRequest $request, $id)
    {
        try{
            $orientador = Orientador::find($id);

            $orientador->cpf = $request->cpf == $orientador->cpf ? $orientador->cpf : $request->cpf;
            $orientador->matricula = $request->matricula;
            $orientador->instituicaoVinculo = $request->instituicaoVinculo == $orientador->instituicaoVinculo ? $orientador->instituicaoVinculo : $request->instituicaoVinculo;

            $orientador->user->name = $request->name;
            $orientador->user->email = $request->email;
            $orientador->user->name_social = $request->name_social;
            $orientador->user->cpf = $request->cpf;

            $cursos_id = $request->cursos;
            if($cursos_id == null){
                return redirect()->back()->withErrors( "Selecione pelo menos um Curso" );
            }

            if ($request->senha && $request->senha != null){
                if (strlen($request->senha) > 3 && strlen($request->senha) < 9){
                    $orientador->user->password = Hash::make($request->password);
                } else {
                    return redirect()->back()->withErrors( "Senha deve ter entre 4 e 8 dígitos" );
                }
            }

            if ($orientador->save()){
                #Atualiza os cursos de Orientador
                $orientador->cursos()->sync($request->cursos);

                if ($orientador->user->update()){
                    // return redirect('/orientadors')->with('sucesso', 'Orientador Atualizado com sucesso.');
                    return redirect('/meu-perfil-orientador')->with('sucesso', 'Orientador Atualizado com sucesso.');

                } else {
                    return redirect()->back()->withErrors( "Falha ao editar orientador. tente novamente mais tarde." );
                }

            } else {
                return redirect()->back()->withErrors( "Falha ao editar orientador. tente novamente mais tarde." );
            }
        } catch (Exception $e) {
            return redirect()->back()->withErrors("Falha ao editar orientador. Tente novamente mais tarde.");
        }
    }
}
