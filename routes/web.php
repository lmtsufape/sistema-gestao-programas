<?php

use App\Http\Controllers\ProfessorController;
use App\Http\Controllers\ProgramaController;
use App\Http\Controllers\AlunoController;
use App\Http\Controllers\CursoController;
use App\Http\Controllers\ServidorController;
use App\Http\Controllers\OrientadorController;
use App\Http\Controllers\EditalController;
use App\Http\Controllers\DisciplinaController;
use App\Http\Controllers\CadastrarSeController;
use App\Http\Controllers\FrequenciaController;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MeusAlunosController;
use App\Http\Controllers\MeusProgramasController;

// Rotas de autenticacao
Route::get('/', function () {
    return view('auth.login');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


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

Route::prefix('alunos')->group(function() {
    Route::get('/', [AlunoController::class, 'index'])->name('alunos.index');
    Route::get('/create', [AlunoController::class, 'create'])->name('alunos.create');
    Route::post('/', [AlunoController::class, 'store'])->name('alunos.store');
    Route::get('/{id}/edit', [AlunoController::class, 'edit'])->where('id', '[0-9]+')->name('alunos.edit');
    Route::put('/{id}', [AlunoController::class, 'update'])->name('alunos.update');
    Route::delete('/{id}', [AlunoController::class, 'destroy'])->name('alunos.delete');
});


// Rotas de servidor
Route::resource('/servidores', ServidorController::class);

Route::prefix('servidores')->group(function() {
    Route::get('/', [ServidorController::class, 'index'])->name('servidores.index');
    Route::get('/create', [ServidorController::class, 'create'])->name('servidores.create');
    Route::post('/', [ServidorController::class, 'store'])->name('servidores.store');
    Route::get('/{id}/edit', [ServidorController::class, 'edit'])->where('id', '[0-9]+')->name('servidores.edit');
    Route::put('/{id}', [ServidorController::class, 'update'])->name('servidores.update');
    Route::delete('/{id}', [ServidorController::class, 'destroy'])->name('servidores.delete');
});


Route::post("/servidors/permissao/{id}", [ServidorController::class, "adicionar_permissao"]);

// Rotas de orientador //Fazer  - colocar todos os métodos do Controler
Route::resource('/orientadors', OrientadorController::class);

Route::prefix('orientadors')->group(function() {
    Route::get('/', [OrientadorController::class, 'index'])->name('orientadors.index');
    Route::get('/create', [OrientadorController::class, 'create'])->name('orientadors.create');
    Route::post('/', [OrientadorController::class, 'store'])->name('orientadors.store');
    Route::get('/{id}/edit', [OrientadorController::class, 'edit'])->where('id', '[0-9]+')->name('orientadors.edit');
    Route::put('/{id}', [OrientadorController::class, 'update'])->name('orientadors.update');
    Route::delete('/{id}', [OrientadorController::class, 'destroy'])->name('orientadors.delete');
});

// Rotas de programa //Organizar rotas em grupos
Route::get('/MeusAlunos', [MeusAlunosController::class, "index"]);
Route::get('/MeusProgramas', [MeusProgramasController::class, "index"]);

// Rotas de programa 
Route::resource('/programas', ProgramaController::class);

Route::prefix('programas')->group(function(){
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
});

// Rotas de Edital
Route::get('/vinculo', [EditalController::class, "listar_alunos"])->name('edital.vinculo');
    // Route::get('/vinculo/create', [EditalController::class, "cadastrar_alunos"]);
Route::resource('/edital', EditalController::class);

Route::prefix('edital')->group(function() {
    Route::get('/', [EditalController::class, 'index'])->name('edital.index');
    Route::get('/create', [EditalController::class, 'create'])->name('edital.create');
    Route::post('/', [EditalController::class, 'store'])->name('edital.store');
    Route::get('/{id}/edit', [EditalController::class, 'edit'])->where('id', '[0-9]+')->name('edital.edit');
    Route::put('/{id}', [EditalController::class, 'update'])->name('edital.update');
    Route::delete('/{id}', [EditalController::class, 'destroy'])->name('edital.delete');
    Route::get('{id}', [EditalController::class, 'show'])->name('edital.show');
    Route::post('/cadastrar-aluno/{id}', [EditalController::class, 'inscrever_aluno'])->name('edital.aluno');
    Route::get('/{id}/alunos', [EditalController::class, 'listar_alunos'])->name('edital.vinculo');
});    

// Rotas de Disciplina
Route::resource('/disciplinas', DisciplinaController::class);

Route::prefix('disciplinas')->group(function() {
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

Route::prefix('cursos')->group(function() {
    Route::get('/', [CursoController::class, 'index'])->name('cursos.index');
    Route::get('/create', [CursoController::class, 'create'])->name('cursos.create');
    Route::post('/', [CursoController::class, 'store'])->name('cursos.store');
    Route::get('/{id}/edit', [CursoController::class, 'edit'])->where('id', '[0-9]+')->name('cursos.edit');
    Route::put('/{id}', [CursoController::class, 'update'])->name('cursos.update');
    Route::delete('/{id}', [CursoController::class, 'destroy'])->name('cursos.delete');
    Route::get('{id}', [CursoController::class, 'show'])->name('cursos.show');
});

// Rotas de Cadastrar-se
Route::get('/cadastrar-se', [CadastrarSeController::class, "cadastrarSe"]);
Route::post('/cadastrar-se/store', [CadastrarSeController::class, "store"]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Rotas de Frequencia mensal
Route::get('/frequencia/create', [FrequenciaController::class, 'create']);

//Rotas de listar modelos de documentos
Route::get('/listar-modelos', [App\Http\Controllers\ListarModelosController::class, 'index'])->name('listar-modelos');

//Rota de meu perfil
Route::get('/meu-perfil', [App\Http\Controllers\MeuPerfilController::class, 'index'])->name('meu-perfil');

//Rota de meu perfil
Route::get('/meu-perfil', [App\Http\Controllers\MeuPerfilController::class, 'index'])->name('meu-perfil');

//Rota para listar os projetos do aluno
Route::get('/index_aluno', [MeusProgramasController::class, 'index_aluno']);
