<?php

namespace App\Http\Controllers;

use App\Http\Requests\EstagioStoreFormRequest;
use App\Http\Requests\EstagioUpdateFormRequest;
use App\Models\Aluno;
use App\Models\Curso;
use App\Models\Disciplina;
use App\Models\DocumentoEstagio;
use App\Models\Estagio;
use App\Models\Instituicao;
use App\Models\Orientador;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\ListaDocumentosObrigatorios;
use Illuminate\Pagination\Paginator;

class EstagioController extends Controller
{
    public function index(Request $request)
    {
        if (sizeof($request->query()) > 0) {
            $campo = $request->query('campo');
            $valor = $request->query('valor');

            // if ($valor == null) {
            //     return redirect()->back()->withErrors("Deve ser informado algum valor para o filtro.");
            // }

            $estagios = Estagio::where(function ($query) use ($valor) {
                $query->orWhereHas('aluno', function ($subquery) use ($valor) {
                    $subquery->where('cpf', 'LIKE', "%{$valor}%")
                        ->orWhere('nome_aluno', 'LIKE', "%{$valor}%");
                })
                    ->orWhereHas('orientador.user', function ($subquery) use ($valor) {
                        $subquery->where('cpf', 'LIKE', "%{$valor}%")
                            ->orWhere('name', 'LIKE', "%{$valor}%")
                            ->orWhere('email', 'LIKE', "%{$valor}%")
                            ->orWhere('matricula', 'LIKE', "%{$valor}%");
                    })
                    //Query para a tabela estagios
                    ->orWhere('descricao', 'LIKE', "%{$valor}%");
            })
                ->orderBy('created_at', 'asc')
                ->orderBy('status', 'desc')
                ->distinct()
                ->paginate(25);

            $cursos = Curso::all();

            return view('Estagio.index', compact('estagios', 'cursos'));
        } else {
            $estagios = Estagio::orderBy('created_at', 'desc')->paginate(25);
            $cursos = Curso::all();
            return view('Estagio.index', compact('estagios', 'cursos'));
        }
    }

    public function create()
    {
        $aluno = null;
        $disciplinas = null;

        if (auth()->user()->typage_type == "App\Models\Aluno") {
            //Se for aluno, vamos obter o aluno pelo typage_id
            $aluno_id = auth()->user()->typage_id;
            $aluno = Aluno::Where('id', $aluno_id)->first();

            $disciplinas = $aluno->curso->disciplinas; //seleciona apenas as disciplinas dos alunos
            //dd($aluno);
        } else {
            $disciplinas = Disciplina::all();
        }

        $orientadors = Orientador::all();
        $cursos = Curso::all();
        //$supervisors = Supervisor::all();

        return view('Estagio.cadastrar', compact('orientadors', 'cursos', 'aluno', 'disciplinas'));
    }

    public function store(EstagioStoreFormRequest $request)
    {
        DB::beginTransaction();

        $estagio = new Estagio();
        $estagio->status = $request->checkStatus;
        $estagio->descricao = $request->descricao;
        $estagio->supervisor = $request->supervisor;
        $estagio->data_inicio = $request->data_inicio;
        $estagio->data_fim = $request->data_fim;

        $aluno = Aluno::Where('cpf', $request->cpf_aluno)->first();

        $estagio->aluno_id = $aluno->id;
        $estagio->orientador_id = $request->orientador;
        $estagio->curso_id = $request->curso;
        $estagio->disciplina_id = $request->disciplina;
        $estagio->tipo = $request->checkTipo;
        $estagio->save();
        DB::commit();

        if (auth()->user()->typage_type == "App\Models\Aluno") {
            return redirect('/meus-estagios')->with('sucesso', 'Estágio cadastrado com sucesso.');
        }

        return redirect('/estagio')->with('sucesso', 'Estágio cadastrado com sucesso.');
    }

    public function edit($id)
    {
        $aluno = null;
        $disciplinas = null;

        if (auth()->user()->typage_type == "App\Models\Aluno") {
            //Se for aluno, vamos obter o aluno pelo typage_id
            $aluno_id = auth()->user()->typage_id;
            $aluno = Aluno::Where('id', $aluno_id)->first();

            $disciplinas = $aluno->curso->disciplinas; //seleciona apenas as disciplinas dos alunos
            //dd($aluno);
        } else {
            $disciplinas = Disciplina::all();
        }

        $orientadors = Orientador::all();
        $cursos = Curso::all();
        //$supervisors = Supervisor::all();

        $estagio = Estagio::Where('id', $id)->first();
        return view("Estagio.editar", compact('estagio', 'aluno', 'disciplinas', 'orientadors', 'cursos'));
    }

