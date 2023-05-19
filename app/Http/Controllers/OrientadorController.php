<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrientadorFormRequest;
use App\Http\Requests\OrientadorFormUpdateRequest;
use App\Models\Orientador;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Exception;

class OrientadorController extends Controller
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

            $orientadors = Orientador::join("users", "users.typage_id", "=", "orientadors.id");
            $orientadors = $orientadors->where(function ($query) use ($valor) {
                if ($valor) {
                    $query->orWhere("users.name", "LIKE", "%{$valor}%");
                    $query->orWhere("users.email", "LIKE", "%{$valor}%");
                    $query->orWhere("orientadors.cpf", "LIKE", "%{$valor}%");
                    $query->orWhere("orientadors.matricula", "LIKE", "%{$valor}%");
                }
            })->orderBy('orientadors.created_at', 'desc')->select("orientadors.*")->get();


            return view("Orientador.index", compact("orientadors"));
        } else {
            $orientadors = Orientador::all();
            return view("Orientador.index", compact("orientadors"));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("Orientador.cadastrar");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OrientadorFormRequest $request)
    {
        try{
            $orientador = new Orientador();
            $orientador->cpf = $request->cpf;
            $orientador->matricula = $request->matricula;

            if ($orientador->save()){

                if (
                    $orientador->user()->create([
                        'name' => $request->nome,
                        'email' => $request->email,
                        'password' => Hash::make($request->senha)

                    ])->givePermissionTo('orientador')
                ){
                    $confirm = new ConfirmandoEmail($request);
                    $confirm -> enviandoEmail();
                    $mensagem_sucesso = "Orientador cadastrado com sucesso.";
                    return redirect('/orientadors/create')->with('sucesso', 'Orientador cadastrado com sucesso.');

                } else {
                    return redirect()->back()->withErrors( "Falha ao cadastrar orientador. tente novamente mais tarde." );
                }
            }else{
                return redirect()->back()->withErrors( "Falha ao cadastrar orientador. tente novamente mais tarde." );
            }
        } catch (Exception $e) {
            return redirect()->back()->withErrors("Falha ao cadastrar orientador. Tente novamente mais tarde.");
        }
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
        $orientador = Orientador::find($id);
        return view("Orientador.editar-orientador", compact('orientador'));
    }

    public function update(OrientadorFormUpdateRequest $request, $id)
    {
        try{
            $orientador = Orientador::find($id);

            $orientador->cpf = $request->cpf == $orientador->cpf ? $orientador->cpf : $request->cpf;
            $orientador->matricula = $request->matricula;

            $orientador->user->name = $request->nome;
            $orientador->user->email = $request->email;
            if ($request->senha && $request->senha != null){
                if (strlen($request->senha) > 3 && strlen($request->senha) < 9){
                    $orientador->user->password = Hash::make($request->password);
                } else {
                    return redirect()->back()->withErrors( "Senha deve ter entre 4 e 8 dígitos" );
                }
            }
            if ($orientador->save()){

                if ($orientador->user->update()){
                    $mensagem_sucesso = "Orientador cadastrado com sucesso.";
                    return redirect('/orientadors/'. $orientador->id .'/edit')->with('sucesso', 'Orientador Atualizado com sucesso.');
                } else {
                    return redirect()->back()->withErrors( "Falha ao editar orientador. tente novamente mais tarde." );
                }

            } else {
                return redirect()->back()->withErrors( "Falha ao editar orientador. tente novamente mais tarde." );
            }
        } catch (Exception $e) {
            return redirect()->back()->withErrors("Falha ao editar orientador. Tente novamente mais tarde.");
        }
    }


    public function delete($id)
    {
        $orientador = Orientador::findOrFail($id);
        return view('orientadors.delete', ['orientador' => $orientador]);
    }

    public function destroy(Request $request)
    {
        try{
            $id = $request->only(['id']);
            $orientador = Orientador::findOrFail($id)->first();

            if ($orientador->user->delete() && $orientador->delete()) {
                return redirect(route("orientadors.index"));
            }
        } catch (Exception $e) {
            return redirect()->back()->withErrors("Falha ao deletar orientador. Tente novamente mais tarde.");
        }
    }

    public function profile(Request $request)
    {
        $id = $request->user()->typage_id; // Obtém o ID do usuário autenticado
       // $user = $request->user(); // Obtém o usuário autenticado

        //dd($user);

        $orientador = Orientador::find($id);

        // dd($orientador);

        return view('Perfil.meu-perfil-orientador', ['orientador' => $orientador]);
    }
}
