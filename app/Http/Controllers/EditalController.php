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

use Exception;
use Illuminate\Support\Facades\Storage;
use PhpParser\Node\Stmt\TryCatch;

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
    $cpfs = Aluno::select('cpf', 'nome')->get();

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
        DB::beginTransaction();
        try {

            //dd($request);
            $edital = new Edital();
            $edital->descricao = $request->descricao;
            $edital->semestre = $request->semestre;
            $edital->data_inicio = $request->data_inicio;
            $edital->data_fim = $request->data_fim;
            $edital->titulo_edital = $request->titulo_edital;
            $edital->valor_bolsa = $request->valor_bolsa;
            $edital->disciplina_id = $request->disciplina;
            $edital->programa_id = $request->programa;
            $edital ->disciplina_id = $request ->disciplina;
            $edital->save();

            DB::commit();

            return redirect('/edital')->with('sucesso', 'Edital cadastrado com sucesso.');

        } catch(exception $e){
            DB::rollback();
            return redirect()->back()->withErrors( "Falha ao cadastrar Edital. tente novamente mais tarde." );
        }
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
            $orientador_id = (int)$request->orientador;

            //dd($edital);
            $request->validate([
                'termo_compromisso_aluno' => 'required|mimes:pdf|max:2048',
                'termo_compromisso_orientador' => 'required|mimes:pdf|max:2048',
            ]);
            $termo_aluno = "";
            $termo_orientador = "";
            //dd($aluno);
            if($request->hasFile('termo_compromisso_aluno') && $request->file('termo_compromisso_aluno')->isValid()
                && $request->hasFile('termo_compromisso_orientador') && $request->file('termo_compromisso_orientador')->isValid()) {
                $termo_aluno = "termo_compromisso_aluno_". $aluno->nome_aluno . "_" . $aluno->id . $edital->id  . now() . '.' . $request->termo_compromisso_aluno->extension();
                $termo_orientador = "termo_compromisso_orientador_" . $orientador_id . $edital->id  . now() . '.' . $request->termo_compromisso_orientador->extension();
                //dd($extensao);
                $request->termo_compromisso_aluno->storeAs('termo_compromisso_alunos/', $termo_aluno);
                $request->termo_compromisso_orientador->storeAs('termo_compromisso_orientadores/', $termo_orientador);

            }
            //dd($termo_aluno);

            if($edital->alunos()->wherePivot('aluno_id', $aluno->id)->exists()) {

                // dd($edital);
                return redirect()->route('edital.vinculo', ['id' => $edital->id])->with('fail', 'O aluno já está cadastrado no edital.');
            } else {
                $data = [
                    'titulo' => $edital->titulo_edital,
                    'data_inicio' => $edital->data_inicio,
                    'data_fim' => $edital->data_fim,
                    'bolsa' => $request->bolsa,
                    'bolsista' => true,
                    'plano_projeto' => "plano de projeto",
                    'info_complementares' => $request->info_complementares,
                    'termo_compromisso_orientador' => $termo_orientador,
                    'disciplina_id' => $edital->disciplina_id,
                    'edital_id' => $edital->id,
                    'aluno_id' => $aluno->id,
                    'orientador_id' => $orientador_id,
                ];
                $data['termo_compromisso_aluno'] = $termo_aluno;
                //dd($data);
                $editalAlunoOrientador = EditalAlunoOrientadors::create($data);

                DB::commit();
                 return redirect()->route('edital.vinculo', ['id' => $edital->id])->with('success', 'O aluno foi inscrito com sucesso no edital.');
           }
        } catch(exception $e){
             DB::rollback();
             return redirect()->back()->withErrors( "Falha ao cadastrar aluno ao edital." );
         }
    }

    public function editar_vinculo($id){
        $vinculo = EditalAlunoOrientadors::find($id);
        $aluno = Aluno::find($vinculo->aluno_id);
        $edital = Edital::find($vinculo->edital_id);
        
        //dd($vinculo);
        $orientadores = Orientador::all();
        //$vinculo = EditalAlunoOrientadors::find($id)
        return view("Edital.editar_vinculo", compact('aluno','edital','orientadores', 'vinculo'));
    }

    public function update_vinculo(Request $request, $id){
        //DB::beginTransaction();
        //try{
        //DB::beginTransaction();
        //try { 
            //dd($id);
            //$edital_id = EditalAlunoOrientadors::find($request->$edital_id);
            //dd($request);
            //$edital = EditalAlunoOrientadors::find($aluno);
            $vinculo = EditalAlunoOrientadors::find($id);

            $vinculo->bolsa = $request->bolsa ? $request->bolsa : $vinculo->bolsa;
            $vinculo->bolsista = $request->bolsista == "True" ? $request->bolsista == "True" : $vinculo->bolsista;
            //$edital->aluno_id = $request->aluno ? $request->aluno : $edital->aluno_id;
            //$edital->orientador_id = $request->orientador ? $request->orientador : $edital->orientador_id;
            $vinculo->info_complementares= $request->info_complementares ? $request->info_complementares : $vinculo->info_complementares;
            $vinculo->termo_compromisso_orientador= $request->termo_orientador ? $request->termo_orientador: $vinculo->termo_orientador;
            $vinculo->termo_compromisso_aluno= $request->termo_aluno ? $request->termo_aluno: $vinculo->termo_aluno;
            $vinculo->update();
            
            if ($request->validate){[
                'termo_compromisso_aluno' => 'required|mimes:pdf|max:2048',
                'termo_compromisso_orientador' => 'required|mimes:pdf|max:2048',
                ];
                $termo_aluno = "";
                $termo_orientador = "";
            }
            
            if($request->hasFile('termo_compromisso_aluno') && $request->file('termo_compromisso_aluno')->isValid()
                        && $request->hasFile('termo_compromisso_orientador') && $request->file('termo_compromisso_orientador')->isValid()) {
                        $aluno = Aluno::find($vinculo->aluno_id);
                        $edital = Edital::find($vinculo->edital_id);
                        $orientador_id = Orientador::find($vinculo->orientador_id)->id;
                        $termo_aluno = "termo_compromisso_aluno_". $aluno->nome_aluno . "_" . $aluno->id . $edital->id  . now() . '.' . $request->termo_compromisso_aluno->extension();
                        $termo_orientador = "termo_compromisso_orientador_" . $orientador_id . $edital->id  . now() . '.' . $request->termo_compromisso_orientador->extension();
                        $request->termo_compromisso_aluno->storeAs('termo_compromisso_alunos/', $termo_aluno);
                        $request->termo_compromisso_orientador->storeAs('termo_compromisso_orientadores/', $termo_orientador);

            }

                //DB::commit();
                // return redirect()->route('edital.vinculo', ['id' => $edital->id])->with('success', 'O aluno foi inscrito com sucesso no edital.');
           
        //} catch(exception $e){
             //DB::rollback();
             //return redirect()->back()->withErrors( "Falha ao cadastrar aluno ao edital." );
         //}
        
    }

    
    public function deletar_vinculo($id){
        EditalAlunoOrientadors::find($id)->delete();
        //DB::beginTransaction();
        //try{
        //$aluno = Aluno::findOrFail($Aluno_id); 
        //$editalAlunoOrientador = EditalAlunoOrientadors::where('aluno_id', $Aluno_id)->delete();

        //DB::commit();
        //return redirect()->route('edital.vinculo')->with('success', 'O aluno foi excluído com sucesso.');

        //} catch(Exception $e) {
        //DB::rollback();
        //return redirect()->back()->withErrors("Falha ao excluir aluno.");
        //}

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

        return view("Edital.editar", compact("edital", "programas", "disciplinas"));
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


            $edital->descricao = $request->descricao ? $request->descricao : $edital->descricao;
            $edital->semestre = $request->semestre ? $request->semestre : $edital->semestre;
            $edital->titulo_edital = $request->titulo_edital ? $request->titulo_edital : $edital->titulo_edital;
            $edital->valor_bolsa = $request->valor_bolsa ? $request->valor_bolsa : $edital->valor_bolsa;
            $edital->data_inicio = $request->data_inicio ? $request->data_inicio : $edital->data_inicio;
            $edital->data_fim = $request->data_fim ? $request->data_fim : $edital->data_fim;
            $edital->programa_id = $request->programa ? $request->programa : $edital->programa_id;
            $edital->disciplina_id = $request->disciplina ? $request->disciplina : $edital->disciplina_id;
            $edital->update();
            //dd($edital);

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
        DB::beginTransaction();
        try{

            Edital::where("id", $id)->delete();

            DB::commit();

            return redirect()->route('programas.index')->with('sucesso', 'Edital deletado com sucesso.');

        } catch(exception $e){
            DB::rollback();
            return redirect()->back()->withErrors( "Falha ao editar Edital. tente novamente mais tarde." );
        }
    }
    public function listar_alunos($id){
        $edital = Edital::with('alunos')->find($id);
        $alunos = $edital->alunos->map(function($aluno) {
                return [
                    'vinculo' => EditalAlunoOrientadors::where('aluno_id', $aluno->id)->where('edital_id', $aluno->pivot->edital_id)->first()->id,
                    'aluno' => $aluno,
                ];
        });
        return view("Edital.listar_alunos", compact("alunos"));
    }
/*
public function getCpfs() {
    $cpfs = Aluno::select('cpf', 'nome')->get();

    $data = $cpfs->map(function ($item) {
        return [
            'cpf' => $item->cpf,
            'nome' => $item->nome_aluno,
        ];
    }); */
    public function listar_disciplinas($id){
        $disciplinas = Edital::with('disciplinas')->find($id);

        return view("Edital.listar_disciplinas", compact("disciplinas"));
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
            return redirect()->back()->with('fail', 'Arquivo PDF não encontrado.');
        }
     }

     public function download_termo_compromisso_orientador($fileName) {

       $path = 'termo_compromisso_orientadores/' . $fileName;

        if(Storage::exists($path)) {
            return Storage::download($path);
        } else {
            return redirect()->back()->with('fail', 'Arquivo PDF não encontrado.');
        }
     }
}