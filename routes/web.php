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


//usuario
// Route::prefix('usuario')->group(function () {
//     Route::get('/', User)
// });


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
// Route::get('/alunos', [AlunoController::class, 'index'])->name('aluno.index');

// Rotas de servidor
Route::resource('/servidors', ServidorController::class);
Route::post("/servidors/permissao/{id}", [ServidorController::class, "adicionar_permissao"]);

// Rotas de orientador
Route::resource('/orientadors', OrientadorController::class);
Route::get('/MeusAlunos', [MeusAlunosController::class, "index"]);
Route::get('/MeusProgramas', [MeusProgramasController::class, "index"]);
// Rotas de programa
Route::resource('/programas', ProgramaController::class);
Route::get('/programas/{id}/editals', [ProgramaController::class, "listar_editais"]);
Route::get('/programas/{id}/alunos', [ProgramaController::class, "listar_alunos"]);
Route::delete("programas/{id}/editals/{id_edital}", [ProgramaController::class, "deletar_edital"]);
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
    Route::get('/{id}/edit', [EditalController::class, 'edit'])->where('id', '[0-9+')->name('edital.edit');
    Route::put('/{id}', [EditalController::class, 'update'])->name('edital.update');
    Route::delete('/{id}', [EditalController::class, 'destroy'])->name('edital.delete');
    Route::get('/{id}/alunos', [EditalController::class, "listar_alunos"]);
});    


// Rotas de Disciplina
Route::resource('/disciplinas', DisciplinaController::class);

// Rotas de curso
Route::resource('/cursos', CursoController::class);

// Rotas de Cadastrar-se
Route::get('/cadastrar-se', [CadastrarSeController::class, "cadastrarSe"]);
Route::post('/cadastrar-se/store', [CadastrarSeController::class, "store"]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

<<<<<<< HEAD
// Rotas de Frequencia mensal
// Route::get('/frequencia/create', [FrequenciaController::class, 'create']);

=======
>>>>>>> 032b30c (att)
//Rotas de listar modelos de documentos
Route::get('/listar-modelos', [App\Http\Controllers\ListarModelosController::class, 'index'])->name('listar-modelos');

//Rota para listar os projetos do aluno
Route::get('/index_aluno', [MeusProgramasController::class, 'index_aluno']);



