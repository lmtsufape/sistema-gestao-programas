<?php

namespace App\Http\Controllers;

use App\Models\Programa_servidor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Edital;
use App\Models\Aluno;
use App\Models\Disciplina;
use App\Models\Programa;
use App\Models\Orientador;
use App\Models\EditalAlunoOrientadors;
use App\Http\Requests\EditalStoreFormRequest;
use App\Http\Requests\EditalUpdateFormRequest;
use App\Http\Requests\VinculoUpdateFormRequest;
use App\Models\FrequenciaMensalAlunos;
use App\Models\HistoricoVinculoAlunos;
use App\Models\RelatorioFinal;
use App\Models\User;
use Exception;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use App\Notifications\RelatorioEnviadoNotification;
use App\Notifications\RelatorioAvaliadoNotification;
use App\Models\SistemaExterno;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

use function PHPSTORM_META\type;

class EditalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //public function index($programa_id = null)
    public function index(Request $request)
    {
        $orientadors = Orientador::all();
        $user = auth()->user()->typage;

        if (sizeof($request->query()) > 0) {
            $campo = $request->query('campo');
            $valor = $request->query('valor');

            if ($valor == null) {
                return redirect()->back()->withErrors("Deve ser informado algum valor para o filtro.");
            }

            $editais = Edital::join('programas', 'editals.programa_id', '=', 'programas.id');

            $editais = $editais->where(function ($query) use ($valor) {
                if ($valor) {
                    $query->orWhere("editals.titulo_edital", "LIKE", "%{$valor}%");
                    $query->orWhere("editals.descricao", "LIKE", "%{$valor}%");
                    $query->orWhere("programas.nome", "LIKE", "%{$valor}%");
                }
            })->orderBy('editals.created_at', 'desc')->select("editals.*")->distinct()->get();


            return view("Edital.index", compact("editais", "orientadors"));
        } else {
            if (auth()->user()->hasRole('administrador')) {
                $editais = Edital::all()->sortBy('id');
            } else {
                $editais = [];

                $programas_serv = Programa_servidor::where('servidor_id', Auth::user()->typage_id)->get();

                foreach ($programas_serv as $programa_serv) {
                    $edital_programa = Edital::where('programa_id', $programa_serv->programa_id)->get();

                    foreach ($edital_programa as $edital) {
                        $editais[] = $edital;
                    }
                }
            }

            return view("Edital.index", compact("editais", "orientadors"));
        }
    }

    public function getCpfs()
    {
        $cpfs = Aluno::select('cpf', 'nome_aluno')->get();

        $data = $cpfs->map(function ($item) {
            return [
                'cpf' => $item->cpf,
                'nome' => $item->nome_aluno,
            ];
        });

        return response()->json($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(?Programa $programa = null)
    {
        $user = auth()->user()->typage;
        $disciplinas = Disciplina::all();
        if (!$programa) {

            if (auth()->user()->hasRole('administrador')) {
                $programas = Programa::all()->sortBy('id');
            } else {
                $programas = [];
                $programas_serv = Programa_servidor::where('servidor_id', Auth::user()->typage_id)->get();

                foreach ($programas_serv as $programa_serv) {
                    $programa = Programa::findOrFail($programa_serv->programa_id);

                    $programas[] = $programa;
                }
            }
            return view("Edital.cadastrar", compact("programas", "disciplinas"));
        }
        return view("Edital.cadastrar", compact('programa', 'disciplinas'));
    }

    public function store(editalstoreFormRequest $request)
    {
        // DB::beginTransaction();
        // try {

        $edital = new Edital();
        $edital->descricao  = $request->descricao == null ? "" : $request->descricao;
        $edital->semestre = $request->semestre;
        $edital->data_inicio = $request->data_inicio;
        $edital->data_fim = $request->data_fim;
        $edital->titulo_edital = $request->titulo_edital;
        $edital->valor_bolsa = $request->valor_bolsa;
        //$edital->valor_bolsa = $request->tem_bolsa == 1 ? $request->valor_bolsa : 0;
        //$edital->valor_bolsa = $request->valor_bolsa;
        #$edital->disciplina_id = $request->disciplina;
        // 'info_complementares' => $request->info_complementares == null ? "-" : $request->name_social,

        $edital->programa_id = $request->programa;

        $edital->save();

        $disciplinas_id = $request->disciplinas;
        if ($disciplinas_id != null) {
            foreach ($disciplinas_id as $id) {
                $disciplina = Disciplina::Where('id', $id)->first();
                $disciplina->editais()->attach($edital->id);
            }
        }

        // DB::commit();

        return redirect('/edital')->with('sucesso', 'Edital cadastrado com sucesso.');

        // } catch(Exception $e){
        //     DB::rollback();

        //     return redirect()->back()->withErrors( "Falha ao cadastrar Edital. tente novamente mais tarde." );
        // }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response87
     */
    public function show($id)
    {
        $edital = Edital::findOrFail($id);
        $orientadores = Orientador::with('user')->get();

        return view('Edital.show', ['edital' => $edital, 'orientadores' => $orientadores]);
    }

    public function inscrever_aluno(Request $request, $id)
    {
        // DB::beginTransaction();
        // try {

        $edital = Edital::find($id);
        $aluno = Aluno::where('cpf', $request->cpf)->with('user')->first();
        $orientador = Orientador::with('user')->find($request->orientador);

        $orientador_id = (int)$request->orientador;

        $request->validate([
            'termo_compromisso_aluno' => 'required|mimes:pdf|max:2048',
            'plano_projeto' => 'required|mimes:pdf|max:2048',
            'outros_documentos' => 'mimes:pdf|max:2048'
        ]);
        $termo_aluno = "";
        $plano_projeto = "";
        $outros_documentos = "";


        if ($request->hasFile('termo_compromisso_aluno') && $request->file('termo_compromisso_aluno')->isValid()) {
            $aluno_nome = preg_replace('/[^A-Za-z0-9_\-]/', '_', $aluno->nome_aluno);
            $termo_aluno = "termo_compromisso_aluno_" . $aluno_nome . "_" . $edital->id . now()->format('YmdHis') . '.' . $request->termo_compromisso_aluno->extension();
            // Armazenar o arquivo na pasta "termo_compromisso_alunos"
            $request->termo_compromisso_aluno->storeAs('termo_compromisso_alunos', $termo_aluno);
        }

        if ($request->hasFile('plano_projeto') && $request->file('plano_projeto')->isValid()) {
            $orientador_nome = preg_replace('/[^A-Za-z0-9_\-]/', '_', $orientador->user->name);
            $plano_projeto = "plano_projeto_" . $orientador_nome . "_" . $edital->id . now()->format('YmdHis') . '.' . $request->plano_projeto->extension();
            // Armazenar o arquivo na pasta "termo_compromisso_alunos"
            $request->plano_projeto->storeAs('plano_projeto', $plano_projeto);
        }

        if ($request->hasFile('outros_documentos') && $request->file('outros_documentos')->isValid()) {
            $outros_documentos = "outros_documentos_" . $edital->id . now()->format('YmdHis') . '.' . $request->outros_documentos->extension();
            // Armazenar o arquivo na pasta "termo_compromisso_alunos"
            $request->outros_documentos->storeAs('outros_documentos', $outros_documentos);
        }
        if ($edital->alunos()->wherePivot('aluno_id', $aluno->id)->exists()) {
            return redirect()->route('edital.vinculo', ['id' => $edital->id])->with('falha', 'O aluno já está cadastrado no edital.');
        } else {
            $data = [
                'titulo' => $edital->titulo_edital,
                'data_inicio' => $edital->data_inicio,
                'data_fim' => $edital->data_fim,
                'bolsa' => $request->bolsa,
                #'plano_projeto' => "plano de projeto",
                'info_complementares' => $request->info_complementares == null ? "-" : $request->info_complementares,
                #'disciplina_id' => $edital->disciplina_id,
                'edital_id' => $edital->id,
                'aluno_id' => $aluno->id,
                'orientador_id' => $orientador_id,
            ];
            $data['plano_projeto'] = $plano_projeto;
            $data['termo_compromisso_aluno'] = $termo_aluno;
            $data['outros_documentos'] = $outros_documentos;
            if ($request->bolsa == 'Voluntário') {
                $data['bolsista'] = false;
            } else {
                $data['bolsista'] = true;
            }
            $editalAlunoOrientador = EditalAlunoOrientadors::create($data);

            $historico = new HistoricoVinculoAlunos();
            $historico->vinculo_id = $editalAlunoOrientador->id;
            $historico->data_inicio = date('Y-m-d');
            $historico->save();

            // DB::commit();
            return redirect()->route('edital.vinculo', ['id' => $edital->id])->with('successo', 'O aluno foi inscrito com sucesso no edital.');
        }
        // } catch(Exception $e){
        //      DB::rollback();

        //      return redirect()->back()->withErrors( "Falha ao cadastrar aluno ao edital." )->withInput();
        //  }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    public function edit($id)
    {
        $user = auth()->user()->typage;
        $edital = Edital::Where('id', $id)->first();
        $disciplinas = Disciplina::all();
        $disciplinasSelecionadas = $edital->disciplinas->pluck('id')->toArray();

        if (auth()->user()->hasRole('administrador')) {
            $programas = Programa::all()->sortBy('id');
        } else {
            $programas = [];
            $programas_serv = Programa_servidor::where('servidor_id', Auth::user()->typage_id)->get();

            foreach ($programas_serv as $programa_serv) {
                $programa = Programa::findOrFail($programa_serv->programa_id);

                $programas[] = $programa;
            }
        }

        return view("Edital.editar", compact("edital", "programas", "disciplinas", "disciplinasSelecionadas"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditalUpdateFormRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            $edital = Edital::find($id);
            $edital->descricao = $request->descricao ?? $edital->descricao; //$edital->descricao  = $request->descricao == null? "" : $request->descricao;
            $edital->semestre = $request->semestre ? $request->semestre : $edital->semestre;
            $edital->titulo_edital = $request->titulo_edital ? $request->titulo_edital : $edital->titulo_edital;
            $edital->valor_bolsa = $request->checkBolsa == "sim" ? $request->valor_bolsa : null;
            $edital->data_inicio = $request->data_inicio ? $request->data_inicio : $edital->data_inicio;
            $edital->data_fim = $request->data_fim ? $request->data_fim : $edital->data_fim;
            $edital->programa_id = $request->programa ? $request->programa : $edital->programa_id;
            #$edital->disciplina_id = $request->disciplina ? $request->disciplina : $edital->disciplina_id;


            $edital->disciplinas()->sync($request->disciplinas);

            $edital->update();

            DB::commit();

            return redirect()->route('edital.index')
                ->with('sucesso', 'Edital editado com sucesso.');
        } catch (exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors("Falha ao editar Edital. tente novamente mais tarde.");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return RedirectResponse
     */
    public function destroy($id)
    {
        try {
            $existeEdital = EditalAlunoOrientadors::where([
                ['edital_id', $id],
                ['status', true]
            ])->exists();

            if ($existeEdital) {
                return redirect()->back()->withErrors("Falha ao deletar Edital. Existem alunos vinculados a ele.");
            } else {
                DB::beginTransaction();
                $edital = Edital::find($id);
                $edital->disciplinas()->detach();
                $edital->delete();

                DB::commit();
                return redirect()->route('edital.index')->with('sucesso', 'Edital deletado com sucesso.');
            }
        } catch (\Illuminate\Database\QueryException $e) {
            DB::rollback();

            return redirect()->back()->withErrors("Falha ao deletar Edital. Erro ao executar operação no banco de dados.");
        } catch (Exception $e) {
            DB::rollback();

            return redirect()->back()->withErrors("Falha ao deletar Edital. Erro: " . $e->getMessage());
        }
    }
    public function listar_alunos(Request $request, $id)
    {

        $edital = Edital::where('id', $id)->first();

        if (sizeof($request->query()) > 0) {

            $campo = $request->query('campo');
            $valor = $request->query('valor');

            if ($valor == null && $request->query('modal') == null) {
                return redirect()->back()->withErrors("Deve ser informado algum valor para o filtro.");
            }

            $vinculos = EditalAlunoOrientadors::where('edital_id', $id)
                ->where('status', true)
                ->where(function ($query) use ($valor) {
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
                        ->orWhereHas('edital', function ($subquery) use ($valor) {
                            $subquery->where('titulo_edital', 'LIKE', "%{$valor}%");
                        })
                        //Query para a tabela edital_aluno_orientadors
                        ->orWhere('titulo', 'LIKE', "%{$valor}%")
                        ->orWhere('info_complementares', 'LIKE', "%{$valor}%");
                })
                ->orderBy('created_at', 'desc')
                ->distinct()
                ->get();


            return view("Edital.listar_alunos", compact("vinculos", "edital"));
        } else {
            $vinculos = EditalAlunoOrientadors::where('edital_id', $id)->where('status', true)->get();
            $frequencias = FrequenciaMensalAlunos::where('edital_aluno_orientador_id', $id)->get();

            if ($vinculos->isEmpty()) {
                return redirect()->back()->with('falha', 'Não há alunos cadastrados no edital.');
            } else {
                return view("Edital.listar_alunos", compact("vinculos", "edital", "frequencias"));
            }
        }
    }

    public function listar_alunos_inativos(Request $request, $id)
    {

        $edital = Edital::where('id', $id)->first();

        if (sizeof($request->query()) > 0) {

            $campo = $request->query('campo');
            $valor = $request->query('valor');

            if ($valor == null) {
                return redirect()->back()->withErrors("Deve ser informado algum valor para o filtro.");
            }

            $vinculos = EditalAlunoOrientadors::where('edital_id', $id)
                ->where('status', false)
                ->where(function ($query) use ($valor) {
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
                        ->orWhereHas('edital', function ($subquery) use ($valor) {
                            $subquery->where('titulo_edital', 'LIKE', "%{$valor}%");
                        })
                        //Query para a tabela edital_aluno_orientadors
                        ->orWhere('titulo', 'LIKE', "%{$valor}%")
                        ->orWhere('info_complementares', 'LIKE', "%{$valor}%");
                })
                ->orderBy('created_at', 'desc')
                ->distinct()
                ->get();

            return view("Edital.listar_alunos_inativos", compact("vinculos", "edital"));
        } else {

            $vinculos = EditalAlunoOrientadors::where('edital_id', $id)->where('status', false)->get();
            $count = $vinculos->count();

            if ($vinculos->isEmpty()) {
                return redirect()->back()->with('falha', 'Não há alunos inativos no edital.');
            } else {
                return view("Edital.listar_alunos_inativos", compact("vinculos", "edital"));
            }
        }





        //-----------------------------


    }


    public function ativarVinculo($id)
    {
        try {
            EditalAlunoOrientadors::where("id", $id)->update(['status' => true]);

            $historico = new HistoricoVinculoAlunos();
            $historico->vinculo_id = $id;
            $historico->data_inicio = date('Y-m-d');

            $historico->save();

            return redirect()->route('edital.index')->with('sucesso', "O vínculo foi ativado com sucesso no edital.");
        } catch (exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors("Falha ao ativar o vínculo. Tente novamente mais tarde");
        }
    }

    public function listar_disciplinas($id)
    {
        $disciplinas = Edital::with('disciplinas')->find($id);

        return view("Edital.listar_disciplinas", compact("disciplinas"));
    }

    public function listar_orientadores(Request $request, $id)
    {

        if (sizeof($request->query()) > 0) {

            $campo = $request->query('campo');
            $valor = $request->query('valor');

            if ($valor == null) {
                return redirect()->back()->withErrors("Deve ser informado algum valor para o filtro.");
            }

            $vinculos = EditalAlunoOrientadors::where('edital_id', $id)->where(function ($query) use ($valor) {
                $query->orWhereHas('orientador.user', function ($subquery) use ($valor) {
                    $subquery->where('cpf', 'LIKE', "%{$valor}%")
                        ->orWhere('name', 'LIKE', "%{$valor}%")
                        ->orWhere('email', 'LIKE', "%{$valor}%")
                        ->orWhere('matricula', 'LIKE', "%{$valor}%");
                })
                    ->orWhereHas('edital', function ($subquery) use ($valor) {
                        $subquery->where('titulo_edital', 'LIKE', "%{$valor}%");
                    })
                    //Query para a tabela edital_aluno_orientadors
                    ->orWhere('titulo', 'LIKE', "%{$valor}%")
                    ->orWhere('info_complementares', 'LIKE', "%{$valor}%");
            })
                ->orderBy('created_at', 'desc')
                ->distinct()
                ->get();

            return view("Edital.listar_orientadores", compact("vinculos"));
        } else {
            $vinculos = EditalAlunoOrientadors::where('edital_id', $id)->get();

            if ($vinculos->isEmpty()) {
                return redirect()->back()->with('falha', 'Não há orientadores cadastrados no edital.');
            } else {
                return view("Edital.listar_orientadores", compact("vinculos"));
            }
        }
    }

    /**
     * Display the specified resource.
     *
     */
    public function download_termo_compromisso_aluno($fileName)
    {

        $path = 'termo_compromisso_alunos/' . $fileName;

        if (Storage::exists($path)) {
            return Storage::download($path);
        } else {
            return redirect()->back()->with('falha', 'Arquivo não encontrado.');
        }
    }

    public function download_plano_trabalho($fileName)
    {
        $path = "plano_projeto/" . $fileName;

        if (Storage::exists($path)) {
            return Storage::download($path);
        } else {
            return redirect()->back()->with('falha', 'Arquivo não encontrado.');
        }
    }

    public function download_outros_documentos($fileName)
    {
        $path = "outros_documentos/" . $fileName;

        if (Storage::exists($path)) {
            return Storage::download($path);
        } else {
            return redirect()->back()->with('falha', 'Arquivo não encontrado.');
        }
    }


    public function editar_vinculo($aluno_id, $edital_id)
    {
        $vinculo = EditalAlunoOrientadors::where('aluno_id', $aluno_id)->where('edital_id', $edital_id)->first();
        $aluno = Aluno::find($vinculo->aluno_id);
        $edital = Edital::find($vinculo->edital_id);
        $orientadores = Orientador::all();
        //$vinculo = EditalAlunoOrientadors::find($id)
        return view("Edital.editar_vinculo", compact('aluno', 'edital', 'orientadores', 'vinculo'));
    }

    public function updateVinculo(VinculoUpdateFormRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            $vinculo = EditalAlunoOrientadors::find($id);

            $edital = Edital::find($vinculo->edital_id);
            $aluno = Aluno::where('id', $vinculo->aluno_id)->first();
            $orientador = Orientador::with('user')->find($vinculo->orientador_id);

            $vinculo->info_complementares = $request->info_complementares ? $request->info_complementares : $vinculo->info_complementares;

            $plano_projeto = null;
            $termo_aluno = null;
            $outros_documentos = null;

            if ($request->hasFile('termo_compromisso_aluno') && $request->file('termo_compromisso_aluno')->isValid()) {
                $aluno_nome = preg_replace('/[^A-Za-z0-9_\-]/', '_', $aluno->nome_aluno);
                $termo_aluno = "termo_compromisso_aluno_" . $aluno_nome . "_" . $edital->id . now()->format('YmdHis') . '.' . $request->termo_compromisso_aluno->extension();

                //Deleta o termo antigo do banco, caso haja algum
                $termo_aluno_antigo = "termo_compromisso_alunos/" . $vinculo->termo_compromisso_aluno;
                if (Storage::exists($termo_aluno_antigo)) {
                    Storage::delete($termo_aluno_antigo);
                }
                // Armazenar o arquivo na pasta "termo_compromisso_alunos"
                $request->termo_compromisso_aluno->storeAs('termo_compromisso_alunos', $termo_aluno);
            }

            if ($request->hasFile('plano_projeto') && $request->file('plano_projeto')->isValid()) {
                $orientador_nome = preg_replace('/[^A-Za-z0-9_\-]/', '_', $orientador->user->name);
                $plano_projeto = "plano_projeto_" . $orientador_nome . "_" . $edital->id . now()->format('YmdHis') . '.' . $request->plano_projeto->extension();

                //Deleta o termo antigo do banco, caso haja algum
                $plano_projeto_antigo = "plano_projeto/" . $vinculo->plano_projeto;
                if (Storage::exists($plano_projeto_antigo)) {
                    Storage::delete($plano_projeto_antigo);
                }
                // Armazenar o arquivo na pasta "termo_compromisso_alunos"
                $request->plano_projeto->storeAs('plano_projeto', $plano_projeto);
            }

            if ($request->hasFile('outros_documentos') && $request->file('outros_documentos')->isValid()) {
                $outros_documentos = "outros_documentos_" . $edital->id . now()->format('YmdHis') . '.' . $request->outros_documentos->extension();

                //Deleta o termo antigo do banco, caso haja algum
                $outros_documentos_antigo = "outros_documentos/" . $vinculo->outros_documentos;
                if (Storage::exists($outros_documentos_antigo)) {
                    Storage::delete($outros_documentos_antigo);
                }
                // Armazenar o arquivo na pasta "termo_compromisso_alunos"
                $request->outros_documentos->storeAs('outros_documentos', $outros_documentos);
            }

            $vinculo->termo_compromisso_aluno = $request->termo_compromisso_aluno ? $termo_aluno : $vinculo->termo_compromisso_aluno;
            $vinculo->plano_projeto = $request->plano_projeto ? $plano_projeto : $vinculo->plano_projeto;
            $vinculo->outros_documentos = $request->outros_documentos ? $outros_documentos : $vinculo->outros_documentos;

            $vinculo->update();

            DB::commit();

            //return redirect()->back()->with('sucesso', 'O vínculo foi alterado com sucesso no edital.');
            return redirect()->route('edital.vinculo', ['id' => $vinculo->edital_id])->with('sucesso', "O vínculo foi alterado com sucesso no edital.");
        } catch (exception $e) {
            DB::rollback();
            dd($e);
            return redirect()->back()->withErrors("Falha ao atualizar o vínculo do aluno no edital.");
        }
        //return redirect()->route('edital.vinculo', ['id' => $vinculo->edital_id])->with('success', 'O vínculo foi alterado com sucesso no edital.');

    }


    public function deletarVinculo($id)
    {

        DB::beginTransaction();
        try {
            //EditalAlunoOrientadors::where("aluno_id", $aluno_id)->where('edital_id', $edital_id)->update(['status' => false]);
            EditalAlunoOrientadors::where("id", $id)->update(['status' => false]);

            $vinculo = EditalAlunoOrientadors::where("id", $id)->first();
            #dd($vinculo['id']);
            HistoricoVinculoAlunos::where("vinculo_id", $vinculo->id)->update(['data_fim' => date('Y-m-d')]);

            /*
                Como um vínculo não será apagado, apenas o status dele muda para "false"
                então não vamos remover os documentos do banco, pois o vinculo pode ser
                ativado novamente no futuro.
            */
            DB::commit();
            return redirect()->route('edital.index')->with('sucesso', 'O vínculo foi desativado com sucesso do edital.');
        } catch (QueryException $e) {
            DB::rollback();
            return redirect()->back()->withErrors("Falha ao Arquivar. Este vínculo está sendo usado em um Relatorio.");
        } catch (exception $e) {
            DB::rollback();

            return redirect()->back()->withErrors("Falha ao Arquivar o vínculo do aluno no edital.");
        }
    }

    public function adicionar_documentos($id)
    {
        $vinculo = EditalAlunoOrientadors::findOrFail($id);

        return view('Edital.adicionar-documentos', compact('vinculo'));
    }

    public function store_adicionar_documentos(Request $request)
    {
        try {
            DB::beginTransaction();

            $vinculo = EditalAlunoOrientadors::Where('id', $request->vinculo_id)->first();

            $request->validate([
                'termo_aluno' => 'required|mimes:pdf|max:2048',
                'termo_orientador' => 'required|mimes:pdf|max:2048',
                'historico_escolar' => 'required|mimes:pdf|max:2048',
                'comprovante_bancario' => 'mimes:pdf|max:2048'
            ]);
            $termo_aluno = "";
            $termo_orientador = "";
            $historico_escolar = "";
            $comprovante_bancario = "";

            $aluno_nome = preg_replace('/[^A-Za-z0-9_\-]/', '_', $vinculo->aluno->nome_aluno);

            if ($request->hasFile('termo_aluno') && $request->file('termo_aluno')->isValid()) {
                $termo_aluno = "termo_aluno_" . $aluno_nome . "_" . $vinculo->id . now()->format('YmdHis') . '.' . $request->termo_aluno->extension();

                //Deleta o termo antigo do banco, caso haja algum
                $termo_aluno_antigo = "termo_alunos/" . $vinculo->termo_aluno;
                if (Storage::exists($termo_aluno_antigo)) {
                    Storage::delete($termo_aluno_antigo);
                }
                // Armazenar o arquivo na pasta "termo_alunos"
                $request->termo_aluno->storeAs('termo_alunos', $termo_aluno);
            }

            if ($request->hasFile('termo_orientador') && $request->file('termo_orientador')->isValid()) {
                $orientador_nome = preg_replace('/[^A-Za-z0-9_\-]/', '_', $vinculo->orientador->user->name);
                $termo_orientador = "termo_orientador_" . $orientador_nome . "_" . $vinculo->id . now()->format('YmdHis') . '.' . $request->termo_orientador->extension();

                //Deleta o termo antigo do banco, caso haja algum
                $termo_orientador_antigo = "termo_orientadors/" . $vinculo->termo_orientador;
                if (Storage::exists($termo_orientador_antigo)) {
                    Storage::delete($termo_orientador_antigo);
                }
                // Armazenar o arquivo na pasta "termo_orientadors"
                $request->termo_orientador->storeAs('termo_orientadors', $termo_orientador);
            }

            if ($request->hasFile('historico_escolar') && $request->file('historico_escolar')->isValid()) {
                $historico_escolar = "historico_escolar_" . $vinculo->id . now()->format('YmdHis') . '.' . $request->historico_escolar->extension();

                //Deleta o termo antigo do banco, caso haja algum
                $historico_escolar_antigo = "historicos_escolares_alunos/" . $vinculo->historico_escolar;
                if (Storage::exists($historico_escolar_antigo)) {
                    Storage::delete($historico_escolar_antigo);
                }
                // Armazenar o arquivo na pasta "historicos_escolares_alunos"
                $request->historico_escolar->storeAs('historicos_escolares_alunos', $historico_escolar);
            }

            if ($request->hasFile('comprovante_bancario') && $request->file('comprovante_bancario')->isValid()) {
                $comprovante_bancario = "comprovante_bancario_" . $vinculo->id . now()->format('YmdHis') . '.' . $request->comprovante_bancario->extension();

                //Deleta o termo antigo do banco, caso haja algum
                $comprovante_bancario_antigo = "comprovantes_bancarios/" . $vinculo->comprovante_bancario;
                if (Storage::exists($comprovante_bancario_antigo)) {
                    Storage::delete($comprovante_bancario_antigo);
                }

                // Armazenar o arquivo na pasta "comprovantes_bancarios"
                $request->comprovante_bancario->storeAs('comprovantes_bancarios', $comprovante_bancario);
            }

            #dd($termo_aluno);
            $vinculo->termo_aluno = $termo_aluno;
            $vinculo->termo_orientador = $termo_orientador;
            $vinculo->historico_escolar = $historico_escolar;
            $vinculo->comprovante_bancario = $comprovante_bancario != "" ? $comprovante_bancario : null;

            $vinculo->update();

            DB::commit();
            return redirect()->route('orientadors.editais-orientador')->with('sucesso', 'Documentos inseridos no vínculo com sucesso.');
        } catch (ValidationException $e) {
            DB::rollback();
            return redirect()->back()->withErrors("Arquivo muito grande. Diminua os arquivos e tente novamente.");
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors("Falha ao Inserir os Documentos. Tente novamente mais tarde.");
        }
    }

    public function download_termo_aluno($fileName)
    {
        $path = "termo_alunos/" . $fileName;

        if (Storage::exists($path)) {
            return Storage::download($path);
        } else {
            return redirect()->back()->with('falha', 'Arquivo não encontrado.');
        }
    }

    public function download_termo_orientador($fileName)
    {
        $path = "termo_orientadors/" . $fileName;

        if (Storage::exists($path)) {
            return Storage::download($path);
        } else {
            return redirect()->back()->with('falha', 'Arquivo não encontrado.');
        }
    }

    public function download_historico_escolares_alunos($fileName)
    {
        $path = "historicos_escolares_alunos/" . $fileName;

        if (Storage::exists($path)) {
            return Storage::download($path);
        } else {
            return redirect()->back()->with('falha', 'Arquivo não encontrado.');
        }
    }

    public function download_comprovante_bancario($fileName)
    {
        $path = "comprovantes_bancarios/" . $fileName;

        if (Storage::exists($path)) {
            return Storage::download($path);
        } else {
            return redirect()->back()->with('falha', 'Arquivo não encontrado.');
        }
    }

    public function enviarFrequencia(Request $request)
    {
        $vinculo = EditalAlunoOrientadors::where('edital_id', $request->edital_id)
            ->whereHas('aluno', function ($query) {
                $query->where('cpf', Auth::user()->cpf);
            })
            ->with('frequencias')
            ->first();

        $request->validate([
            'frequencia_mensal' => 'required|mimes:pdf|max:2048',

        ]);
        $frequencia_aluno = "";

        if ($request->hasFile('frequencia_mensal') && $request->file('frequencia_mensal')->isValid()) {
            $aluno_nome = preg_replace('/[^A-Za-z0-9_\-]/', '_', Auth::user()->name);
            $frequencia_aluno = "frequencia_mensal_" . $vinculo->id . "_" . $aluno_nome . "_" . now()->format('m') . "_" . now()->format('Y') . '.' . $request->frequencia_mensal->extension();
            // Armazenar o arquivo na pasta "frequencia_mensal"
            $request->frequencia_mensal->storeAs('frequencia_mensal', $frequencia_aluno);
        }

        $frequencia = new FrequenciaMensalAlunos();
        $frequencia->edital_aluno_orientador_id = $vinculo->id;
        $frequencia->frequencia_mensal = $frequencia_aluno;
        $frequencia->data = now();
        $frequencia->save();


        return redirect(route('Aluno.editais-aluno'))->with('sucesso', 'A frequencia foi enviada com sucesso.');
    }

    public function download_frequencia_mensal($fileName)
    {
        $path = "frequencia_mensal/" . $fileName;

        if (Storage::exists($path)) {
            return Storage::download($path);
        } else {
            return redirect()->back()->with('falha', 'Arquivo não encontrado.');
        }
    }

    public function enviarRelatorio(Request $request)
    {
        $vinculo = EditalAlunoOrientadors::where('edital_id', $request->edital_id)
            ->whereHas('aluno', function ($query) {
                $query->where('cpf', Auth::user()->cpf);
            })->firstOrFail();

        $relatorio_enviado = RelatorioFinal::where('edital_aluno_orientador_id', $vinculo->id)->first();

        if ($relatorio_enviado && $relatorio_enviado->status != 3) {
            return back()->withErrors(['falha' => 'Relatório final já enviado anteriormente!']);
        }

        $request->validate([
            'relatorio_final' => 'required|mimes:pdf|max:2048',
        ]);

        $relatorio_aluno = "";
        $caminho = null;

        $semestre = str_replace('.', '_', $vinculo->edital->semestre);

        try {
            DB::beginTransaction();

            if ($request->hasFile('relatorio_final') && $request->file('relatorio_final')->isValid()) {
                $aluno_nome = preg_replace('/[^A-Za-z0-9_\-]/', '_', Auth::user()->name);
                $relatorio_aluno = "relatorio_final_{$vinculo->id}_{$aluno_nome}_{$semestre}." . $request->relatorio_final->extension();
                $request->relatorio_final->storeAs('relatorio_final', $relatorio_aluno);
            }

            $caminho = $request->file('relatorio_final')->storeAs('relatorio_final', $relatorio_aluno);

            if ($relatorio_enviado) {
                $relatorio_enviado->caminho = $caminho;
                $relatorio_enviado->status = 1;
                $relatorio_enviado->update();
                User::find(5)->notify(new RelatorioEnviadoNotification($relatorio_enviado));
            } else {
                $relatorio = new RelatorioFinal();
                $relatorio->caminho = $caminho;
                $relatorio->edital_aluno_orientador_id = $vinculo->id;
                $relatorio->save();
                User::find(5)->notify(new RelatorioEnviadoNotification($relatorio));
            }

            DB::commit();

            return back()->with('sucesso', 'Relatório final enviado com sucesso!');
        } catch (\Exception $e) {
            DB::rollBack();

            if ($caminho && Storage::exists($caminho)) {
                Storage::delete($caminho);
            }

            return back()->withErrors(['falha' => 'Falha ao enviar o relatório. Tente novamente.']);
        }
    }

    public function download_relatorio_final($relatorio_id)
    {
        $relatorio = RelatorioFinal::findOrFail($relatorio_id);

        if (Storage::exists($relatorio->caminho)) {
            return Storage::download($relatorio->caminho);
        } else {
            return redirect()->back()->with('falha', 'Arquivo não encontrado.');
        }
    }

    public function visualizar_relatorio_final($relatorio_id)
    {
        $relatorio = RelatorioFinal::findOrFail($relatorio_id);

        if (Storage::exists($relatorio->caminho)) {
            return Storage::response($relatorio->caminho);
        } else {
            return redirect()->back()->with('falha', 'Arquivo não encontrado.');
        }
    }

    public function parecer_relatorio_final(Request $request)
    {
        $dados = $request->validate([
            'status' => 'required|integer|in:2,3',
            'parecer' => 'nullable|string',
            'carga_horaria' => 'required|integer|min:0'
        ]);

        $relatorio = RelatorioFinal::findOrFail($request->relatorio_id);

        $relatorio->update($dados);

        $user = $relatorio->editalAlunoOrientador->aluno->user;
        $user->notify(new RelatorioAvaliadoNotification($relatorio));

        if ($relatorio->status == RelatorioFinal::STATUS_ENUM['aprovado']) {
            \App\Jobs\ParecerRelatorioFinalJob::dispatch($relatorio->id);
        }

        return back()->with('sucesso', 'Relatório avaliado com sucesso!');
    }
}
