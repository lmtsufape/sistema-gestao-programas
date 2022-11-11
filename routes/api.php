<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VinculoController;
use App\Http\Controllers\EmailController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/vinculos/avaliar/relatorio/final', [VinculoController::class, 'avaliar_relatorio_final'])->name("vinculos.avaliarRelFinal");
Route::post('/vinculos/avaliar/frequencia/mensal', [VinculoController::class, 'avaliar_frequencia_mensal'])->name("vinculos.avaliarFreqMensal");
Route::get('/notificarPrazoFrequencia', [EmailController::class, 'notificarPrazoFrequencia'])->name("email.notificarPrazoFrequencia");
Route::get('/notificarPrazoRelatorio', [EmailController::class, 'notificarPrazoRelatorio'])->name("email.notificarPrazoRelatorio");

