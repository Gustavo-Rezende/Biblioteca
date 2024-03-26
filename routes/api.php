<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LivrosController;
use App\Http\Controllers\EditorasController;
use App\Http\Controllers\LeitoresController;
use App\Http\Controllers\LivrosLidosController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PaginasLivroController;

Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout']);

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->group(function () {

    Route::apiResource('/livros', LivrosController::class);

    Route::apiResource('/leitores', LeitoresController::class);

    Route::apiResource('/editoras', EditorasController::class);

    Route::apiResource('/livroslidos', LivrosLidosController::class);
    Route::get('/buscaTotalLivrosLidos/{ano}', [LivrosLidosController::class, 'show']);

    Route::get('/armazenatotallivroslidosredis/{ano}', [PaginasLivroController::class, 'armazenarTotalLivrosLidosPorLeitor']);
    Route::get('/retornatotallivrosredis', [PaginasLivroController::class, 'retornaTotalLivrosLidosPorLeitor']);

});
