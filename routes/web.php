<?php

use App\Http\Controllers\ContatoController;
use App\Http\Controllers\FornecedorController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PrincipalController;
use App\Http\Controllers\SobreNosController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PrincipalController::class, 'principal'])->name('index');
Route::post('/', [PrincipalController::class, 'principal'])->name('principal');
Route::get('/sobre', [SobreNosController::class, 'sobreNos'])->name('sobre');

Route::get('/contato', [ContatoController::class, 'contato'])->name('contato');
Route::post('/contato', [ContatoController::class, 'salvar'])->name('contato');

//rota de login recebendo um erro como parametro caso o login seja errado ou nao tenha sessao
Route::get('/login/{erro?}', [LoginController::class, 'login'])->name('login');
Route::post('/login', [LoginController::class, 'autenticar'])->name('login');

//rotas com resticao, somente logado
Route::middleware('autenticacao:padrao,marcus', 'logAcess')->prefix('/app')->group(function () {

    Route::get('/clientes', function () {
        return 'Clientes';
    })->name('app.clientes');

    Route::get('/fornecedores', [FornecedorController::class, 'index'])
        ->name('app.fornecedores');

    Route::get('/produtos', function () {
        return 'Produtos';
    })->name('app.produtos');
});

Route::fallback(function () {
    return '404 personalizado';
});
