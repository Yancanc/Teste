<?php

use App\Http\Controllers\ConvenioController;
use App\Http\Controllers\InstituicaoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Rota para listar convênios
Route::get('/convenios', [ConvenioController::class, 'index']);
Route::get('/convenios/{id}', [ConvenioController::class, 'show']);

// Rotas para instituições
Route::get('/instituicoes', [InstituicaoController::class, 'index']);
Route::get('/instituicoes/{id}', [InstituicaoController::class, 'show']); 