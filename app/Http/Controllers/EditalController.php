<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Edital;
use App\Models\Curso;
use App\Models\Aluno;
use App\Models\Disciplina;
use App\Models\Programa;
use App\Models\Orientador;
use App\Models\Edital_Aluno;
use App\Http\Requests\EditalStoreFormRequest;
use App\Http\Requests\EditalUpdateFormRequest;
use Exception;

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
        
        $cursos = Curso::all();
        return view("Edital.cadastrar", compact("programas", "cursos"));
    }

    public function store(editalstoreFormRequest $request)
    {
        DB::beginTransaction();
        try{
            
            // dd($request);
            $edital = new Edital();
            $edital->nome = $request->nome;
            $edital->descricao = $request->descricao;
            $edital->semestre = $request->semestre;
            $edital->data_inicio = $request->data_inicio;
            $edital->data_fim = $request->data_fim;
            $edital->curso_id = $request->curso;
            $edital->programa_id = $request->programa;
            //$edital ->disciplina_id = $request ->disciplina;
            //dd($edital);
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

        return view('Edital.show', ['edital' => $edital]);
    }

    public function inscrever_aluno(Request $request, $id) {

        $edital = Edital::find($id);
        $aluno = Aluno::where('cpf', $request->cpf)->with('user')->first();
        $data = [
            'nome_aluno' => $aluno->user->name,
            'titulo_edital' => $edital->nome,
            'data_inicio' => $edital->data_inicio,
            'data_fim' => $edital->data_fim,
            'valor_bolsa' => $request->valor_bolsa,
            'bolsa' => $request->bolsa,
            'info_complementares' => $request->info_complementares,
            'disciplina_id' => 1
        ];
        $edital->alunos()->syncWithoutDetaching([$aluno->id => $data]);

        return redirect()->back()->with('success', 'O aluno foi inscrito com sucesso no edital.');
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
        //dd($edital);
        $programas = Programa::all();
        
        return view("Edital.editar", compact("edital", "programas"));
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

            $edital->nome = $request->nome ? $request->nome : $edital->nome;
            $edital->descricao = $request->descricao ? $request->descricao : $edital->descricao;
            $edital->semestre = $request->semestre ? $request->semestre : $edital->semestre;
            $edital->data_inicio = $request->data_inicio ? $request->data_inicio : $edital->data_inicio;
            $edital->data_fim = $request->data_fim ? $request->data_fim : $edital->data_fim;
            $edital->programa_id = $request->programa ? $request->programa : $edital->programa_id;
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
            //verifica a página de origem da solicitação
            /*$referer = request()->headers->get('referer');
            //dd($referer);
            //o método strpos para verificar se a string /programas/ está presente no cabeçalho Referer.
            if(strpos($referer, '/programas/editais') !== false)
            {
                return redirect('/programas/editais')->with('Edital deletado com sucesso');
            }
            else 
            {
                return redirect()->route('edital.index')
                ->with('sucesso', 'Edital deletado com sucesso.');
            }*/

            return redirect()->route('edital.index')->with('sucesso', 'Edital deletado com sucesso.');

        } catch(exception $e){
            DB::rollback();
            return redirect()->back()->withErrors( "Falha ao editar Edital. tente novamente mais tarde." );
        }
    }
    public function listar_alunos($id){
        $edital = Edital::with('alunos')->find($id);
        $alunos = $edital->alunos('user');
        $alunos = $edital->alunos;
        // foreach ($alunos as $aluno) {
        //     echo $aluno->pivot->nome_aluno;
        //     echo '\n';
        //     echo $aluno->pivot->data_inicio;
        //     dd($aluno);
        // }

        return view("Edital.listar_alunos", compact("alunos"));
        }
}
