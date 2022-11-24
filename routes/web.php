<?php

use App\Http\Controllers\ProfessorController;
use App\Http\Controllers\AlunoController;
use App\Http\Controllers\ServidorController;
use App\Http\Controllers\VinculoController;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

// Rotas de autenticacao
Route::get('/', function () {
    return view('auth.login');
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
Route::resource('/alunos', AlunoController::class)->only([
    "create", "index", "store"
]);
Route::post('/alunos/update', [AlunoController::class, 'update'])->name("alunos.update");
Route::post('/alunos/criar/aluno', [AlunoController::class, 'criar_aluno'])->name("alunos.criar_aluno");
Route::delete('/alunos/destroy', [AlunoController::class, 'destroy'])->name("alunos.destroy");

// Rotas de servidor
Route::resource('/servidores', ServidorController::class)->only([
    "create", "index", "store"
]);
Route::post('/servidor/update', [ServidorController::class, 'update'])->name("servidor.update");
Route::delete('/servidores/destroy', [ServidorController::class, 'destroy'])->name("servidores.destroy");

// Rotas de professor
Route::resource('/professores', ProfessorController::class)->only([
    "index", "store"
]);
Route::post('/professor/update', [ProfessorController::class, 'update'])->name("professor.update");
Route::delete('/professores/destroy', [ProfessorController::class, 'destroy'])->name("professores.destroy");

// Rotas de vinculo
Route::resource('/vinculos', VinculoController::class)->only([
    "index", "store"
]);
Route::delete('/vinculos/destroy', [VinculoController::class, 'destroy'])->name("vinculos.destroy");
Route::post('/vinculos/update', [VinculoController::class, 'update'])->name("vinculos.update");
Route::get('/vinculos/frequencia/{idVinculo}', [VinculoController::class, 'frequenciaMensal'])->name("vinculos.frequenciaMensal");
Route::post('/vinculos/frequencia', [VinculoController::class, 'salvarfrequenciaMensal'])->name("vinculos.salvarFrequenciaMensal");
Route::post('/vinculos/relatorio', [VinculoController::class, 'relatorio'])->name("vinculos.relatorio");
Route::get('/vinculos/certificado/{id}', [VinculoController::class, 'certificacao'])->name("vinculos.certificado");
Route::get('/getFrequenciaMensal/{idVinculo}/{mes}', [VinculoController::class, 'getFrequencia'])->name("getFrequencia");
Route::get('/vinculos/declaracao/{id}', [VinculoController::class, 'declaracao'])->name("vinculos.declaracao");

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//criado apenas para visualizar a tela de cadastro do aluno
Route::get('/cadastro', [App\Http\Controllers\Controller::class, 'cadastro'])->name('cadastro');