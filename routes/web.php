<?php

use App\Http\Controllers\ContatoController;
use App\Http\Controllers\PrincipalController;
use App\Http\Middleware\LogAcessoMiddleware;
use Illuminate\Support\Facades\Route;

Route::middleware('autenticacao:padrao,marcus', 'logAcess')->get('/', [PrincipalController::class, 'principal'])->name('index');
Route::post('/', [\App\Http\Controllers\PrincipalController::class, 'principal'])->name('principal');
Route::get('/sobre', [\App\Http\Controllers\SobreNosController::class, 'sobreNos'])->name('sobre');

Route::middleware(LogAcessoMiddleware::class)->get('/contato', [ContatoController::class, 'contato'])->name('contato');
Route::post('/contato', [\App\Http\Controllers\ContatoController::class, 'salvar'])->name('contato');

Route::get('/login', function () {
    return 'Login';
})->name('site.login');

Route::prefix('/app')->group(function () {
    Route::middleware('autenticacao')
        ->get('/clientes', function () {
            return 'Clientes';
        })->name('app.clientes');

    Route::get('/fornecedores', [\App\Http\Controllers\FornecedorController::class, 'index'])
        ->name('app.fornecedores');

    Route::get('/produtos', function () {
        return 'Produtos';
    })->name('app.produtos');
});

Route::fallback(function () {
    return '404 personalizado';
});
