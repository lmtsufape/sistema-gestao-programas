<?php

namespace App\Http\Controllers;

use App\Models\Servidor;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ServidorController extends Controller
{

    public function index()
    {
        $servidores = Servidor::all();
        return view("servidores.index", compact('servidores'));
    }

    public function store(Request $request)
    {

        Validator::make($request->all(), array_merge(Servidor::$rules, User::$rules), array_merge(Servidor::$messages, User::$messages))->validateWithBag('create');

        $servidor = Servidor::Create([
            'cpf' => $request->input('cpf'),
            'setor' => $request->input('setor')
        ]);

        $servidor->user()->create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password'))
        ])->givePermissionTo('servidor');

        return redirect(route("servidores.index"));
    }

    public function update(Request $request)
    {
        $servidor = Servidor::find($request->id);

        $rulesUser = User::$rules;
        $rulesUser['email'] = [
            'bail', 'required', 'email', 'max:100',
            Rule::unique('users')->ignore($servidor->user->id)
        ];

        $rulesServidor = Servidor::$rules;
        $rulesServidor['cpf'] = [
            'bail', 'required', 'formato_cpf', 'cpf', 'unique:professors', 'unique:alunos',
            Rule::unique('servidors')->ignore($servidor->id)
        ];

        Validator::make($request->all(), array_merge($rulesServidor, $rulesUser), array_merge(Servidor::$messages, User::$messages))->validateWithBag('update');

        $servidor->cpf = $request->cpf;
        $servidor->setor = $request->setor;

        $servidor->user->name = $request->name;
        $servidor->user->email = $request->email;
        $servidor->user->password = Hash::make($request->password);

        if ($servidor->save() && $servidor->user->save()) {
            return redirect(route("servidores.index"));
        }
    }

    public function destroy(Request $request)
    {

        $id = $request->only(['id']);
        $servidor = Servidor::find($id)->first();

        if ($servidor->user->delete() && $servidor->delete()) {
            return redirect(route("servidores.index"));
        }
    }
}
