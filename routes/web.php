<?php

use App\Http\Controllers\ContatoController;
use App\Http\Controllers\PrincipalController;
use App\Http\Middleware\AutenticacaoMiddleware;
use App\Http\Middleware\LogAcessoMiddleware;
use Illuminate\Support\Facades\Route;

Route::middleware(LogAcessoMiddleware::class)->get('/', [PrincipalController::class, 'principal'])->name('index');
Route::post('/', [\App\Http\Controllers\PrincipalController::class, 'principal'])->name('principal');
Route::get('/sobre', [\App\Http\Controllers\SobreNosController::class, 'sobreNos'])->name('sobre');

Route::middleware(LogAcessoMiddleware::class)->get('/contato', [ContatoController::class, 'contato'])->name('contato');
Route::post('/contato', [\App\Http\Controllers\ContatoController::class, 'salvar'])->name('contato');

Route::get('/login', function () {
    return 'Login';
})->name('site.login');

Route::prefix('/app')->group(function () {
    Route::middleware(LogAcessoMiddleware::class, AutenticacaoMiddleware::class)
        ->get('/clientes', function () {
            return 'Clientes';
        })->name('app.clientes');

    Route::middleware(LogAcessoMiddleware::class, AutenticacaoMiddleware::class)
        ->get('/fornecedores', [\App\Http\Controllers\FornecedorController::class, 'index'])
        ->name('app.fornecedores');

    Route::middleware(LogAcessoMiddleware::class, AutenticacaoMiddleware::class)
        ->get('/produtos', function () {
            return 'Produtos';
        })->name('app.produtos');
});

Route::fallback(function () {
    return '404 personalizado';
});
