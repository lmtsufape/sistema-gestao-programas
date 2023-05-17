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
            ]);
            $fileName = "";

            if($request->hasFile('termo_compromisso_aluno') && $request->file('termo_compromisso_aluno')->isValid()) {
                $fileName = "termo_compromisso_aluno_". $aluno->nome_aluno . "_" . $aluno->id . $edital->id  . now() . '.' . $request->termo_compromisso_aluno->extension();
                //dd($extensao);
                $request->termo_compromisso_aluno->storeAs('termo_compromisso_alunos/', $fileName);
            }
            //dd($fileName);

            if($edital->alunos()->wherePivot('aluno_id', $aluno->id)->exists()) {
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
                    'termo_compromisso_orientador' => "confie no orientador",
                    'disciplina_id' => $edital->disciplina_id,
                    'edital_id' => $edital->id,
                    'aluno_id' => $aluno->id,
                    'orientador_id' => $orientador_id,
                ];
                //if ($)
                $data['termo_compromisso_aluno'] = $fileName;
                // dd($data);
                $editalAlunoOrientador = EditalAlunoOrientadors::create($data);

                DB::commit();
                 return redirect()->route('edital.vinculo', ['id' => $edital->id])->with('success', 'O aluno foi inscrito com sucesso no edital.');
           }
       } catch(exception $e){
            DB::rollback();
            return redirect()->back()->withErrors( "Falha ao cadastrar aluno ao edital." );
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
        $alunos = $edital->alunos('user');
        $alunos = $edital->alunos;

        return view("Edital.listar_alunos", compact("alunos"));
    }

    public function listar_disciplinas($id){
        $disciplinas = Edital::with('disciplinas')->find($id);

        return view("Edital.listar_disciplinas", compact("disciplinas"));
    }

    /**
     * Display the specified resource.
     *
     */
    public function download_termo_compromisso_aluno($fileName) {


        //dd($fileName);
        //$a = EditalAlunoOrientadors::find($fileName);
        //dd($a);

        $path = 'termo_compromisso_alunos/' . $fileName;
        //dd($aluno);
        if(Storage::exists($path)) {
            return Storage::download($path);
        } else {
            return redirect()->back()->with('fail', 'Arquivo PDF não encontrado.');
        }
     }
}

