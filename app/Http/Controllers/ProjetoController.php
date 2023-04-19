<?php

namespace App\Http\Controllers;

use App\Models\Aluno;
use Illuminate\Http\Request;
use App\Models\Projeto;
use PhpParser\Node\Stmt\TraitUseAdaptation\Alias;

class ProjetoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projetos = Projeto::all();
        //dd($projetos);
        return view('Projeto.index', compact('projetos'), ['projetos' => $projetos]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {      
        $alunos = Aluno::all();
        //dd($alunos);

        return view("Projeto.cadastrar", ['alunos' => $alunos]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $projeto = new Projeto;
        $projeto->bolsista = $request->bolsista;
        $projeto->valorBolsa = $request->valorBolsa;
        
        $aluno_id = $request->aluno_id;
        //dd($aluno_id);

        $projeto->save();
        
       $projeto->alunos()->attach($aluno_id);
       dd($projeto);
        // $projeto_id = Projeto::find('projeto');
        redirect('Projeto.index', compact('projetos'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view("Projeto.editar", compact('projeto'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
