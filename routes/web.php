<?php

use App\Http\Controllers\ProfessorController;
use App\Http\Controllers\AlunoController;
use App\Http\Controllers\ServidorController;
use App\Http\Controllers\OrientadorController;
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
Route::resource('/alunos', AlunoController::class);

// Rotas de servidor
Route::resource('/servidores', ServidorController::class);
Route::delete('/servidores/destroy', [ServidorController::class, 'destroy'])->name("servidores.destroy");

// Rotas de orientador
Route::resource('/orientadors', OrientadorController::class);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');