    public function update(EstagioUpdateFormRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            $estagio = Estagio::find($id);

            $estagio->descricao = $request->descricao ? $request->descricao : $estagio->descricao;
            $estagio->supervisor = $request->supervisor ? $request->supervisor : $estagio->supervisor;
            $estagio->data_inicio = $request->data_inicio ? $request->data_inicio : $estagio->data_inicio;
            $estagio->data_fim = $request->data_fim ? $request->data_fim : $estagio->data_fim;
            $estagio->status = $request->checkStatus ? $request->checkStatus : $estagio->status;

            $aluno = Aluno::Where('cpf', $request->cpf_aluno)->first();

            $estagio->aluno_id = $request->cpf_aluno ? $aluno->id : $estagio->aluno_id;

            $estagio->orientador_id = $request->orientador ? $request->orientador : $estagio->orientador_id;
            $estagio->curso_id = $request->curso ? $request->curso : $estagio->curso_id;
            $estagio->disciplina_id = $request->disciplina ?  $request->disciplina : $estagio->disciplina_id;
            $estagio->tipo = $request->checkTipo ? $request->checkTipo : $estagio->tipo;

            $estagio->update();

            DB::commit();

            return redirect()->route('estagio.index')
                ->with('sucesso', 'Estágio editado com sucesso.');
        } catch (Exception $e) {
            DB::rollback();
            $errorMessage = "Falha ao editar Estágio. Tente novamente mais tarde.";

            // $errorMessage .= " " . $e->getMessage();

            return redirect()->back()->withErrors(['error' => $errorMessage]);
        }
    }


    public function destroy($id)
    {
        DB::beginTransaction();

        try {
            $estagio = Estagio::Where('id', $id)->first();

            $estagio->delete();

            DB::commit();
            return redirect()->route('estagio.index')->with('sucesso', 'Estágio deletado com sucesso.');
        } catch (exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors("Falha ao deletar Estágio. tente novamente mais tarde.");
        }
    }

    public function estagios_profile(Request $request)
    {
        $aluno_id = auth()->user()->typage_id;

        $valorBusca = $request->input('valor');
        $estagios = Estagio::where('aluno_id', $aluno_id)
            ->where(function ($query) use ($valorBusca) {
                $query->where('descricao', 'LIKE', "%$valorBusca%")
                    ->orWhere('created_at', 'LIKE', "%$valorBusca%")
                    ->orWhere('data_inicio', 'LIKE', "%$valorBusca%")
                    ->orWhere('data_fim', 'LIKE', "%$valorBusca%");
            })
            ->get();

        return view('Estagio.estagios-aluno', compact('estagios'));
    }


    public function showDocuments($id)
    {
        $estagio = Estagio::findOrFail($id);
        $aluno = aluno::findOrFail($estagio->aluno_id);
        $instituicao = Instituicao::pluck('sigla')->first();

        $documentos = DocumentoEstagio::join('lista_documentos_obrigatorios', function ($join) use ($aluno, $estagio) {
            $join->on('documentos_estagios.lista_documentos_obrigatorios_id', '=', 'lista_documentos_obrigatorios.id')
                ->where('documentos_estagios.aluno_id', $aluno->id)
                ->where('documentos_estagios.estagio_id', $estagio->id);
        })
            ->select('documentos_estagios.*', 'lista_documentos_obrigatorios.*')
            ->get();

        $lista_documentos = ListaDocumentosObrigatorios::leftJoin('documentos_estagios', function ($join) use ($aluno, $estagio) {
            $join->on('lista_documentos_obrigatorios.id', '=', 'documentos_estagios.lista_documentos_obrigatorios_id')
                ->where('documentos_estagios.aluno_id', $aluno->id)
                ->where('documentos_estagios.estagio_id', $estagio->id);
        })
            ->where('lista_documentos_obrigatorios.instituicao', $instituicao)
            ->select(
                'lista_documentos_obrigatorios.*',
                'documentos_estagios.status',
                'documentos_estagios.estagio_id',
                'documentos_estagios.observacao',
                'documentos_estagios.created_at as data_envio',
                'documentos_estagios.updated_at as data_atualizacao',
                'documentos_estagios.id as documento_id',
                'documentos_estagios.is_completo',
                'documentos_estagios.is_visualizado'
            )
            ->get();

        return view('Estagio.documentos.documentos_show', compact("estagio", "documentos", "lista_documentos", "aluno"));
    }

    public function getEstagioAtual()
    {
        $aluno_id = auth()->user()->typage_id;

        $estagioAtual = Estagio::where('aluno_id', $aluno_id)
            ->where('status', true)
            ->orderBy('created_at', 'desc')
            ->first();

        return $estagioAtual;
    }

    public function verificar_aluno_view()
    {
        return view('Estagio.verificar-aluno');
    }

    public function verificarAluno(Request $request)
    {
        $cpf = $request->input('cpf');
        
        $aluno = Aluno::where('cpf', $cpf)->first();
        
        $orientadors = Orientador::all();
        $cursos = Curso::all();
        $disciplinas = Disciplina::all();

        if($aluno){
            return view('Estagio.cadastrar', compact('aluno', 'orientadors', 'cursos', 'disciplinas'));
        } else {
            return view("Alunos.cadastro-aluno", compact('cursos','cpf'));
        }
    }
}
