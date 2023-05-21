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
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Exception;

class ServidorController extends Controller {

    public function index(Request $request)
    {
            $servidores = Servidor::all();
            return view("servidores.index", compact("servidores"));
    }


    public function create(){
        $servidor = Servidor::all();
        return view("servidores.cadastrar", compact("servidor"));
    }

    public function store(ServidorFormRequest $request)
    {

        try{
            switch($request->input('tipo_servidor')){
                case 0:
                $permission = "adm";
                    break;
                case 1:
                    $permission = "pro_reitor";
                    break;
                case 2:
                    $permission = "servidor";
                    break;
            };

            $servidor = Servidor::Create([
                'cpf' => $request->input('cpf'),
                'tipo_servidor' => $permission,
                'instituicaoVinculo' => $request->input('instituicaoVinculo'),
                'matricula' => $request->input('matricula')
            ]);

            if(
                $servidor->user()->create([
                    'name' => $request->input('nome'),
                    'email' => $request->input('email'),
                    'password' => Hash::make($request->input('senha'))
                ])->givePermissionTo($permission)
            ){
                #$mensagem_sucesso = "Orientador cadastrado com sucesso.";


                return redirect('/servidores')->with('sucesso', 'Servidor cadastrado com sucesso.');

            } else {
                return redirect()->back()->withErrors( "Falha ao cadastrar servidor. tente novamente mais tarde." );
            }
        } catch (Exception $e) {
            return redirect()->back()->withErrors("Falha ao cadastrar servidor. Tente novamente mais tarde.");
        }
    }

    public function edit($id)
    {
        $servidor = Servidor::find($id);
        $servidores = Servidor::all();

        #$tipo_servidors = User::where('typage_id', Auth::user()->typage_id)->get();
        return view("servidores.editar", compact('servidor', 'servidores'));
    }

    public function update(ServidorFormUpdateRequest $request, $id)
    {
        try{
            $servidor = Servidor::find($id);

            switch($request->input('tipo_servidor')){
                case 0:
                $permission = "adm";
                    break;
                case 1:
                    $permission = "pro_reitor";
                    break;
                case 2:
                    $permission = "servidor";
                    break;
            };
            $servidor->cpf = $request->cpf == $servidor->cpf ? $servidor->cpf : $request->cpf;
            $servidor->tipo_servidor = $permission == $servidor->tipo_servidor ? $servidor->tipo_servidor : $permission;
        $servidor->user->name_social = $request->nome_social;
            $servidor->user->name = $request->nome;
            $servidor->user->email = $request->email;
            if ($request->senha && $request->senha != null){
                if (strlen($request->senha) > 7 && strlen($request->senha) < 31){
                    $servidor->user->password = Hash::make($request->password);
                } else {
                    return redirect()->back()->withErrors( "Senha deve ter entre 8 e 30 dígitos" );
                }
            }

            if ($servidor->save()){

                if ($servidor->user->update()){
                    $mensagem_sucesso = "Servidor editado com sucesso.";
                    return redirect("/servidores")->with('sucesso', 'Servidor editado com sucesso.');
                } else {
                    return redirect()->back()->withErrors( "Falha ao editar servidor. tente novamente mais tarde." );
                }

            } else {
                return redirect()->back()->withErrors( "Falha ao editar servidor. tente novamente mais tarde." );
            }
        } catch (Exception $e) {
            return redirect()->back()->withErrors("Falha ao editar servidor. Tente novamente mais tarde.");
        }
    }

    public function delete($id)
    {
        $servidor = Servidor::findOrFail($id);
        return view('servidores.delete', ['servidor' => $servidor]);
    }

    public function destroy(Request $request)
    {
        try{
            $id = $request->only(['id']);
            $servidor = Servidor::findOrFail($id)->first();

            if ($servidor->delete()) {
                return redirect(route("servidores.index"));
            }
        } catch (Exception $e) {
            return redirect()->back()->withErrors("Falha ao deletar servidor. Tente novamente mais tarde.");
        }
    }

    // Criado para visualizar a tela de editar servidor
    public function editar(){
        return view('servidores.editar');
    }

    public function adicionar_permissao($id, AdicionarPermissaoFormRequest $request) {
        try{
            $servidor = Servidor::find($id);

            DB::beginTransaction();

            DB::table('model_has_permissions')->where('model_id', $servidor->user->id)->delete();

            $servidor->user->givePermissionTo($request->permissao);

            DB::commit();
            return redirect("/servidores")->with('sucesso', 'Permissão adicionada com sucesso.');

        } catch(exception $e){
            DB::rollback();
            return redirect()->back()->withErrors( "Falha ao adicionar permissao. tente novamente mais tarde." );
        }
    }

    public function profile(Request $request)
    {
        $id = $request->user()->typage_id; // Obtém o ID do usuário autenticado
        // $user = $request->user(); // Obtém o usuário autenticado

        // dd($user);

        $servidor = Servidor::find($id);

        // dd($servidor);

        return view('Perfil.meu-perfil-servidor', ['servidor' => $servidor]);
    }

    // public function profile(){
    //     $servidor = Auth::id();
    //     return view('Perfil.meu-perfil-servidor', compact('servidor'));
    // }
}
