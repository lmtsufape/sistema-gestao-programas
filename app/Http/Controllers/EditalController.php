<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Edital;
use App\Models\Aluno;
use App\Models\Disciplina;
use App\Models\Programa;
use App\Models\Orientador;
use App\Models\EditalAlunoOrientadors;
use App\Http\Requests\EditalStoreFormRequest;
use App\Http\Requests\EditalUpdateFormRequest;
use App\Http\Requests\VinculoUpdateFormRequest;
use App\Models\HistoricoVinculoAlunos;
use App\Models\User;
use Exception;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Storage;

use function PHPSTORM_META\type;

class EditalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($programa_id = null)
    {
        $orientadors = Orientador::all();

        $editais = Edital::all();

        return view("Edital.index", compact("editais", "orientadors"));
    }

    public function getCpfs() {
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
    public function create()
    {
        $programas = Programa::all();

        $disciplinas = Disciplina::all();
        return view("Edital.cadastrar", compact("programas", "disciplinas"));
    }

    public function store(editalstoreFormRequest $request)
    {
        // DB::beginTransaction();
        // try {

            $edital = new Edital();
            $edital->descricao  = $request->descricao == null? "" : $request->descricao;
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
            if($disciplinas_id != null){
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

    public function inscrever_aluno(Request $request, $id) {
        DB::beginTransaction();
        try {

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


            if($request->hasFile('termo_compromisso_aluno') && $request->file('termo_compromisso_aluno')->isValid()) {
                $aluno_nome = preg_replace('/[^A-Za-z0-9_\-]/', '_', $aluno->nome_aluno);
                $termo_aluno = "termo_compromisso_aluno_" . $aluno_nome . "_" . $edital->id . now()->format('YmdHis') . '.' . $request->termo_compromisso_aluno->extension();
                // Armazenar o arquivo na pasta "termo_compromisso_alunos"
                $request->termo_compromisso_aluno->storeAs('termo_compromisso_alunos', $termo_aluno);
            }

            if($request->hasFile('plano_projeto') && $request->file('plano_projeto')->isValid()) {
                $orientador_nome = preg_replace('/[^A-Za-z0-9_\-]/', '_', $orientador->user->name);
                $plano_projeto = "plano_projeto_" . $orientador_nome . "_" . $edital->id . now()->format('YmdHis') . '.' . $request->plano_projeto->extension();
                // Armazenar o arquivo na pasta "termo_compromisso_alunos"
                $request->plano_projeto->storeAs('plano_projeto', $plano_projeto);
            }

            if($request->hasFile('outros_documentos') && $request->file('outros_documentos')->isValid()) {
                $outros_documentos = "outros_documentos_" . $edital->id . now()->format('YmdHis') . '.' . $request->outros_documentos->extension();
                // Armazenar o arquivo na pasta "termo_compromisso_alunos"
                $request->outros_documentos->storeAs('outros_documentos', $outros_documentos);
            }
            if($edital->alunos()->wherePivot('aluno_id', $aluno->id)->exists()) {
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
                if($request->bolsa == 'Voluntário') {
                    $data['bolsista'] = false;
                } else {
                    $data['bolsista'] = true;
                }
                $editalAlunoOrientador = EditalAlunoOrientadors::create($data);

                $historico = new HistoricoVinculoAlunos();
                $historico->vinculo_id = $editalAlunoOrientador->id;
                $historico->data_inicio = date('Y-m-d');
                $historico->save();
 
                DB::commit();
                 return redirect()->route('edital.vinculo', ['id' => $edital->id])->with('successo', 'O aluno foi inscrito com sucesso no edital.');
           }
        } catch(Exception $e){
             DB::rollback();
             
             return redirect()->back()->withErrors( "Falha ao cadastrar aluno ao edital." )->withInput();
         }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    public function edit($id)
    {
        $edital = Edital::Where('id', $id)->first();
        $programas = Programa::all();
        $disciplinas = Disciplina::all();
        $disciplinasSelecionadas = $edital->disciplinas->pluck('id')->toArray();

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
        try{
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

        } catch(exception $e){
            DB::rollback();
            return redirect()->back()->withErrors( "Falha ao editar Edital. tente novamente mais tarde." );
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $editalAlunoOrientador = EditalAlunoOrientadors::where('edital_id', $id)->first();
            if ($editalAlunoOrientador){
                return redirect()->back()->withErrors( "Falha ao deletar Edital. Existem alunos vinculados a ele." );
            }
            else{
                DB::beginTransaction();
                try{
                    $edital = Edital::Where('id', $id)->first();
                    if($edital->disciplinas != null){
                        $edital->disciplinas()->detach($edital->disciplinas);
                    }
                    $edital->delete();

                    DB::commit();
                    return redirect()->route('edital.index')->with('sucesso', 'Edital deletado com sucesso.');

                } catch(exception $e){
                    DB::rollback();

                    return redirect()->back()->withErrors( "Falha ao editar Edital. tente novamente mais tarde." );
                }
            }
        } catch(exception $e){
            DB::rollback();

            return redirect()->back()->withErrors( "Falha ao editar Edital. tente novamente mais tarde." );
        }
    }
    public function listar_alunos($id){
        
        $vinculos = EditalAlunoOrientadors::where('edital_id', $id)->where('status', true)->get();
        $count = $vinculos->count();
        $edital = Edital::where('id', $id)->first();

        if ($vinculos->isEmpty()) {
            return redirect()->back()->with('falha', 'Não há alunos cadastrados no edital.');
        } else {
            return view("Edital.listar_alunos", compact("vinculos", "edital"));
        }

    }

    public function listar_alunos_inativos($id){
        
        $vinculos = EditalAlunoOrientadors::where('edital_id', $id)->where('status', false)->get();
        $count = $vinculos->count();
        $edital = Edital::where('id', $id)->first();

        if ($vinculos->isEmpty()) {
            return redirect()->back()->with('falha', 'Não há alunos inativos no edital.');
        } else {
            return view("Edital.listar_alunos_inativos", compact("vinculos", "edital"));
        }

    }

    public function ativarVinculo($id){
        try{
            EditalAlunoOrientadors::where("id", $id)->update(['status' => true]);

            $historico = new HistoricoVinculoAlunos();
            $historico->vinculo_id = $id;
            $historico->data_inicio = date('Y-m-d');

            $historico->save();
            
            return redirect()->route('edital.index')->with('sucesso', "O vínculo foi ativado com sucesso no edital.");

        } catch(exception $e){
             DB::rollback();
             return redirect()->back()->withErrors( "Falha ao ativar o vínculo. Tente novamente mais tarde" );
        }

    }

    public function listar_disciplinas($id){
        $disciplinas = Edital::with('disciplinas')->find($id);

        return view("Edital.listar_disciplinas", compact("disciplinas"));
    }

    public function listar_orientadores($id){
        $pivot = EditalAlunoOrientadors::where('edital_id', $id)->get();
        $count = $pivot->count();
        if($pivot->isEmpty()) {
            return redirect()->back()->with('falha', 'Não há orientadores cadastrados no edital.');
        }
        elseif($count > 1) {
            foreach($pivot as $pivo) {
                $orientador = Orientador::where('id', $pivo->orientador_id)->with('user')->get();
                $orientadores = User::where('typage_type', 'App\Models\Orientador')->where('typage_id', $orientador[0]->id)->get();
            }
            return view("Edital.listar_orientadores", compact("orientadores", "pivot"));
        }
        else {
            $orientador = $pivot->first();
            $orientador = Orientador::where('id', $orientador->orientador_id)->with('user')->get();
            $orientadores = User::where('typage_type', 'App\Models\Orientador')->where('typage_id', $orientador[0]->id)->get();
            return view("Edital.listar_orientadores", compact("orientadores", "pivot"));
        }

    }

    /**
     * Display the specified resource.
     *
     */
    public function download_termo_compromisso_aluno($fileName) {

        $path = 'termo_compromisso_alunos/' . $fileName;
        
        if(Storage::exists($path)) {
            return Storage::download($path);
        } else {
            return redirect()->back()->with('falha', 'Arquivo não encontrado.');
        }
     }

     public function download_plano_trabalho($fileName) {
        $path = "plano_projeto/".$fileName;

        if(Storage::exists($path)) {
            return Storage::download($path);
        } else {
            return redirect()->back()->with('falha', 'Arquivo não encontrado.');
        }
     }

     public function download_outros_documentos($fileName) {
        $path = "outros_documentos/".$fileName;

        if(Storage::exists($path)) {
            return Storage::download($path);
        } else {
            return redirect()->back()->with('falha', 'Arquivo não encontrado.');
        }
     }


     public function editar_vinculo($aluno_id, $edital_id){
        $vinculo = EditalAlunoOrientadors::where('aluno_id', $aluno_id)->where('edital_id', $edital_id)->first();
        $aluno = Aluno::find($vinculo->aluno_id);
        $edital = Edital::find($vinculo->edital_id);
        $orientadores = Orientador::all();
        //$vinculo = EditalAlunoOrientadors::find($id)
        return view("Edital.editar_vinculo", compact('aluno','edital','orientadores', 'vinculo'));
    }

    public function updateVinculo(VinculoUpdateFormRequest $request, $id){
        DB::beginTransaction();
        try {
            $vinculo = EditalAlunoOrientadors::find($id);
            // $vinculo->bolsa = $request->bolsa ? $request->bolsa : $vinculo->bolsa;
            // $vinculo->bolsista = $request->bolsista == "True" ? $request->bolsista == "True" : $vinculo->bolsista;
            $vinculo->info_complementares = $request->info_complementares ? $request->info_complementares : $vinculo->info_complementares;
            $vinculo->termo_compromisso_aluno = $request->termo_compromisso_aluno ? $request->termo_compromisso_aluno: $vinculo->termo_compromisso_aluno;


            $vinculo->update();

            DB::commit();

            //return redirect()->back()->with('sucesso', 'O vínculo foi alterado com sucesso no edital.');
            return redirect()->route('edital.vinculo', ['id' => $vinculo->edital_id])->with('sucesso', "O vínculo foi alterado com sucesso no edital.");

        } catch(exception $e){
             DB::rollback();
             return redirect()->back()->withErrors( "Falha ao atualizar o vínculo do aluno no edital." );

            }
            //return redirect()->route('edital.vinculo', ['id' => $vinculo->edital_id])->with('success', 'O vínculo foi alterado com sucesso no edital.');

    }


    public function deletarVinculo($aluno_id, $edital_id){

        DB::beginTransaction();
        try {
            EditalAlunoOrientadors::where("aluno_id", $aluno_id)->where('edital_id', $edital_id)->update(['status' => false]);

            $vinculo = EditalAlunoOrientadors::where("aluno_id", $aluno_id)->where('edital_id', $edital_id)->first();
            #dd($vinculo['id']);
            HistoricoVinculoAlunos::where("vinculo_id", $vinculo->id)->update(['data_fim' => date('Y-m-d')]);
            #$vinculo->delete();

            // $vinculo->status = false;

            // $vinculo->update();
            DB::commit();
            return redirect()->route('edital.index')->with('sucesso', 'O vínculo foi desativado com sucesso do edital.');

        } catch(QueryException $e){
            DB::rollback();
            return redirect()->back()->withErrors( "Falha ao Arquivar. Este vínculo está sendo usado em um Relatorio." );

        } catch(exception $e){
            DB::rollback();
            
            return redirect()->back()->withErrors( "Falha ao Arquivar o vínculo do aluno no edital." );
        }
    }

    public function adicionar_documentos($id){
        $vinculo = EditalAlunoOrientadors::findOrFail($id);

        return view('Edital.adicionar-documentos', compact('vinculo'));
    }

    public function store_adicionar_documentos(Request $request){
        try{
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

            if($request->hasFile('termo_aluno') && $request->file('termo_aluno')->isValid()) {
                $termo_aluno = "termo_aluno_" . $aluno_nome . "_" . $vinculo->id . now()->format('YmdHis') . '.' . $request->termo_aluno->extension();
                // Armazenar o arquivo na pasta "termo_alunos"
                $request->termo_aluno->storeAs('termo_alunos', $termo_aluno);
            }

            if($request->hasFile('termo_orientador') && $request->file('termo_orientador')->isValid()) {
                $orientador_nome = preg_replace('/[^A-Za-z0-9_\-]/', '_', $vinculo->orientador->user->name);
                $termo_orientador = "termo_orientador_" . $orientador_nome . "_" . $vinculo->id . now()->format('YmdHis') . '.' . $request->termo_orientador->extension();
                // Armazenar o arquivo na pasta "termo_orientadors"
                $request->termo_orientador->storeAs('termo_orientadors', $termo_orientador);
            }

            if($request->hasFile('historico_escolar') && $request->file('historico_escolar')->isValid()) {
                $historico_escolar = "historico_escolar_" . $vinculo->id . now()->format('YmdHis') . '.' . $request->historico_escolar->extension();
                // Armazenar o arquivo na pasta "historicos_escolares_alunos"
                $request->historico_escolar->storeAs('historicos_escolares_alunos', $historico_escolar);
            }

            if($request->hasFile('comprovante_bancario') && $request->file('comprovante_bancario')->isValid()) {
                $comprovante_bancario = "comprovante_bancario_" . $vinculo->id . now()->format('YmdHis') . '.' . $request->comprovante_bancario->extension();
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
          
        } catch(ValidationException $e){
            DB::rollback();
            return redirect()->back()->withErrors( "Arquivo muito grande. Diminua os arquivos e tente novamente." );

        } catch(Exception $e){
            DB::rollback();
            return redirect()->back()->withErrors( "Falha ao Inserir os Documentos. Tente novamente mais tarde." );

        }
    }

    public function download_termo_aluno($fileName) {
        $path = "termo_alunos/".$fileName;

        if(Storage::exists($path)) {
            return Storage::download($path);
        } else {
            return redirect()->back()->with('falha', 'Arquivo não encontrado.');
        }
    }

    public function download_termo_orientador($fileName) {
        $path = "termo_orientadors/".$fileName;

        if(Storage::exists($path)) {
            return Storage::download($path);
        } else {
            return redirect()->back()->with('falha', 'Arquivo não encontrado.');
        }
    }

    public function download_historico_escolares_alunos($fileName) {
        $path = "historicos_escolares_alunos/".$fileName;
        
        if(Storage::exists($path)) {
            return Storage::download($path);
        } else {
            return redirect()->back()->with('falha', 'Arquivo não encontrado.');
        }
    }

    public function download_comprovante_bancario($fileName) {
        $path = "comprovantes_bancarios/".$fileName;

        if(Storage::exists($path)) {
            return Storage::download($path);
        } else {
            return redirect()->back()->with('falha', 'Arquivo não encontrado.');
        }
    }

}
