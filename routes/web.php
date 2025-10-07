<?php

use App\Http\Controllers\ProgramaController;
use App\Http\Controllers\AlunoController;
use App\Http\Controllers\CursoController;
use App\Http\Controllers\ServidorController;
use App\Http\Controllers\OrientadorController;
use App\Http\Controllers\EditalController;
use App\Http\Controllers\DisciplinaController;
use App\Http\Controllers\DocumentoEstagioController;
use App\Http\Controllers\EstagioController;
use App\Http\Controllers\SupervisorController;
use App\Http\Controllers\FrequenciaController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InstituicaoController;
use App\Http\Controllers\ListaDocumentosObrigatoriosController;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MeusAlunosController;
use App\Http\Controllers\MeusProgramasController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PDFController;
use App\Models\ListaDocumentosObrigatorios;
use App\Http\Controllers\SistemaExternoController;

// Rotas de autenticacao
Route::get('/', function () {
    return view('auth.login');
})->middleware('guest');

Route::get('/register', [UserController::class, 'register'])->name('register');
Route::post('/home', [UserController::class, 'store'])->name('store');

Route::middleware(['auth'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/relatorios', [ServidorController::class, 'relatorios'])->name('relatorios');
});

Route::get('/sistema', function () {
    return view('sistema');
});

Route::get('/parceria', function () {
    return view('parceria');
});

