<?php

namespace App\Http\Controllers;

use App\Http\Requests\ServidorFormRequest;
use App\Http\Requests\ServidorFormUpdateRequest;
use App\Http\Requests\AdicionarPermissaoFormRequest;
use App\Models\DocumentoEstagio;
use App\Models\Edital;
use App\Models\EditalAlunoOrientadors;
use App\Models\Servidor;
use App\Models\Tipo_servidor;
use App\Models\User;
use App\Services\ManipulacaoImagens;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Database\QueryException;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class ServidorController extends Controller {

    public function index(Request $request)
    {

            if (sizeof($request-> query()) > 0){
                $campo = $request->query('campo');
                $valor = $request->query('valor');

                if ($valor == null){
                    return redirect()->back()->withErrors( "Deve ser informado algum valor para o filtro." );
                }

                $servidores = Servidor::join("users", "users.typage_id", "=", "servidors.id");
                $servidores = $servidores->where(function ($query) use ($valor) {
                    if ($valor) {
                        $query->orWhere("users.name", "LIKE", "%{$valor}%");
                        $query->orWhere("users.email", "LIKE", "%{$valor}%");
                        $query->orWhere("servidors.cpf", "LIKE", "%{$valor}%");
                        $query->orWhere("servidors.matricula", "LIKE", "%{$valor}%");
                    }
                })->orderBy('servidors.created_at', 'desc')->select("servidors.*")->distinct()->get();

                return view("servidores.index", compact("servidores"));
            } else {
                $servidores = Servidor::all();
                return view("servidores.index", compact("servidores"));
            }

    }


    public function create(){
        $servidor = Servidor::all();
        return view("servidores.cadastrar", compact("servidor"));
    }

    public function store(ServidorFormRequest $request)
    {

        try{
            DB::beginTransaction();
            #dd($request->input('cpf'));
            switch($request->input('tipo_servidor')){
                case 0:
                    $role = "administrador";
                    break;
                case 1:
                    $role = "pro-reitor";
                    break;
                case 2:
                    $role = "tecnico";
                    break;
                case 3:
                    $role = "diretor";
                    break;
            };

            $servidor = Servidor::Create([
                'cpf' => $request->input('cpf'),
                'tipo_servidor' => $role,
                'instituicaoVinculo' => $request->input('instituicaoVinculo'),
                'matricula' => $request->input('matricula')
            ]);

            $imageName = null;
            if($request->hasFile('image') && $request->file('image')->isValid()) {
                $imageName = ManipulacaoImagens::salvarImagem($request->image);
            }

            if(
                $servidor->user()->create([
                    'name' => $request->input('nome'),
                    'name_social' => $request->input('nome_social'),
                    'cpf' => $request->input('cpf'),
                    'email' => $request->input('email'),
                    'password' => Hash::make($request->input('senha')),
                    'image' => $imageName
                ])->assignRole($role)
            ){
                #$mensagem_sucesso = "Orientador cadastrado com sucesso.";

                DB::commit();

                return redirect('/servidores')->with('sucesso', 'Servidor cadastrado com sucesso.');

            } else {
                DB::rollback();
                return redirect()->back()->withErrors( "Falha ao cadastrar servidor. tente novamente mais tarde." );
            }
        } catch (Exception $e) {
            DB::rollback();
            dd($e);
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

    public function editarmeuperfil($id)
    {
        $servidor = Servidor::find($id);
        $servidores = Servidor::all();

        // Verifique se o ID do servidor corresponde ao ID do usuário autenticado
        if ($servidor->user->id !== auth()->user()->id) {
            return redirect()->route('home')->with('erro', 'Você não tem permissão para editar este perfil.');
        }

        #$tipo_servidors = User::where('typage_id', Auth::user()->typage_id)->get();
        return view("servidores.editarmeuperfil", compact('servidor', 'servidores'));
    }

    public function update(ServidorFormUpdateRequest $request, $id)
    {
        try{
            DB::beginTransaction();

            $servidor = Servidor::find($id);

            switch($request->input('tipo_servidor')){
                case 0:
                    $permission = "administrador";
                    break;
                case 1:
                    $permission = "pro-reitor";
                    break;
                case 2:
                    $permission = "tecnico";
                    break;
                case 3:
                    $permission = "diretor";
                    break;
            };
            $servidor->cpf = $request->cpf == $servidor->cpf ? $servidor->cpf : $request->cpf;
            $servidor->tipo_servidor = $permission == $servidor->tipo_servidor ? $servidor->tipo_servidor : $permission;
            $servidor->user->name_social = $request->nome_social;
            $servidor->user->name = $request->nome;
            $servidor->user->cpf = $request->cpf;
            $servidor->user->email = $request->email;

            $imageName = null;
            if($request->hasFile('image') && $request->file('image')->isValid()) {
                $imageName = ManipulacaoImagens::salvarImagem($request->image);
                if($servidor->user->image){
                    ManipulacaoImagens::deletarImagem($servidor->user->image); //Se houver uma nova imagem, remove a anterior do servidor
                }
            }
            $servidor->user->image = $request->image == null ? $servidor->user->image : $imageName;

            if ($request->senha && $request->senha != null){
                if (strlen($request->senha) > 7 && strlen($request->senha) < 31){
                    $servidor->user->password = Hash::make($request->senha);
                } else {
                    return redirect()->back()->withErrors( "Senha deve ter entre 8 e 30 dígitos" );
                }
            }

            if ($servidor->save()){

                if ($servidor->user->update()){
                    $mensagem_sucesso = "Servidor editado com sucesso.";
                    DB::commit();

                    return redirect("/servidores")->with('sucesso', 'Servidor editado com sucesso.');
                } else {
                    DB::rollback();
                    return redirect()->back()->withErrors( "Falha ao editar servidor. tente novamente mais tarde." );
                }

            } else {
                DB::rollback();
                return redirect()->back()->withErrors( "Falha ao editar servidor. tente novamente mais tarde." );
            }
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors("Falha ao editar servidor. Tente novamente mais tarde.");
        }
    }

    public function atualizarPerfilServidor(ServidorFormUpdateRequest $request, $id)
    {
        try{
            $servidor = Servidor::find($id);

            switch($request->input('tipo_servidor')){
                case 0:
                    $permission = "administrador";
                    break;
                case 1:
                    $permission = "pro-reitor";
                    break;
                case 2:
                    $permission = "tecnico";
                    break;
                case 3:
                    $permission = "diretor";
                    break;
            };
            $servidor->cpf = $request->cpf == $servidor->cpf ? $servidor->cpf : $request->cpf;
            $servidor->tipo_servidor = $permission == $servidor->tipo_servidor ? $servidor->tipo_servidor : $permission;
            $servidor->user->name_social = $request->nome_social;
            $servidor->user->name = $request->nome;
            $servidor->user->email = $request->email;

            $imageName = null;
            if($request->hasFile('image') && $request->file('image')->isValid()) {
                $imageName = ManipulacaoImagens::salvarImagem($request->image);
                if($servidor->user->image){
                    ManipulacaoImagens::deletarImagem($servidor->user->image); //Se houver uma nova imagem, remove a anterior do servidor
                }
            }
            $servidor->user->image = $request->image == null ? $servidor->user->image : $imageName;

            if ($request->senha && $request->senha != null){
                if (strlen($request->senha) > 7 && strlen($request->senha) < 31){
                    $servidor->user->password = Hash::make($request->senha);
                } else {
                    return redirect()->back()->withErrors( "Senha deve ter entre 8 e 30 dígitos" );
                }
            }

            if ($servidor->save()){

                if ($servidor->user->update()){
                    $mensagem_sucesso = "Servidor editado com sucesso.";
                    return redirect("/meu-perfil-servidor")->with('sucesso', 'Servidor editado com sucesso.');
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
            DB::beginTransaction();

            $id = $request->only(['id']);
            $servidor = Servidor::findOrFail($id)->first();
            $imageName = $servidor->user->image;

            $servidor->user->delete();
            $servidor->delete();
            ManipulacaoImagens::deletarImagem($imageName);
            DB::commit();
            return redirect(route("servidores.index"))->with('sucesso', 'Servidor Deletado com Sucesso!');


        } catch(QueryException $e){
            DB::rollback();
            return redirect()->back()->withErrors( "Falha ao deletar Servidor. O Servidor possui vínculo com algum Programa." );
        }catch (Exception $e) {
            DB::rollback();
            //dd($e);
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

    public function relatorios(Request $request)
    {
        $dt_ini_col = 'editals.data_inicio';
        $dt_fin_col   = 'editals.data_fim';

        $base = Edital::query()
            ->join('programas as p', 'p.id', '=', 'editals.programa_id')
            ->leftJoin('edital_aluno_orientadors as eao', 'editals.id', '=', 'eao.edital_id');

        $query = QueryBuilder::for($base)
                    ->allowedFilters([
                        AllowedFilter::callback('data_inicial', function ($qb, $ini) use ($dt_ini_col, $dt_fin_col) {
                            if (!$ini) return;
                            $fim = request('filter.data_final');

                            if ($fim) {
                                $qb->whereDate($dt_ini_col, '<=', $fim)
                                   ->where(function ($q) use ($dt_fin_col, $ini) {
                                       $q->whereNull($dt_fin_col)
                                         ->orWhereDate($dt_fin_col, '>=', $ini);
                                   });
                            } else {
                                $qb->where(function ($q) use ($dt_fin_col, $ini) {
                                    $q->whereNull($dt_fin_col)
                                      ->orWhereDate($dt_fin_col, '>=', $ini);
                                });
                            }
                        }),
                        AllowedFilter::callback('data_final', function ($qb, $fim) use ($dt_ini_col) {
                            if (!$fim) return;
                            $qb->whereDate($dt_ini_col, '<=', $fim);
                        }),
                        AllowedFilter::exact('semestre', 'editals.semestre'),
                        AllowedFilter::callback('tipo_vinculo', function ($qb, $v) {
                            if (!$v) return;
                            if ($v === 'bolsista')   $qb->where('eao.bolsista', true);
                            if ($v === 'voluntario') $qb->where('eao.bolsista', false);
                        }),
                    ]);

        $infos_por_programas = $query->select([
                                    'p.id as programa_id',
                                    'p.nome as programa_nome',
                                    'editals.semestre',
                                    DB::raw("COUNT(DISTINCT eao.aluno_id) FILTER (WHERE eao.bolsista IS TRUE)  AS total_bolsistas"),
                                    DB::raw("COUNT(DISTINCT eao.aluno_id) FILTER (WHERE eao.bolsista IS FALSE) AS total_voluntarios"),
                                    DB::raw("COUNT(DISTINCT eao.aluno_id) AS total_alunos"),
                                    DB::raw("COUNT(DISTINCT editals.id) AS total_editais_no_semestre"),
                                ])
                                ->groupBy('p.id','p.nome','editals.semestre')
                                ->orderBy('semestre', 'asc')
                                ->orderBy('p.nome','asc')
                                ->get();

        $infos_por_programas = $infos_por_programas->groupBy('programa_id')->map(function($grupo){
            $primeiro_elemento_grupo = $grupo->first();

            return [
                'programa_id' => $primeiro_elemento_grupo->programa_id,
                'programa_nome' => $primeiro_elemento_grupo->programa_nome,
                'tipo' => [
                    'bolsistas' => [
                        'total'        => (int) $grupo->sum('total_bolsistas'),
                        'por_semestre' => $grupo->pluck('total_bolsistas','semestre')
                                              ->map(fn($v)=>(int)$v)->sortKeys()->toArray(),
                    ],

                    'voluntarios' => [
                        'total'        => (int) $grupo->sum('total_voluntarios'),
                        'por_semestre' => $grupo->pluck('total_voluntarios','semestre')
                                              ->map(fn($v)=>(int)$v)->sortKeys()->toArray(),
                    ],

                    'total' => [
                        'geral'        => (int) $grupo->sum('total_alunos'),
                        'por_semestre' => $grupo->pluck('total_alunos','semestre')
                                              ->map(fn($v)=>(int)$v)->sortKeys()->toArray(),
                    ]
                ],
                'total_editais' => $primeiro_elemento_grupo->total_editais_no_semestre
            ];
        });

        return view('relatorios', compact('infos_por_programas'));
    }
}
