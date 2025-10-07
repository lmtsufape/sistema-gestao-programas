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
use App\Models\FrequenciaMensalAlunos;
use App\Services\ManipulacaoImagens;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Storage;

class AlunoController extends Controller
{

    public function index(Request $request)
    {
        if (sizeof($request-> query()) > 0){
            $campo = $request->query('campo');
            $valor = $request->query('valor');

            if ($valor == null){
                return redirect()->back()->withErrors( "Deve ser informado algum valor para o filtro." );
            }

            $alunos = Aluno::with(["user" => function($q) use ($valor){
                                            $q->orWhere("name", "LIKE", "%{$valor}%");
                                            $q->orWhere("email", "LIKE", "%{$valor}%");
                                            $q->orWhere("cpf", "LIKE", "%{$valor}%");
                                            }])
                        ->orderBy('user.name')->get();

            return view("Alunos.index", compact("alunos"));
        } else {
            $alunos = Aluno::with('user')->get();
            return view("Alunos.index", compact("alunos"));
        }
    }

    public function store(AlunoStoreFormRequest $request){
        DB::beginTransaction();
        try {
            $aluno = Aluno::create($request->safe()->only([
                                                                'curso_id',
                                                                'semestre_entrada'
                                                                ]));

            $imageName = null;
            if($request->hasFile('image') && $request->file('image')->isValid()) {
                $imageName = ManipulacaoImagens::salvarImagem($request->image);
            }

            $aluno->user()->create($request->safe()->only([
                'name',
                'name_social',
                'email',
                'cpf',
                'password'//colocar image
                ]))->assignRole('estudante');

            DB::commit();

            return back()->with('sucesso', 'Aluno cadastrado com sucesso.');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->with($e);
        }
    }


    public function edit(Aluno $aluno){

        $this->authorize('edit', $aluno);

        $cursos = Curso::all();

        return view("Alunos.editarmeuperfil", compact('aluno', 'cursos'));
    }


    public function update(AlunoUpdateFormRequest $request, Aluno $aluno)
    {

        DB::beginTransaction();
        $path_novo = null;
        $path_antigo = optional($aluno->user)->image;

        try{
            $aluno->update($request->safe()->only([
                'semestre_entrada',
                'curso_id',
            ]));

            if($request->hasFile('image') && $request->file('image')->isValid()) {
                $path_novo = ManipulacaoImagens::salvarImagem($request->file('image'));
            }

            $dados = $request->safe()->only([
                'name',
                'name_social',
                'email',
                'cpf',
                'status',
            ]);

            if ($path_novo) {
                $dados['image'] = $path_novo;
            }

            $aluno->user()->update($dados);

            DB::commit();

            ManipulacaoImagens::deletarImagem($path_antigo);

            return back()->with('sucesso', 'Aluno atualizado com sucesso.');


        } catch(Exception $e){
            if ($path_novo && Storage::disk('public')->exists($path_novo)) {
                try { Storage::disk('public')->delete($path_novo); } catch (\Throwable $t) {}
            }

            DB::rollBack();

            return redirect()->back()->withErrors( $e );

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

        return view('Alunos.editais-aluno',compact('pivos'));
    }

    public function frequencia_modal(Request $request) {
        $vinculos = EditalAlunoOrientadors::where('aluno_id', $request->user()->typage_id)->where('status', true)->get();
        $editais = array();
        foreach ($vinculos as $vinculo){
            array_push($editais, $vinculo->edital);
        }
        return view('Alunos.components.modal_frequencia',compact("editais", "vinculos"));
    }


}
