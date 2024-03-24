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

// Route::middleware('jwt.auth')->group(function () {

    // Route::get('/livros/{id}', [LivrosController::class, 'show']);
    Route::apiResource('/livros', LivrosController::class);

    Route::apiResource('/leitores', LeitoresController::class);

    Route::apiResource('/editoras', EditorasController::class);

    Route::apiResource('/livroslidos', LivrosLidosController::class);
    Route::get('/buscaTotalLivrosLidos/{ano}', [LivrosLidosController::class, 'show']);

    Route::post('/leitores/{leitorId}/livros-paginas', [PaginasLivroController::class, 'armazenarLivrosPaginasPorLeitor']);
    Route::get('/leitores/{leitorId}/livros-paginas', [PaginasLivroController::class, 'recuperarLivrosPaginasPorLeitor']);

    Route::post('/armazenatotallivroslidos/{ano}', [PaginasLivroController::class, 'armazenarTotalLivroslidosPorLeitor']);
    Route::get('/recuperartotallivroslidos/{leitorID}', [PaginasLivroController::class, 'recuperarTotalLivroslidosPorLeitor']);


// });
