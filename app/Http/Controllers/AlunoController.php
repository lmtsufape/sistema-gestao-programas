<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Aluno;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class AlunoController extends Controller
{
    public function store(Request $request)
    {

        Validator::make($request->all(), array_merge(Aluno::$rules, User::$rules), array_merge(Aluno::$messages, User::$messages))->validateWithBag('create');

        $aluno = Aluno::create([
            'cpf' => $request->input('cpf'),
            'curso' => $request->input('curso'),
            'semestre_entrada' => $request->input('semestre_entrada')
        ]);

        $aluno->user()->create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password'))
        ])->givePermissionTo('aluno');

        return redirect(route("alunos.index"));
    }

    public function criar_aluno(Request $request)
    {
        $validacao = $request->validate(
            [
                'name' => ['required'],
                'cpf' => ['required'],
                'email' => ['required'],
                'semestre_entrada' => ['required'],
                'curso' => ['required'],
                'password' => ['required']
            ],
            [
                'required' => 'O campo :attribute é obrigatório.'
            ]
        );

        $aluno = Aluno::create([
            'cpf' => $request->input('cpf'),
            'curso' => $request->input('curso'),
            'semestre_entrada' => $request->input('semestre_entrada')
        ]);

        $aluno->user()->create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password'))
        ])->givePermissionTo('aluno');

        return redirect(url("/login"));
    }

    public function update(Request $request)
    {
        $aluno = Aluno::find($request->id);

        $rulesUser = User::$rules;
        $rulesUser['email'] = [
            'bail', 'required', 'email', 'max:100',
            Rule::unique('users')->ignore($aluno->user->id)
        ];

        $rulesAluno = Aluno::$rules;
        $rulesAluno['cpf'] = [
            'bail', 'required', 'formato_cpf', 'cpf', 'unique:servidors', 'unique:professors',
            Rule::unique('alunos')->ignore($aluno->id)
        ];

        Validator::make($request->all(), array_merge($rulesAluno, $rulesUser), array_merge(Aluno::$messages, User::$messages))->validateWithBag('update');

        $aluno->cpf = $request->cpf;
        $aluno->curso = $request->curso;
        $aluno->semestre_entrada = $request->semestre_entrada;


        $aluno->user->name = $request->name;
        $aluno->user->email = $request->email;
        $aluno->user->password = Hash::make($request->password);

        if ($aluno->save() && $aluno->user->save()) {
            return redirect(route("alunos.index"));
        }
    }

    public function delete($id)
    {
        $aluno = Aluno::findOrFail($id);
        return view('alunos.delete', ['aluno' => $aluno]);
    }

    public function destroy(Request $request)
    {
        $id = $request->only(['id']);
        $aluno = Aluno::findOrFail($id)->first();

        if ($aluno->user->delete() && $aluno->delete()) {
            return redirect(route("alunos.index"));
        }
    }

    public function index()
    {
        $alunos = Aluno::all();
        return view("Alunos.index", compact("alunos"));
    }
}
