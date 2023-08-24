<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\InstituicaoUpdateFormRequest;
use App\Models\Instituicao;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InstituicaoController extends Controller
{

    public function index()
    {
        $instituicao = Instituicao::Where('id',1)->first();

        return view('Estagio.instituicao.showInstituicao', compact('instituicao'));
    }

    public function edit()
    {
        $instituicao = Instituicao::Where('id',1)->first();
        return view('Estagio.instituicao.editInstituicao',compact('instituicao'));
    }

    public function update(InstituicaoUpdateFormRequest $request)
    {
        DB::beginTransaction();
        try{
            $instituicao = Instituicao::find(1);

            $instituicao->instituicao = $request->instituicao ? $request->instituicao  : $instituicao->instituicao;
            $instituicao->sigla = $request->sigla ? $request->sigla  : $instituicao->sigla;
            $instituicao->cnpj = $request->cnpj ? $request->cnpj  : $instituicao->cnpj;
            $instituicao->natureza_juridica = $request->natureza_juridica ? $request->natureza_juridica  : $instituicao->natureza_juridica;
            $instituicao->endereco = $request->endereco ? $request->endereco  : $instituicao->endereco;
            $instituicao->numero = $request->numero ? $request->numero  : $instituicao->numero;
            $instituicao->complemento = $request->complemento ? $request->complemento  : $instituicao->complemento;
            $instituicao->CEP = $request->CEP ? $request->CEP  : $instituicao->CEP;
            $instituicao->bairro = $request->bairro  ? $request->bairro   : $instituicao->bairro;
            $instituicao->cidade = $request->cidade ? $request->cidade  : $instituicao->cidade;
            $instituicao->estado = $request->estado ? $request->estado  : $instituicao->estado;
            $instituicao->representante = $request->representante ? $request->representante  : $instituicao->representante;
            $instituicao->cargo_representante = $request->cargo_representante ? $request->cargo_representante  : $instituicao->cargo_representantes;

            $instituicao->update();

            DB::commit();

            return redirect()->route('instituicao.index')->with('sucesso', 'Informações da Instituição edita
            dos com sucesso.');
        

        } catch (Exception $e) {
            DB::rollback();
            $errorMessage = "Falha ao editar Dados da Instituição. Tente novamente mais tarde.";

            // $errorMessage .= " " . $e->getMessage();

            return redirect()->back()->withErrors(['error' => $errorMessage]);
        }
    }


}
