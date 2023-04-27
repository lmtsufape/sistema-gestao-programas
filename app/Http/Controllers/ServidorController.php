<?php

namespace App\Http\Controllers;

use App\Http\Requests\ServidorFormRequest;
use App\Http\Requests\ServidorFormUpdateRequest;
use App\Http\Requests\AdicionarPermissaoFormRequest;
use App\Models\Servidor;
use App\Models\Tipo_servidor;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;

class ServidorController extends Controller
{

    public function index(Request $request)
    {
        $permissoes = DB::select('select * from permissions');

        if (sizeof($request-> query()) > 0){
            $campo = $request->query('campo');
            $valor = $request->query('valor');

            if ($valor == null){
                return redirect()->back()->withErrors( "Deve ser informado algum valor para o filtro." );
            }

            $servidors = Servidor::join("users", "users.typage_id", "=", "servidors.id");
            $servidors = $servidors->where(function ($query) use ($valor) {
                if ($valor) {
                    $query->orWhere("users.name", "LIKE", "%{$valor}%");
                    $query->orWhere("users.email", "LIKE", "%{$valor}%");
                    $query->orWhere("servidors.cpf", "LIKE", "%{$valor}%");
                    //$query->orWhere("servidors.tipo_servidor_id", "LIKE", "%{$valor}%");
                }
            })->orderBy('servidors.created_at', 'desc')->select("servidors.*")->get();

            return view("servidors.index", compact("servidors", "permissoes"));
        } else {
            $servidors = Servidor::all();
            return view("servidors.index", compact("servidors", "permissoes"));
        }
    }


    public function create(){
        $tipo_servidors = Tipo_servidor::all();
        return view("servidors.cadastrar", compact("tipo_servidors"));
    }

    public function store(ServidorFormRequest $request)
    {
        $servidor = Servidor::Create([
            'cpf' => $request->input('cpf'),
           
        ]);

        if(
            $servidor->user()->create([
                'name' => $request->input('nome'),
                'email' => $request->input('email'),
                'password' => Hash::make($request->input('senha'))
            ])->givePermissionTo('servidor')
        ){
            $mensagem_sucesso = "Orientador cadastrado com sucesso.";


            return redirect('/servidores')->with('sucesso', 'Servidor cadastrado com sucesso.');

        } else {
            return redirect()->back()->withErrors( "Falha ao cadastrar servidor. tente novamente mais tarde." );
        }
    }

    public function edit($id)
    {
        $servidor = Servidor::find($id);
        $tipo_servidors = Tipo_servidor::all();
        return view("servidors.editar", compact('servidor', 'tipo_servidors'));
    }

    public function update(ServidorFormUpdateRequest $request, $id)
    {
        $servidor = Servidor::find($id);

        $servidor->cpf = $request->cpf == $servidor->cpf ? $servidor->cpf : $request->cpf;

        $servidor->user->name = $request->nome;
        $servidor->user->email = $request->email;
        if ($request->senha && $request->senha != null){
            if (strlen($request->senha) > 3 && strlen($request->senha) < 9){
                $servidor->user->password = Hash::make($request->password);
            } else {
                return redirect()->back()->withErrors( "Senha deve ter entre 4 e 8 dígitos" );
            }
        }

        if ($servidor->save()){

            if ($servidor->user->update()){
                $mensagem_sucesso = "Servidor editado com sucesso.";
                return redirect("/servidors")->with('sucesso', 'Servidor editado com sucesso.');
            } else {
                return redirect()->back()->withErrors( "Falha ao editar servidor. tente novamente mais tarde." );
            }

        } else {
            return redirect()->back()->withErrors( "Falha ao editar servidor. tente novamente mais tarde." );
        }
    }

    public function delete($id)
    {
        $servidor = Servidor::findOrFail($id);
        return view('servidors.delete', ['servidor' => $servidor]);
    }

    public function destroy(Request $request)
    {
        $id = $request->only(['id']);
        $servidor = Servidor::findOrFail($id)->first();

        if ($servidor->delete()) {
            return redirect(route("servidors.index"));
        }
    }

    // Criado para visualizar a tela de editar servidor
    public function editar(){
        return view('servidors.editar');
    }

    public function adicionar_permissao($id, AdicionarPermissaoFormRequest $request) {
        try{
            $servidor = Servidor::find($id);

            DB::beginTransaction();

            DB::table('model_has_permissions')->where('model_id', $servidor->user->id)->delete();

            $servidor->user->givePermissionTo($request->permissao);

            DB::commit();
            return redirect("/servidors")->with('sucesso', 'Permissão adicionada com sucesso.');

        } catch(exception $e){
            DB::rollback();
            return redirect()->back()->withErrors( "Falha ao adicionar permissao. tente novamente mais tarde." );
        }
    }
}
