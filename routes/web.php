<?php

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ContatoController;
use App\Http\Controllers\FornecedorController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\PedidoProdutoController;
use App\Http\Controllers\PrincipalController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\ProdutoDetalheController;
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

    Route::get('/home', [HomeController::class, 'index'])->name('app.home');
    Route::get('/sair', [LoginController::class, 'sair'])->name('app.sair');
    Route::get('/fornecedor', [FornecedorController::class, 'index'])
        ->name('app.fornecedor');
    Route::post('/fornecedor/listar', [FornecedorController::class, 'listar'])
        ->name('app.fornecedor.listar');
    Route::get('/fornecedor/listar', [FornecedorController::class, 'listar'])
        ->name('app.fornecedor.listar');
    Route::get('/fornecedor/adicionar', [FornecedorController::class, 'adicionar'])
        ->name('app.fornecedor.adicionar');
    Route::post('/fornecedor/adicionar', [FornecedorController::class, 'adicionar'])
        ->name('app.fornecedor.adicionar');

    Route::get('/fornecedor/editar{id}/{msg?}', [FornecedorController::class, 'editar'])
        ->name('app.fornecedor.editar');

    Route::get('/fornecedor/escluir{id}/{msg?}', [FornecedorController::class, 'excluir'])
        ->name('app.fornecedor.excluir');

    Route::resource(
        'produto',
        ProdutoController::class
    );
    //produto detalhes
    Route::resource('produto-detalhe', ProdutoDetalheController::class);
    Route::resource('cliente', ClienteController::class);
    Route::resource('pedido', PedidoController::class);
    //Route::resource('pedido-produto', PedidoProdutoController::class);
    Route::get('pedido-produto/create/{pedido}' , [PedidoProdutoController::class , 'create'])->name('pedido-produto.create');
    Route::post('pedido-produto/store/{pedido}' , [PedidoProdutoController::class, 'store'])->name('pedido-produto.store');
});

Route::fallback(function () {
    return '404 personalizado';
});
