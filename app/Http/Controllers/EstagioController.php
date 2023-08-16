<?php

namespace App\Http\Controllers;

use App\Http\Requests\EstagioStoreFormRequest;
use App\Http\Requests\EstagioUpdateFormRequest;
use App\Models\Aluno;
use App\Models\Curso;
use App\Models\Estagio;
use App\Models\Orientador;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Carbon\Carbon;

class EstagioController extends Controller
{
    public function index(Request $request)
    {
        if (sizeof($request-> query()) > 0){
            $campo = $request->query('campo');
            $valor = $request->query('valor');

            if ($valor == null){
                return redirect()->back()->withErrors( "Deve ser informado algum valor para o filtro." );
            }

            $estagios = Estagio::join('alunos', 'estagios.aluno_id', '=', 'alunos.id')
            ->leftJoin('orientadors', 'estagios.orientador_id', '=', 'orientadors.id')
            ->leftJoin('users', 'users.typage_id', '=', 'orientadors.id');
            
            $estagios = $estagios->where(function ($query) use ($valor) {
                if ($valor) {
                    $query->orWhere("users.cpf", "LIKE", "%{$valor}%");
                    $query->orWhere("users.name", "LIKE", "%{$valor}%");
                    $query->orWhere("users.email", "LIKE", "%{$valor}%");
                    $query->orWhere("orientadors.matricula", "LIKE", "%{$valor}%");
                    $query->orWhere("estagios.descricao", "LIKE", "%{$valor}%");
                }
            })
            ->orderBy('estagios.created_at', 'desc')
            ->select("estagios.*")
            ->distinct()
            ->get();

            return view('Estagio.index', compact('estagios'));
        } else {
            $estagios = Estagio::all();
            return view('Estagio.index', compact('estagios'));
        }
    }

    public function create()
    {
        $aluno = null;

        if(auth()->user()->typage_type == "App\Models\Aluno"){
            //Se for aluno, vamos obter o aluno pelo typage_id
            $aluno_id = auth()->user()->typage_id;
            $aluno = Aluno::Where('id', $aluno_id)->first();

            //dd($aluno);
        }
        $orientadors = Orientador::all();
        $cursos = Curso::all();

        return view('Estagio.cadastrar', compact('orientadors', 'cursos', 'aluno'));
    }

    public function store(EstagioStoreFormRequest $request)
    {
        DB::beginTransaction();

        $estagio = new Estagio();
        $estagio->status = $request->checkStatus;
        $estagio->descricao = $request->descricao;
        $estagio->data_inicio = $request->data_inicio;
        $estagio->data_fim = $request->data_fim;

        $aluno = Aluno::Where('cpf', $request->cpf_aluno)->first();

        $estagio->aluno_id = $aluno->id;
        $estagio->orientador_id = $request->orientador;
        $estagio->curso_id = $request->curso;
        $estagio->save();
        DB::commit();

        if (auth()->user()->typage_type == "App\Models\Aluno"){
            return redirect('/estagios-aluno')->with('sucesso', 'Estágio cadastrado com sucesso.');
        }

        return redirect('/estagio')->with('sucesso', 'Estágio cadastrado com sucesso.');
    }

    public function edit($id)
    {
        $estagio = Estagio::Where('id', $id)->first();
        return view("Estagio.editar", compact('estagio'));
    }

    public function update(EstagioUpdateFormRequest $request, $id)
    {               
        DB::beginTransaction();
        try{    
            $estagio = Estagio::find($id);
            $estagio->descricao = $request->descricao ? $request->descricao : $estagio->descricao;
            $estagio->data_inicio = $request->data_inicio ? $request->data_inicio : $estagio->data_inicio;
            $estagio->data_fim = $request->data_fim ? $request->data_fim : $estagio->data_fim;
            $estagio->data_solicitacao = $request->data_solicitacao ? $request->data_solicitacao : $estagio->data_soliticao;
            
            $estagio->update();
    
            DB::commit();

            return redirect()->route('estagio.index')
            ->with('sucesso', 'Estágio editado com sucesso.');

        }catch (Exception $e) {
            DB::rollback();
            $errorMessage = "Falha ao editar Estágio. Tente novamente mais tarde.";
        
            // $errorMessage .= " " . $e->getMessage();
        
            return redirect()->back()->withErrors(['error' => $errorMessage]);
        }
    }


    public function destroy($id)
    {
        DB::beginTransaction();
        
        try{
            $estagio = Estagio::Where('id', $id)->first();

            $estagio->delete();

            DB::commit();
            return redirect()->route('estagio.index')->with('sucesso', 'Estágio deletado com sucesso.');

        }catch(exception $e){
            DB::rollback();
            return redirect()->back()->withErrors( "Falha ao deletar Estágio. tente novamente mais tarde." );
        }
    }

    public function estagios_profile(Request $request)
     {
        $pivos = Estagio::where('aluno_id', $request->user()->typage_id)->get();
        $estagios = array();
        foreach ($pivos as $pivo){
            array_push($estagios, $pivo);
        }
        return view('Estagio.estagios-aluno', compact("estagios"));
    }
}
