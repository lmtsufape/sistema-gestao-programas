<?php

namespace App\Http\Controllers;

use App\Http\Requests\AlunoUpdateFormRequest;
use App\Http\Requests\AlunoStoreFormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Aluno;
use App\Models\Curso;
use App\Models\Edital;
use App\Models\EditalAlunoOrientadors;
use App\Models\User;
use App\Services\ManipulacaoImagens;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Database\QueryException;

class AlunoController extends Controller
{
    public function store(AlunoStoreFormRequest $request){
        DB::beginTransaction();
        try {
            $aluno = new Aluno();
            $aluno->nome_aluno = $request->nome;
            $aluno->cpf = $request->cpf;
            $aluno->curso_id = $request->curso;
            $aluno->semestre_entrada = $request->semestre_entrada;

            $imageName = null;
            if($request->hasFile('image') && $request->file('image')->isValid()) {
                $imageName = ManipulacaoImagens::salvarImagem($request->image);                
            }

            if ($aluno->save()) {
                $user = $aluno->user()->create([
                    'name' => $request->nome,
                    'name_social' => $request->name_social == null ? "-" : $request->name_social,
                    'email' => $request->email,
                    'cpf' => $request->cpf,
                    'password' => Hash::make($request->senha),
                    'image' => $imageName
                ]);
                $user->givePermissionTo('aluno');
                $user->save();
                DB::commit();

                return redirect('/alunos')->with('sucesso', 'Aluno cadastrado com sucesso.');
            } else {
                return redirect()->back()->withErrors("Falha ao cadastrar aluno. Tente novamente mais tarde.");
            }
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors("Falha ao cadastrar aluno. Tente novamente mais tarde.");
        }
    }


    public function update(AlunoUpdateFormRequest $request, $id)
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

            $imageName = null;
            if($request->hasFile('image') && $request->file('image')->isValid()) {
                $imageName = ManipulacaoImagens::salvarImagem($request->image);
                if($aluno->user->image){
                    //Se tiver uma imagem anterior, aí deleta do servidor pra colocar a nova no lugar
                    ManipulacaoImagens::deletarImagem($aluno->user->image);                 
                }
            }
            $aluno->user->image = $request->image == null ? $aluno->user->image : $imageName;

            if ($request->senha != null){
                if (strlen($request->senha) > 3 && strlen($request->senha) < 30){
                    $aluno->user->password = Hash::make($request->senha);
                } else {
                    return redirect()->back()->withErrors( "Senha deve ter entre 4 e 30 dígitos" );
                }
            }else{
                //Senha eh null
                return redirect()->back()->withErrors( "O campo Senha é obrigatório!" );

            }