Route::get('/contato', function () {
    return view('contato');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

// Rotas de aluno
Route::resource('/alunos', AlunoController::class);

Route::prefix('alunos')->group(function () {
    Route::get('/', [AlunoController::class, 'index'])->name('alunos.index');
    Route::get('/create', [AlunoController::class, 'create'])->name('alunos.create');
    Route::post('/', [AlunoController::class, 'store'])->name('alunos.store');
    Route::get('/{id}/edit', [AlunoController::class, 'edit'])->where('id', '[0-9]+')->name('alunos.edit');
    Route::get('/{id}/editarmeuperfil', [AlunoController::class, 'editarmeuperfil'])->where('id', '[0-9]+')->name('alunos.editarmeuperfil');
    Route::put('/{id}', [AlunoController::class, 'update'])->name('alunos.update');
    Route::delete('/{id}', [AlunoController::class, 'destroy'])->name('alunos.delete');
});


// Rotas de servidor
Route::resource('/servidores', ServidorController::class);

Route::prefix('servidores')->group(function () {
    Route::get('/', [ServidorController::class, 'index'])->name('servidores.index');
    Route::get('/create', [ServidorController::class, 'create'])->name('servidores.create');
    Route::post('/', [ServidorController::class, 'store'])->name('servidores.store');
    Route::get('/{id}/edit', [ServidorController::class, 'edit'])->where('id', '[0-9]+')->name('servidores.edit');
    Route::get('/{id}/editarmeuperfil', [ServidorController::class, 'editarmeuperfil'])->where('id', '[0-9]+')->name('servidores.editarmeuperfil');
    Route::put('/{id}', [ServidorController::class, 'update'])->name('servidores.update');
    Route::delete('/{id}', [ServidorController::class, 'destroy'])->name('servidores.delete');
});


Route::post("/servidors/permissao/{id}", [ServidorController::class, "adicionar_permissao"]);

// Rotas de orientador //Fazer  - colocar todos os métodos do Controler
Route::resource('/orientadors', OrientadorController::class);

Route::prefix('orientadors')->group(function () {
    Route::get('/', [OrientadorController::class, 'index'])->name('orientadors.index');
    Route::get('/create', [OrientadorController::class, 'create'])->name('orientadors.create');
    Route::post('/', [OrientadorController::class, 'store'])->name('orientadors.store');
    Route::get('/{id}/edit', [OrientadorController::class, 'edit'])->where('id', '[0-9]+')->name('orientadors.edit');
    Route::get('/{id}/editarmeuperfil', [OrientadorController::class, 'editarmeuperfil'])->where('id', '[0-9]+')->name('orientadors.editarmeuperfil');
    Route::put('/{id}', [OrientadorController::class, 'update'])->name('orientadors.update');
    Route::delete('/{id}', [OrientadorController::class, 'destroy'])->name('orientadors.delete');
});

// Rotas de programa //Organizar rotas em grupos
Route::get('/MeusAlunos', [MeusAlunosController::class, "index"]);
Route::get('/MeusProgramas', [MeusProgramasController::class, "index"]);

// Rotas de programa //Organizar rotas em grupos
Route::resource('/programas', ProgramaController::class);

Route::prefix('programas')->group(function () {
    Route::get('/', [ProgramaController::class, 'index'])->name('programas.index');
    Route::get('/{id}/editais', [ProgramaController::class, 'listar_editais'])->name('programas.editais');
    Route::get('/create', [ProgramaController::class, 'create'])->name('programas.create');
    Route::get('/{id}/edit', [ProgramaController::class, 'edit'])->name('programas.edit');
    Route::post('/', [ProgramaController::class, 'store'])->name('programas.store');
    Route::put('/{id}', [ProgramaController::class, 'update'])->name('programas.update');
    Route::delete('/{id}/delete', [ProgramaController::class, 'destroy'])->name('programas.delete');
    Route::delete('/{id}', [ProgramaController::class, 'deletar_edital'])->name('programas.edital-delete');
    Route::get('/{id}/criar-edital', [ProgramaController::class, 'criar_edital'])->name('programas.edital-criar');
    Route::get('/{id}/editar-edital', [ProgramaController::class, 'editar_edital'])->name('programas.edital-editar');
    Route::get('/vinculo', [ProgramaController::class, 'listar_alunos'])->name('programas.vinculo');
    Route::get('/{id}/atribuir-servidor', [ProgramaController::class, 'atribuir_servidor'])->name('programas.atribuir-servidor');
    Route::post('/vincular_servidor', [ProgramaController::class, 'store_servidor'])->name('programas.vincular-servidor');


    //Route::post('/events/join/{id}', [EventController::class, 'joinEvent'])->middleware('auth');
});

// Rotas de Edital

// Route::get('/vinculo/create', [EditalController::class, "cadastrar_alunos"]);
Route::resource('/edital', EditalController::class);

Route::prefix('edital')->group(function () {
    Route::get('/', [EditalController::class, 'index'])->name('edital.index');
    Route::get('/create/{programa?}', [EditalController::class, 'create'])->name('edital.create');
    Route::post('/', [EditalController::class, 'store'])->name('edital.store');
    Route::get('/{id}/edit', [EditalController::class, 'edit'])->where('id', '[0-9]+')->name('edital.edit');
    Route::put('/{id}', [EditalController::class, 'update'])->name('edital.update');
    Route::delete('/{id}', [EditalController::class, 'destroy'])->name('edital.delete');
    Route::get('/{id}', [EditalController::class, 'show'])->name('edital.show');
    Route::post('/cadastrar-aluno/{id}', [EditalController::class, 'inscrever_aluno'])->name('edital.aluno');
    Route::get('/{id}/alunos', [EditalController::class, 'listar_alunos'])->name('edital.vinculo');
    Route::get('/{id}/alunos/desvinculados', [EditalController::class, 'listar_alunos_inativos'])->name('edital.vinculoInativo');
    Route::get('/{id}/disciplinas', [EditalController::class, 'listar_disciplinas'])->name('edital.listar_disciplinas');
    Route::get('/{fileName}/termo', [EditalController::class, 'download_termo_compromisso_aluno'])->name('termo_aluno.download');
    Route::get('/{fileName}/plano', [EditalController::class, 'download_plano_trabalho'])->name('plano_trabalho.download');
    Route::get('/{fileName}/documentos', [EditalController::class, 'download_outros_documentos'])->name('outros_documentos.download');
    Route::get('/{id}/disciplinas', [EditalController::class, 'listar_disciplinas'])->name('edital.listar_disciplinas');
    Route::get('/{id}/orientadores', [EditalController::class, 'listar_orientadores'])->name('edital.listar_orientadores');
    Route::get('/cpfs', [EditalController::class, 'getCpfs']);
    Route::get('/{aluno_id}/{edital_id}/editar_vinculo', [EditalController::class, 'editar_vinculo'])->name('edital.editar_vinculo');
    Route::put('/vinculo/{id}', [EditalController::class, 'updateVinculo'])->name('edital.update_vinculo');
    Route::get('/{id}/delete', [EditalController::class, 'deletarVinculo'])->name('edital.aluno.delete');
    Route::get('/{id}/ativar_vinculo', [EditalController::class, 'ativarVinculo'])->name('edital.ativarVinculo');
    Route::get('/vinculos-orientador/{id}/documentos', [EditalController::class, 'adicionar_documentos'])->where('id', '[0-9]+')->name('edital.add-documentos-vinculo');
    Route::put('/vinculo/{id}/adicionar-documentos', [EditalController::class, 'store_adicionar_documentos'])->name('edital.salvar-documentos-vinculo');
    Route::get('/{fileName}/termo-aluno', [EditalController::class, 'download_termo_aluno'])->name('aluno_termo.download');
    Route::get('/{fileName}/termo-orientador', [EditalController::class, 'download_termo_orientador'])->name('orientador_termo.download');
    Route::get('/{fileName}/historico-escolar', [EditalController::class, 'download_historico_escolares_alunos'])->name('historico_escolar.download');
    Route::get('/{fileName}/comprovante-bancario', [EditalController::class, 'download_comprovante_bancario'])->name('comprovante_bancario.download');
    Route::get('/{fileName}/frequencia_mensal', [EditalController::class, 'download_frequencia_mensal'])->name('frequencia.download');
});

// Rotas de Disciplina
Route::resource('/disciplinas', DisciplinaController::class);

Route::prefix('disciplinas')->group(function () {
    Route::get('/', [DisciplinaController::class, 'index'])->name('disciplinas.index');
    Route::get('/create', [DisciplinaController::class, 'create'])->name('disciplinas.create');
    Route::post('/', [DisciplinaController::class, 'store'])->name('disciplinas.store');
    Route::get('/{id}/edit', [DisciplinaController::class, 'edit'])->where('id', '[0-9]+')->name('disciplinas.edit');
    Route::put('/{id}', [DisciplinaController::class, 'update'])->name('disciplinas.update');
    Route::delete('/{id}', [DisciplinaController::class, 'destroy'])->name('disciplinas.delete');
    Route::get('{id}', [DisciplinaController::class, 'show'])->name('disciplinas.show');
    Route::get('/create_diciplina_curso/{id}', [DisciplinaController::class, 'create_disciplina_curso'])->name('disciplinas_curso.create');
});
// Rotas de curso
Route::resource('/cursos', CursoController::class);

Route::prefix('cursos')->group(function () {
    Route::get('/', [CursoController::class, 'index'])->name('cursos.index');
    Route::get('/create', [CursoController::class, 'create'])->name('cursos.create');
    Route::post('/', [CursoController::class, 'store'])->name('cursos.store');
    Route::get('/{id}/edit', [CursoController::class, 'edit'])->where('id', '[0-9]+')->name('cursos.edit');
    Route::put('/{id}', [CursoController::class, 'update'])->name('cursos.update');
    Route::delete('/{id}', [CursoController::class, 'destroy'])->name('cursos.delete');
    Route::get('{id}', [CursoController::class, 'show'])->name('cursos.show');
    Route::get('/{id}/estagios', [CursoController::class, 'listar_estagio_curso'])->name('estagio.listar_estagio_curso');
});

// Rotas de Cadastrar-se
// Route::get('/cadastrar-se', [CadastrarSeController::class, "cadastrarSe"]);
// Route::post('/cadastrar-se/store', [CadastrarSeController::class, "store"]);


//---------------------------------------------PERFIL------------------------------------------------------------
//
//Rota de meu perfil servidor
Route::get('/meu-perfil-servidor', [App\Http\Controllers\ServidorController::class, 'profile'])->name('meu-perfil-servidor');
//Editar perfil servidor
Route::get('/meu-perfil-servidor/editar', [App\Http\Controllers\ServidorController::class, 'editarmeuperfil'])->name('meu-perfil-servidor.editar');
Route::put('/meu-perfil-servidor/{id}', [App\Http\Controllers\ServidorController::class, 'atualizarPerfilServidor'])->name('meu-perfil-servidor.atualizar');
//Rota de meu perfil aluno
Route::get('/meu-perfil-aluno', [App\Http\Controllers\AlunoController::class, 'profile'])->name('meu-perfil-aluno');
//Editar perfil aluno
Route::get('/meu-perfil-aluno/editar', [App\Http\Controllers\AlunoController::class, 'editarmeuperfil'])->name('meu-perfil-aluno.editar');
Route::put('/meu-perfil-aluno/{id}', [App\Http\Controllers\AlunoController::class, 'atualizarPerfilAluno'])->name('meu-perfil-aluno.atualizar');
// Route::put('/meu-perfil-aluno/editar', [App\Http\Controllers\UserController::class, 'updateAluno'])->name('meu-perfil-aluno.editar');
//Rota de meu perfil orientador
Route::get('/meu-perfil-orientador', [App\Http\Controllers\OrientadorController::class, 'profile'])->name('meu-perfil-orientador');
//Editar perfil orientador
Route::get('/meu-perfil-orientador/editar', [App\Http\Controllers\OrientadorController::class, 'editarmeuperfil'])->name('meu-perfil-orientador.editar');
Route::put('/meu-perfil-orientador/{id}', [App\Http\Controllers\OrientadorController::class, 'atualizerPerfilOrientador'])->name('meu-perfil-orientador.atualizar');
//
//--------------------------------------------------------------------------------------------------------------



//Rota para listar os projetos do aluno
Route::get('/index_aluno', [MeusProgramasController::class, 'index_aluno']);

//Rota para listar os editais do aluno em seu perfil
Route::get('/editais-aluno', [AlunoController::class, 'editais_profile'])->name('Aluno.editais-aluno');

//Rota para listar os editais do orientador em seu perfil
Route::get('/editais-orientador', [OrientadorController::class, 'editais_profile_orientador'])->name('orientadors.editais-orientador');

//Rota para listar os alunos vinculado a um orientador especifico
Route::get('/listar_alunos-orientador', [OrientadorController::class, 'lista_alunos_profile_orientador']);

//Rota para frequencia mensal
Route::post('/frequencia-aluno', [EditalController::class, 'enviarFrequencia'])->name('frequencia.enviar');

//Rota para envio do relatório final
Route::post('/relatorio-aluno', [EditalController::class, 'enviarRelatorio'])->name('relatorio.enviar');
Route::get('/{relatorio_id}/relatorio-final/download', [EditalController::class, 'download_relatorio_final'])->name('relatorio.download');
Route::get('/{relatorio_id}/relatorio-final/visualizar', [EditalController::class, 'visualizar_relatorio_final'])->name('relatorio.visualizar');
Route::post('/relatorio-final/parecer/update', [EditalController::class, 'parecer_relatorio_final'])->name('relatorio.parecer');


//Rotas do Estágio

Route::prefix('estagio')->group(function () {
    Route::get('/', [EstagioController::class, 'index'])->name('estagio.index');
    Route::get('/cadastrar', [EstagioController::class, 'create'])->name('estagio.create');
    Route::post('/', [EstagioController::class, 'store'])->name('estagio.store');
    Route::get('/{id}/edit', [EstagioController::class, 'edit'])->where('id', '[0-9]+')->name('estagio.edit');
    Route::put('/{id}', [EstagioController::class, 'update'])->name('estagio.update');
    Route::delete('/{id}', [EstagioController::class, 'destroy'])->name('estagio.delete');
    // Route::get('{id}', [EstagioController::class, 'show'])->name('estagio.show');

    Route::get('/instituicao', [InstituicaoController::class, 'index'])->name('instituicao.index');
    Route::get('/instituicao/edit', [InstituicaoController::class, 'edit'])->name('instituicao.edit');
    Route::post('/instituicao', [InstituicaoController::class, 'update'])->name('instituicao.update');

    Route::get('/configurar', [ListaDocumentosObrigatoriosController::class, 'editConfig'])->name('estagio.editConfig');
    Route::post('/configurar', [ListaDocumentosObrigatoriosController::class, 'updateConfig'])->name('estagio.updateConfig');

    Route::get('/verificar-aluno', [EstagioController::class, 'verificar_aluno_view'])->name('estagio.verificarAluno');
    Route::post('/verificar-aluno', [EstagioController::class, 'verificarAluno'])->name('estagio.verificarAluno.control');

    Route::get('/exportar-dados', [EstagioController::class, 'export_form'])->name('estagio.export-form');
    Route::get('/export', [EstagioController::class, 'export'])->name('estagio.export');

    // Route::get('/documentos/termo_encaminhamento', [DocumentoEstagioController::class, 'termo_encaminhamento_form'])->name('estagio.formularios.termo_encaminhamento');
    // Route::post('/documentos/termo_encaminhamento', [DocumentoEstagioController::class, 'termo_encaminhamento'])->name('estagio.formularios.termo_encaminhamento.store');
    // comentado temporariamente
    Route::prefix('/documentos')->group(function () {
        Route::get('/{id}', [EstagioController::class, 'showDocuments'])->name('estagio.documentos');

        Route::get('/aprovar-documento/{id}', [DocumentoEstagioController::class, 'aprovar_documento'])->name('aprovar.documento');
        Route::get('/negar-documento/{id}', [DocumentoEstagioController::class, 'negar_documento'])->name('negar.documento');

        // Route::get('/observacao/show/{id}', [DocumentoEstagioController::class, 'observacao_show'])->name('observacao.show');
        Route::get('/observacao/edit/{id}', [DocumentoEstagioController::class, 'observacao_edit'])->name('observacao.edit');
        Route::post('/observacao/update/{id}', [DocumentoEstagioController::class, 'observacao_update'])->name('observacao.update');

        Route::get('/download/{nome}/{id}', [DocumentoEstagioController::class, 'download'])->name('download.documento');


        // Documentos UPE

        Route::get('/{id}/termo-de-encaminhamento', [DocumentoEstagioController::class, 'termo_encaminhamento_form'])->name('estagio.documentos.UPE.termo-de-encaminhamento');
        Route::post('/{id}/termo-de-encaminhamento', [DocumentoEstagioController::class, 'termo_encaminhamento'])->name('estagio.documentos.UPE.termo-de-encaminhamento.store');

        Route::get('/{id}/termo-de-compromisso', [DocumentoEstagioController::class, 'termo_compromisso_form'])->name('estagio.documentos.UPE.termo-de-compromisso');
        Route::post('/{id}/termo-de-compromisso', [DocumentoEstagioController::class, 'termo_compromisso'])->name('estagio.documentos.UPE.termo-de-compromisso.store');

        Route::get('/{id}/plano-de-atividades', [DocumentoEstagioController::class, 'plano_de_atividades_form'])->name('estagio.documentos.UPE.plano-de-atividades');
        Route::post('/{id}/plano-de-atividades', [DocumentoEstagioController::class, 'plano_de_atividades'])->name('estagio.documentos.UPE.plano-de-atividades.store');

        Route::get('/{id}/ficha-frequencia', [DocumentoEstagioController::class, 'ficha_frequencia_form'])->name('estagio.documentos.UPE.ficha-frequencia');
        Route::post('/{id}/ficha-frequencia', [DocumentoEstagioController::class, 'ficha_frequencia'])->name('estagio.documentos.UPE.ficha-frequencia.store');

        Route::get('/{id}/frequencia_residente', [DocumentoEstagioController::class, 'frequencia_residente_form'])->name('estagio.documentos.UPE.frequencia-residente');
        Route::post('/{id}/frequencia_residente', [DocumentoEstagioController::class, 'frequencia_residente'])->name('estagio.documentos.UPE.frequencia-residente.store');

        Route::get('/{id}/relatorio-acompanhamento-campo', [DocumentoEstagioController::class, 'relatorio_acompanhamento_campo_form'])->name('estagio.documentos.UPE.relatorio-acompanhamento-campo');
        Route::post('/{id}/relatorio-acompanhamento-campo', [DocumentoEstagioController::class, 'relatorio_acompanhamento_campo'])->name('estagio.documentos.UPE.relatorio-acompanhamento-campo.store');

        //DOCUMENTO COMPLETO--------------------------------------------------------------------------------------------
        Route::get('/{id}/enviar-documento-completo', [DocumentoEstagioController::class, 'documento_completo_form'])->name('estagio.documentos.documento-completo');
        Route::post('/{id}/enviar-documento-completo', [DocumentoEstagioController::class, 'documento_completo'])->name('estagio.documentos.documento-completo.store');
        //--------------------------------------------------------------------------------------------------------------

        Route::get('/{id}/relatorio-supervisor', [DocumentoEstagioController::class, 'relatorio_supervisor_form'])->name('estagio.documentos.UPE.relatorio-supervisor');
        Route::post('/{id}/relatorio-supervisor', [DocumentoEstagioController::class, 'relatorio_supervisor'])->name('estagio.documentos.UPE.relatorio-supervisor.store');

        // documentos UFAPE
        Route::get('/{id}/seguro-ufape', [DocumentoEstagioController::class, 'seguro_ufape_form'])->name('estagio.documentos.UFAPE.seguro');
        Route::post('/{id}/seguro-ufape', [DocumentoEstagioController::class, 'seguro_ufape'])->name('estagio.documentos.UFAPE.seguro.store');

        Route::get('/{id}/termo-de-compromisso-ufape', [DocumentoEstagioController::class, 'termo_compromisso_ufape_form'])->name('estagio.documentos.UFAPE.termo-de-compromisso');
        Route::post('/{id}/termo-de-compromisso-ufape', [DocumentoEstagioController::class, 'termo_compromisso_ufape'])->name('estagio.documentos.UFAPE.termo-de-compromisso.store');

        Route::get('/{id}/carta-aceite-supervisor-ufape', [DocumentoEstagioController::class, 'carta_aceite_supervisor_ufape_form'])->name('estagio.documentos.UFAPE.carta-aceite-supervisor');
        Route::post('/{id}/carta-aceite-supervisor-ufape', [DocumentoEstagioController::class, 'carta_aceite_supervisor_ufape'])->name('estagio.documentos.UFAPE.carta-aceite-supervisor.store');

        Route::get('/{id}/ficha-frequencia-ufape', [DocumentoEstagioController::class, 'ficha_frequencia_ufape_form'])->name('estagio.documentos.UFAPE.ficha-frequencia');
        Route::post('/{id}/ficha-frequencia-ufape', [DocumentoEstagioController::class, 'ficha_frequencia_ufape'])->name('estagio.documentos.UFAPE.ficha-frequencia.store');

        Route::get('/{id}/termo-aditivo-ufape', [DocumentoEstagioController::class, 'termo_aditivo_ufape_form'])->name('estagio.documentos.UFAPE.termo-aditivo');
        Route::post('/{id}/termo-aditivo-ufape', [DocumentoEstagioController::class, 'termo_aditivo_ufape'])->name('estagio.documentos.UFAPE.termo-aditivo.store');

        Route::get('/{id}/declaracao-ch-ufape', [DocumentoEstagioController::class, 'declaracao_ch_ufape_form'])->name('estagio.documentos.UFAPE.declaracao-ch-ufape');
        Route::post('/{id}/declaracao-ch-ufape', [DocumentoEstagioController::class, 'declaracao_ch_ufape'])->name('estagio.documentos.UFAPE.declaracao-ch-ufape.store');

        Route::get('/visualizar-pdf/{docId}', [PDFController::class, 'viewPDF'])->name('visualizar.pdf');

        //rota para visualizar os doc que foram convertidos para nova forma de preencher
        Route::get('/visualizar-doc/{docId}', [PDFController::class, 'viewDoc'])->name('visualizar.doc');
        Route::get('/download-doc/{docId}', [PDFController::class, 'downloadDoc'])->name('download.doc');

        Route::get('/download-modelo-doc/{id}/{docId}', [PDFController::class, 'downloadModeloDoc'])->name('download.modelo.doc');
    });
});
Route::get('/meus-estagios', [EstagioController::class, 'estagios_profile'])->name('Estagio.estagios-aluno');
Route::get('/estagios-orientador', [EstagioController::class, 'estagios_orientador'])->name('Estagio.estagios-orientador');
//Rotas de Supervisor
Route::prefix('supervisor')->group(function () {
    Route::get('/', [SupervisorController::class, 'index'])->name('supervisor.index');
    Route::get('/cadastrar', [SupervisorController::class, 'create'])->name('supervisor.create');
    Route::post('/', [SupervisorController::class, 'store'])->name('supervisor.store');
    Route::get('/{id}/edit', [SupervisorController::class, 'edit'])->where('id', '[0-9]+')->name('supervisor.edit');
    Route::put('/{id}', [SupervisorController::class, 'update'])->name('supervisor.update');
    Route::delete('/{id}', [SupervisorController::class, 'destroy'])->name('supervisor.delete');
});


Route::middleware('auth')->group(function () {
    Route::delete('/integrations/tokens/{name}', [SistemaExternoController::class, 'destroy'])->name('integrations.delete');
    Route::get('/integrations/tokens', [SistemaExternoController::class, 'index'])->name('integrations.index');
    Route::post('/integrations/tokens', [SistemaExternoController::class, 'upsert'])->name('integrations.upsert');
});
