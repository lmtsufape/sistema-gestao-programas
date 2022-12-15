<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProgramaFormRequest;
use App\Models\Programa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class ProgramaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (sizeof($request-> query()) > 0){
            $campo = $request->query('campo');
            $valor = $request->query('valor');

            if ($valor == null){
                return redirect()->back()->withErrors( "Deve ser informado algum valor para o filtro." );
            }

            $programas = Programa::join("users", "users.typage_id", "=", "programas.id")->join("programas.id");
            $programas = $programas->where(function ($query) use ($valor) {
                if ($valor) {
                    $query->orWhere("users.name", "LIKE", "%{$valor}%");
                    $query->orWhere("users.email", "LIKE", "%{$valor}%");
                    $query->orWhere("programas.nome", "LIKE", "%{$valor}%");
                }
            })->orderBy('programas.created_at', 'desc')->select("programas.*")->get();


            return view("Programas.index", compact("programas"));
        } else {
            $programas = Programa::all();
            return view("Programa.index", compact("programas"));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $programa = Programa::find($id);
        //return view("Programa.components.modal_edit", compact('programa'));
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

    public function delete($id) 
    {
        $programa = Programa::findOrFail($id);
        return view('programas.delete');
    }

    public function destroy(Request $request)
    {
        $id = $request->only(['id']);
        $programa = Programa::findOrFail($id)->first();

        if ($programa->delete()) {
            return redirect(route("programas.index"));
        }
    }
}
