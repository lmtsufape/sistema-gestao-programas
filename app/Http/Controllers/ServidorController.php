<?php

namespace App\Http\Controllers;

use App\Http\Requests\ServidorFormRequest;
use App\Http\Requests\ServidorFormUpdateRequest;
use App\Models\Servidor;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ServidorController extends Controller
{

    public function index()
    {

        $servidores = Servidor::all();
        return view("servidores.index", compact('servidores'));
    }


    public function create(){
        return view("servidores.cadastrar");
    }

    public function store(ServidorFormRequest $request)
    {

        $servidor = Servidor::Create([
            'cpf' => $request->input('cpf'),
            'tipo_servidor' => $request->input('tipo_servidor')
        ]);
 
        if(
            $servidor->user()->create([
                'name' => $request->input('nome'),
                'email' => $request->input('email'),
                'password' => Hash::make($request->input('senha'))
            ])->givePermissionTo('servidor')
        ){
            $mensagem_sucesso = "Orientador cadastrado com sucesso.";
            return redirect('/servidores/create')->with('sucesso', 'Servidor cadastrado com sucesso.');

        } else {
            return redirect()->back()->withErrors( "Falha ao cadastrar servidor. tente novamente mais tarde." );
        }
    }

    public function edit($id)
    {
        $servidor = Servidor::find($id);
        return view("servidores.editar", compact('servidor'));
    }

    public function update(ServidorFormUpdateRequest $request, $id)
    {
        $servidor = Servidor::find($id);
        
        $servidor->cpf = $request->cpf == $servidor->cpf ? $servidor->cpf : $request->cpf;
        $servidor->tipo_servidor = $request->tipo_servidor;

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
                $mensagem_sucesso = "Orientador cadastrado com sucesso.";
                return redirect('/servidores/'. $servidor->id .'/edit')->with('sucesso', 'Servidor Atualizado com sucesso.');
            } else {
                return redirect()->back()->withErrors( "Falha ao cadastrar orientador. tente novamente mais tarde." );
            }

        } else {
            return redirect()->back()->withErrors( "Falha ao cadastrar orientador. tente novamente mais tarde." );
        }
    }

    public function delete($id)
    {
        $servidor = Servidor::findOrFail($id);
        return view('servidores.delete', ['servidor' => $servidor]);
    }

    public function destroy(Request $request)
    {
        $id = $request->only(['id']);
        $servidor = Servidor::findOrFail($id)->first();

        if ($servidor->delete()) {
            return redirect(route("servidores.index"));
        }
    }

    // Criado para visualizar a tela de editar servidor
    public function editar(){
        return view('servidores.editar');
    }
}