            if ($aluno->save()){

                if ($aluno->user->update()){
                    return redirect('/alunos')->with('sucesso', 'Aluno atualizado com sucesso.');
                } else {
                    return redirect()->back()->withErrors( "Falha ao editar Aluno. tente novamente mais tarde." );
                }

            }

        } catch(exception $e){
            dd($e->getMessage());
            return redirect()->back()->withErrors( "Falha ao editar aluno. tente novamente mais tarde." );

        }
    }

    public function delete($id)
    {
        $aluno = Aluno::findOrFail($id);
        return view('alunos.delete', ['aluno' => $aluno]);
    }

    public function destroy(Request $request)
    {
        try{
            DB::beginTransaction();

            $id = $request->only(['id']);
            $aluno = Aluno::findOrFail($id)->first();
            $imageName = $aluno->user->image;            
            $aluno->user->delete();
            $aluno->delete();
            ManipulacaoImagens::deletarImagem($imageName); 
            DB::commit();

            return redirect(route("alunos.index"))->with('sucesso', 'Aluno deletado com sucesso.');
        

        } catch(QueryException $e){
            DB::rollback();
            return redirect()->back()->withErrors( "Falha ao deletar aluno. O Aluno possui vínculo com algum Edital." );
        } catch(Exception $e){
            DB::rollback();
            dd($e);
            return redirect()->back()->withErrors( "Falha ao deletar aluno. tente novamente mais tarde." );
        }
    }

    public function index(Request $request)
    {
        
        if (sizeof($request-> query()) > 0){
            $campo = $request->query('campo');
            $valor = $request->query('valor');

            if ($valor == null){
                return redirect()->back()->withErrors( "Deve ser informado algum valor para o filtro." );
            }

            $alunos = Aluno::join("users", "users.typage_id", "=", "alunos.id");
            $alunos = $alunos->where(function ($query) use ($valor) {
                if ($valor) {
                    $query->orWhere("users.name", "LIKE", "%{$valor}%");
                    $query->orWhere("users.email", "LIKE", "%{$valor}%");
                    $query->orWhere("alunos.cpf", "LIKE", "%{$valor}%");
                }
            })->orderBy('alunos.created_at', 'desc')->select("alunos.*")->distinct()->get();

            return view("Alunos.index", compact("alunos"));
        } else {
            $alunos = Aluno::all();
            return view("Alunos.index", compact("alunos"));
        }



    }

    public function edit($id){
        $aluno = Aluno::find($id);
        $cursos = Curso::all();
        return view("Alunos.editar-aluno", compact('aluno', 'cursos'));
    }

    public function editarmeuperfil($id){
        $aluno = Aluno::find($id);
        $cursos = Curso::all();

        // Verifique se o ID do aluno corresponde ao ID do usuário autenticado
        if ($aluno->user->id !== auth()->user()->id) {
            return redirect()->route('home')->with('erro', 'Você não tem permissão para editar este perfil.');
        }

        return view("Alunos.editarmeuperfil", compact('aluno', 'cursos'));
    }

    public function atualizarPerfilAluno(AlunoUpdateFormRequest $request, $id)
    {
        try {
            $aluno = Aluno::find($id);
            $aluno->cpf = $request->cpf == $aluno->cpf ? $aluno->cpf : $request->cpf;
            $aluno->semestre_entrada = $request->semestre_entrada;
            $aluno->curso_id = $request->curso;
            $aluno->nome_aluno = $request->nome;
            $aluno->user->name = $request->nome;
            $aluno->user->email = $request->email;
            $aluno->user->name_social = $request->nome_social;

            $imageName = null;
            if($request->hasFile('image') && $request->file('image')->isValid()) {
                $imageName = ManipulacaoImagens::salvarImagem($request->image);
                if($aluno->user->image){
                    ManipulacaoImagens::deletarImagem($aluno->user->image); //Se houver uma nova imagem, remove a anterior do servidor                                
                }
            }
            $aluno->user->image = $request->image == null ? $aluno->user->image : $imageName;

            if ($request->senha != null){
                if (strlen($request->senha) > 3 && strlen($request->senha) < 30){
                    $aluno->user->password = Hash::make($request->senha);
                } else {
                    return redirect()->back()->withErrors( "Senha deve ter entre 4 e 30 dígitos" );
                }
            }

            if ($aluno->save()){

                if ($aluno->user->update()){
                    return redirect('/meu-perfil-aluno')->with('sucesso', 'Perfil atualizado com sucesso.');
                } else {
                    return redirect()->back()->withErrors( "Falha ao editar o seu perfil, tente novamente mais tarde." );
                }

            }

        } catch (Exception $e) {
            return redirect()->back()->withErrors("Falha ao editar o seu perfil, tente novamente mais tarde.");
        }
    }

    public function create(){
        $cursos = Curso::all();
        return view("Alunos.cadastro-aluno", compact('cursos'));
    }

    public function profile(Request $request)
    {
        $id = $request->user()->typage_id; // Obtém o ID do usuário autenticado
        // $user = $request->user(); // Obtém o usuário autenticado

        //dd($user);

        $aluno = Aluno::find($id);


        return view('Perfil.meu-perfil-aluno', ['aluno' => $aluno]);
    }

    public function editais_profile(Request $request) {
        $pivos = EditalAlunoOrientadors::where('aluno_id', $request->user()->typage_id)->get();
        $editais = array();
        foreach ($pivos as $pivo){
            array_push($editais, $pivo->edital);
        }
        return view('Alunos.editais-aluno',compact("editais"));
    }

}
