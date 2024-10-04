<?php

namespace App\Http\Controllers;

use App\Models\GestorAdministrativo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class GestorAdministrativoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $gestores = GestorAdministrativo::all();

        return;
    }

    public function create ()
    {
        return;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store($request)
    {
        $gestor = new GestorAdministrativo();
        $gestor->cpf = $request->cpf;
        $gestor->instituicaoVinculo = $request->instituicaoVInculo;

        if($gestor->save()) {
            $user = $gestor->user()->create([
                'name'=> $request->nome,
                'name_social' => $request->name_social == null ? "-" : $request->name_social,
                'email' => $request->email,
                'cpf' => $request->cpf,
                'password' => Hash::make($request->senha),
            ]);

            $user->assignRole('diretor');
            $user->save();
            Auth::login($user);
        }
    }

    public function edit()
    {
        //
    }
}
