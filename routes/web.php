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
use App\Http\Controllers\ProjetoController;
use App\Http\Controllers\FrequenciaController;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

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

// Rotas de servidor
Route::resource('/servidors', ServidorController::class);
Route::post("/servidors/permissao/{id}", [ServidorController::class, "adicionar_permissao"]);

// Rotas de orientador
Route::resource('/orientadors', OrientadorController::class);
//aaaaaa
// Rotas de programa
Route::resource('/programas', ProgramaController::class);
Route::get('/programas/{id}/editals', [ProgramaController::class, "listar_editais"]);
Route::delete("programas/{id}/editals/{edital_id}", [ProgramaController::class, "deletar_edital"]);
Route::get("/programas/{id}/create/edital", [ProgramaController::class, "criar_edital"]);
Route::post("/programas/store/edital", [ProgramaController::class, "store_edital"]);
Route::get("/programas/edit/{id}/edital", [ProgramaController::class, "editar_edital"]);
Route::put("/programas/update/{id}/edital", [ProgramaController::class, "update_edital"]);

// Rotas de Edital
Route::resource('/edital', EditalController::class);

Route::prefix('edital')->group(function() {
    Route::get('/', [EditalController::class, 'index'])->name('edital.index');
    Route::get('/create', [EditalController::class, 'create'])->name('edital.create');
    Route::post('/', [EditalController::class, 'store'])->name('edital.store');
});    

// Rotas de Disciplina
Route::resource('/disciplinas', DisciplinaController::class);

// Rotas de curso
Route::resource('/cursos', CursoController::class);

// Rotas de Cadastrar-se
Route::get('/cadastrar-se', [CadastrarSeController::class, "cadastrarSe"]);
Route::post('/cadastrar-se/store', [CadastrarSeController::class, "store"]);

// Rotas de projeto
Route::resource('/projetos', ProjetoController::class);
//Route::get('/home', [ProjetoController::class, 'index'])->name('projetos-index');
 Route::get('/create', [ProjetoController::class, 'create'])->name('projetos-create');
// Route::post('/', [ProjetoController::class, 'store'])->name('projetos-store');
Route::post('/projetos', [ProjetoController::class, 'store'])->name('projetos.store');





Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Rotas de Frequencia mensal
Route::get('/frequencia/create', [FrequenciaController::class, 'create']);

//Rotas de listar modelos de documentos
Route::get('/listar-modelos', [App\Http\Controllers\ListarModelosController::class, 'index'])->name('listar-modelos');


