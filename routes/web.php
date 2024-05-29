<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [\App\Http\Controllers\PrincipalController::class, 'principal'])->name('index');

Route::get('/sobre', [\App\Http\Controllers\SobreNosController::class, 'sobreNos'])->name('sobre');

Route::get('/contato', [\App\Http\Controllers\ContatoController::class, 'Contato'])->name('contato');
Route::post('/contato', [\App\Http\Controllers\ContatoController::class, 'Salvar'])->name('contato');

Route::get('/login', function () {
    return 'Login';
})->name('site.login');

Route::prefix('/app')->group(function () {
    Route::get('/clientes', function () {
        return 'Clientes';
    })->name('app.clientes');
    Route::get('/fornecedores', [\App\Http\Controllers\FornecedorController::class, 'index'])->name('app.fornecedores');
    Route::get('/produtos', function () {
        return 'Produtos';
    })->name('app.produtos');
});

Route::fallback(function () {
    return "404 personalizado";
});
